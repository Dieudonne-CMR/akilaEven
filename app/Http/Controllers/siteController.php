<?php

namespace App\Http\Controllers;

use App\Http\Requests\eventHallFilterRequest;
use App\Models\EventHall;
use Illuminate\Http\Request;
use PHPUnit\Event\TestSuite\Loaded;
use App\Http\Requests\StorebookingsRequest;
use Illuminate\Support\Carbon;
use App\Models\Bookings;
use App\Notifications\EventHallReservationCreateToAdmin;
use App\Notifications\EventHallReservationCreate;
use App\Models\User;
use App\Notifications\EventHallBookingConfirmation;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Log;
use \Illuminate\Support\Facades\Mail;
class siteController extends Controller
{
    /**
     * Affiche la page d'accueil du site.
     *
     * @return View
     */
    public function index()
    {
        return view('site.bl-home.home');
    }

    /**
     * Affiche la liste paginée de toutes les salles de fête.
     *
     * @param  EventHall  $eventHall
     * @return View
     */
    public function salleFete(EventHall $eventHall, eventHallFilterRequest $request)
    {
        $validated = $request->validated();
        // Traitement des locations (transformation en tableau si nécessaire)
        $locations = isset($validated['locations']) 
            ? array_map('trim', explode(',', $validated['locations'])) 
            : [];
        
        // $eventHalls = EventHall::all();
        $eventHalls = EventHall::with(['ville','hotel'])->paginate(4)->withQueryString();       
        return view('site.bl-eventHall.salleFete', compact('eventHalls'));
    }
  
    /**
     * Affiche les détails d'une salle de fête avec des suggestions d'autres salles.
     *
     * @param  EventHall  $eventHall
     * @return View
     */
    public function detailSallesFetes(EventHall $eventHall) 
    {
        
        $eventHall = $eventHall->load('hotel','ville','user');
        $event_Halls =  EventHall::with(['ville','hotel'])->where('id', '!=', $eventHall->id)->paginate(2);   

        return view('site.detailssalleFete', compact('eventHall', 'event_Halls'));
    }

    /**
     * Affiche la page "À propos".
     *
     * @return View
     */
    public function about()
    {
        return view('site.bl-about.about');
    }

    /**
     * Affiche la page de contact.
     *
     * @return View
     */
    public function contact()
    {
        return view('site.bl-contact.contact');
    }

    /**
     * Affiche la page des services.
     *
     * @return View
     */
    public function services()
    {
        return view('services');
    }

    /**
     * Traite une demande de réservation d'une salle de fête.
     * 
     * @param StorebookingsRequest $request
     * @return RedirectResponse
     */
    public function booking(StorebookingsRequest $request)
    {
        /*  dd($request); */
        /*Log::info('Test d\'emplacement');
        Log::info('Processing form submission', $request->validated());
        var_dump($request->validated()); */
        // Récupération des données validées
        $data = $request->validated();

        // Récupérer la salle
        $hall = EventHall::findOrFail($data['event_hall_id']);

        // Vérifier si la salle est déjà réservée aux dates demandées
        $arrival = Carbon::parse($data['arrival_time']);
        $departure = Carbon::parse($data['departure_time']);

        // Compter les réservations actives pour cette salle aux dates demandées
        $conflictingBookings = Bookings::where('event_hall_id', $hall->id)
            ->where(function (Builder $query) use ($arrival, $departure) {
                // Recherche des chevauchements : 
                // (start1 <= end2) && (end1 >= start2)
                $query->where(function (Builder $q) use ($arrival, $departure) {
                    $q->where('arrival_time', '<=', $departure)
                      ->where('departure_time', '>=', $arrival);
                });
            })
            ->whereIn('status', ['pending', 'accepted', 'booked'])
            ->count();

        // Si on a déjà 5 réservations actives, on refuse la nouvelle
        if ($conflictingBookings >= 5) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Cette salle est déjà complètement réservée aux dates choisies. Veuillez sélectionner d\'autres dates.');
        }

        // Calcul de la durée en heures
        $duration = $departure->diffInHours($arrival);

        // Calcul du prix total (prix de la salle x durée)
        $data['total_price'] = $duration * $hall->prix;

        // Définir l'expiration (sera mis à jour après acceptation)
        $data['expires_at'] = Carbon::now()->addHours(24);

        // Générer un token de confirmation aléatoire
        $data['confirmation_token'] = Str::random(64);

        // Définir le statut initial
        $data['status'] = 'pending';

        // Création de la réservation
        $booking = Bookings::create($data);

        // Charger les relations pour les notifications
        $booking->load('eventHall.user', 'eventHall.hotel');
        Mail::raw('Contenu de test', function($msg){
            $msg->to('borismbakop611@gmail.com')
                ->subject('Test simple');
        });
        // Notifier l'administrateur de la salle
        $creator = $booking->eventHall->user;
        \Illuminate\Support\Facades\Mail::to('borismbakop611@gmail.com')
            ->send(new \App\Mail\EventHallBookingCreateEmailToAdmin($booking));

        $creator->notify(new \App\Notifications\EventHallReservationCreateToAdmin($booking));
        
        // Envoyer un email au client
        /* Notification::route('mail', [
            $booking->email => $booking->full_name,
        ])->notify(new EventHallReservationCreate($booking));
 */
        return redirect()
            ->route('site.detailSallesfetes', $hall->id)
            ->with('success', 'Votre demande de réservation a bien été reçue et est en attente de validation par l\'administrateur.');
    }

    /**
     * Confirmation d'une réservation par l'utilisateur via lien dans l'email.
     * 
     * @param Request $request
     * @param string $token
     * @return RedirectResponse
     */
    public function eventHallConfirmBooking(Request $request, $token)
    {
        // 1. Vérifier que le token est valide
        $booking = Bookings::with('eventHall.user', 'eventHall.hotel')
            ->where('confirmation_token', $token)
            ->firstOrFail();

        // 2. Vérifier que le statut est toujours 'Accepted'
        if ($booking->status !== 'accepted') {
            return redirect()->route('site.event-hall-confirm-booking')
                ->with('error', 'Cette réservation ne peut pas être confirmée. Son statut actuel est ' . $booking->status);
        }

        // 3. Vérifier que la réservation n'a pas expiré
        if (Carbon::now()->gt($booking->expires_at)) {
            $booking->update(['status' => 'cancelled']);
            
            return redirect()->route('site.event-hall-confirm-booking')
                ->with('error', 'Cette réservation a expiré. Veuillez effectuer une nouvelle demande.');
        }

        // 4. Mettre à jour le statut et la date de confirmation
        $booking->update([
            'status'            => 'booked',
            'confirmed_at'      => now(),
            'confirmation_token' => null, // Invalider le token après utilisation
        ]);

        // 5. Notifier l'administrateur de la salle que la réservation a été confirmée
        $creator = $booking->eventHall->user;
        if ($creator) {
            $creator->notify(new EventHallBookingConfirmation($booking));
        }

        return redirect()->route('site.event-hall-confirm-booking', $booking)
                    ->with('success', 'Votre réservation est confirmée ! Nous vous remercions pour votre confiance.');
    }
}
