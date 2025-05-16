<?php

namespace App\Http\Controllers;

use App\Http\Requests\eventHallFilterRequest;
use App\Models\EventHall;
use App\Models\Location;
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
use Illuminate\Support\Facades\DB;
use App\Notifications\EventHallBookingCancelled;
use App\Mail\EventHallBookingCreateEmail;
use App\Mail\EventHallBookingCancelledEmail;

class siteController extends Controller
{
    /**
     * Affiche la page d'accueil du site.
     *
     * @return View
     */
    public function index()
    {
        return view('site.pages.home');
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
        
        // Initialiser la requête
        $query = EventHall::with(['ville', 'agence']);
        
        // Recherche par nom de salle
        if (!empty($request->search)) {
            $search = $request->search;
            $query->where('nom_salle', 'LIKE', "%{$search}%");
        }
        
        // Filtre par localisation (villes)
        if (!empty($validated['locations'])) {
            $locations = array_map('trim', explode(',', $validated['locations']));
            $query->whereHas('ville', function($q) use ($locations) {
                $q->whereIn('nom', $locations);
            });
        }
        
        // Filtre par types d'événements
        if (!empty($validated['event_types'])) {
            $eventTypes = array_map('trim', explode(',', $validated['event_types']));
            $query->where(function($q) use ($eventTypes) {
                foreach ($eventTypes as $type) {
                    $q->orWhere('event_type', 'LIKE', "%{$type}%");
                    
                }
            });
        }
        
        // Filtre par prix
        if (!empty($validated['min_prix'])) {
            $query->where('prix', '>=', $validated['min_prix']);
        }
        
        if (!empty($validated['max_prix'])) {
            $query->where('prix', '<=', $validated['max_prix']);
        }
        
        // Filtre par capacité
        if (!empty($validated['min_capacite'])) {
            $query->where('capacite', '>=', $validated['min_capacite']);
        }
        
        if (!empty($validated['max_capacite'])) {
            $query->where('capacite', '<=', $validated['max_capacite']);
        }
        
        // Tri
        switch($request->sort_by) {
            case 'price_asc':
                $query->orderBy('prix', 'asc');
                break;
            case 'price_desc':
                $query->orderBy('prix', 'desc');
                break;
            case 'capacity_asc':
                $query->orderBy('capacite', 'asc');
                break;
            case 'capacity_desc':
                $query->orderBy('capacite', 'desc');
                break;
            default:
                $query->orderBy('created_at', 'desc');
        }
        
        $eventHalls = $query->paginate(4)->withQueryString();
        
        return view('site.pages.salleFete', compact('eventHalls'));
    }
    public function locations(Request $request){
        // Créer et valider la requête de filtre
        $locationFilterRequest = app(\App\Http\Requests\LocationFilterRequest::class);
        $validated = $locationFilterRequest->validated();
        
        // Initialiser la requête
        $query = Location::with(['ville', 'agence']);
        
        // Recherche par nom de location
        if (!empty($request->search)) {
            $search = $request->search;
            $query->where('nom_location', 'LIKE', "%{$search}%");
        }
        
        // Filtre par localisation (villes)
        if (!empty($validated['locations'])) {
            $locations = array_map('trim', explode(',', $validated['locations']));
            $query->whereHas('ville', function($q) use ($locations) {
                $q->whereIn('nom', $locations);
            });
        }
        
        // Filtre par type de location
        if (!empty($validated['type_location'])) {
            $query->where('type_location', $validated['type_location']);
        }
        
        // Filtre par type de logement
        if (!empty($validated['type_logement'])) {
            $query->where('type_logement', $validated['type_logement']);
        }
        
        // Filtre par prix
        if (!empty($validated['min_prix'])) {
            $query->where('prix', '>=', $validated['min_prix']);
        }
        
        if (!empty($validated['max_prix'])) {
            $query->where('prix', '<=', $validated['max_prix']);
        }
        
        // Tri
        switch($request->sort_by) {
            case 'price_asc':
                $query->orderBy('prix', 'asc');
                break;
            case 'price_desc':
                $query->orderBy('prix', 'desc');
                break;
            default:
                $query->orderBy('created_at', 'desc');
        }
        
        $locations = $query->paginate(4)->withQueryString();
        
        return view('site.pages.locations', compact('locations'));
    }
  
    /**
     * Affiche les détails d'une salle de fête avec des suggestions d'autres salles.
     *
     * @param  EventHall  $eventHall
     * @return View
     */
    public function detailSallesFetes(EventHall $eventHall) 
    {
        
        $eventHall = $eventHall->load('agence','ville');
       /*  $event_Halls =  EventHall::with(['ville','agence'])->where('id', '!=', $eventHall->id)->paginate(2);   */ 

        return view('site.pages.detailssalleFete', compact('eventHall'));
    }

    /**
     * Affiche la page "À propos".
     *
     * @return View
     */
    public function about()
    {
        return view('site.pages.about');
    }

    /**
     * Affiche la page de contact.
     *
     * @return View
     */
    public function contact()
    {
        return view('site.pages.contact');
    }

    /**
     * Affiche la page des services.
     *
     * @return View
     */
    public function services()
    {
        return view('site.pages.services');
    }

    /**
     * Traite une demande de réservation d'une salle de fête.
     * 
     * @param StorebookingsRequest $request
     * @return RedirectResponse
     */
    public function storeEventHallBooking(StorebookingsRequest $request)
    {
        // Récupération des données validées
        $data = $request->validated();

        // Récupérer la salle
        $hall = EventHall::findOrFail($data['event_hall_id']);

        // Vérifier si la salle est déjà réservée aux dates demandées
        $arrival = Carbon::parse($data['arrival_time']);
        $departure = Carbon::parse($data['departure_time']);
        
        // Calcul de la durée en jours
        $duration = $arrival->diffInDays($departure) + 1;

        // Calcul du prix total
        $data['total_price'] = $duration * $hall->prix;

        // Définir l'expiration
       /*  $data['expires_at'] = Carbon::now()->addHours(24); */

        // Générer un token de confirmation
        $data['confirmation_token'] = Str::random(64);

        // Définir le statut initial
        $data['status'] = 'pending';
        // Ajouter le type de boooking
        $data['type_booking'] = 'hall';

        DB::beginTransaction();
        try {            
            
            // Création de la réservation
            $booking = Bookings::create($data);

            // Charger les relations pour les notifications
            $booking->load('eventHall.agence');

            // Envoyer un email au client
           /*  Mail::to($booking->email)
                ->send(new EventHallBookingCreateEmail($booking)); */

            // Notifier le propriétaire de l'agence dont la salle appartient            
            
            /* Notification::sendNow($booking->eventHall->agence->user, new EventHallReservationCreateToAdmin($booking)); */
            DB::commit();        
            return redirect()->back()
                ->with('success', "Votre demande de réservation a bien été reçue");
            
        } catch (\Throwable $e) {
            DB::rollBack();             
            return redirect()
                ->back()                
                ->with('error', 'Une erreur est survenueeeeee!  veuiller réessayer');
    }
   
    }

    /**
     * Confirmation d'une réservation par l'utilisateur via lien dans l'email.
     * 
     * @param Request $request
     * @param string $token
     * @return RedirectResponse
     */
    public function bookEventHallBooking(Request $request, $token)
    {
        DB::beginTransaction();
        try {

            // 1. Vérifier que le token est valide
            $booking = Bookings::with('eventHall.user', 'eventHall.agence')
                ->where('confirmation_token', $token)
                ->firstOrFail();

            // 2. Vérifier que le statut est toujours 'Accepted'
            if ($booking->status !== 'accepted') {
                return view('site.pages.book-event-hall-booking', compact('booking'))
                    ->with('error', 'Cette réservation ne peut pas être confirmée.');                  
            }

            // 3. Vérifier que la réservation n'a pas expiré
            if (Carbon::now()->gt($booking->expires_at)) {
                $booking->update(['status' => 'cancelled']);
                
                // Notifier le client de l'annulation
                /* Mail::to($booking->email)
                ->send(new EventHallBookingCancelledEmail($booking)); */
                
                return view('site.pages.book-event-hall-booking', compact('booking','booking'))
                    ->with('error', 'Cette réservation a expirée. Veuillez effectuer une nouvelle demande.');
                 /*    ->with('booking', $booking); */
            }
            if (!is_null($booking->confirmed_at)) {
                return view('site.pages.book-event-hall-booking', compact('booking','booking'))
                    ->with('error', 'Cette réservation a déjà été confirmée.');
            }

            // 4. Mettre à jour le statut et la date de confirmation
            $booking->update([
                'status' => 'booked',
                'confirmed_at' => now(),
                /* 'confirmation_token' => null, */
            ]);

            // 5. Notifier l'administrateur de la salle
            $creator = $booking->eventHall->agence->user;
            if ($creator) {
                $creator->notify(new EventHallBookingConfirmation($booking));
            }
            
            

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Erreur lors de la confirmation de la réservation : ' . $e->getMessage());
            return view('site.pages.book-event-hall-booking')
                ->with('error', 'Une erreur est survenue lors de la confirmation de votre réservation. Veuillez réessayer.');
        }
        DB::commit();

            return view('site.pages.book-event-hall-booking', compact('booking','booking'))
                ->with('success', 'Votre réservation est confirmée ! Nous vous remercions pour votre confiance.');
               
    }
}
