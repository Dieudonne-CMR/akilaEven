<?php

namespace App\Http\Controllers;

use App\Models\Bookings;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorebookingsRequest;
use App\Http\Requests\UpdatebookingsRequest;
use App\Helpers\BookingFilterHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Helpers\BookingStatusHelper;
use Exception;
use Illuminate\Validation\Rule;
class BookingController extends Controller
{
    /**
     * Afficher la liste des réservations
     * 
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Récupérer toutes les réservations avec les relations
        $bookings = Bookings::with('eventHall.agence')
            ->get()
            ->map(function ($booking) {
                // Reformater les données pour JSON
                return [
                    'status_badge' => BookingStatusHelper::getStatusBadge($booking->status),
                    'id' => $booking->id,
                    'full_name' => $booking->full_name,
                    'email' => $booking->email,
                    'phone' => $booking->phone,
                    'address' => $booking->address,
                    'status' => $booking->status,
                    'city' => $booking->city,
                    'arrival_time' => $booking->arrival_time?->format('Y-m-d H:i'),
                    'departure_time' => $booking->departure_time?->format('Y-m-d H:i'),
                    'total_price' => $booking->total_price,
                    'event_hall' => $booking->eventHall ? [
                        'id' => $booking->eventHall->id,
                        'name' => $booking->eventHall->nom_salle,
                        'agence' => $booking->eventHall->agence ? $booking->eventHall->agence->nom_agence : null
                    ] : null
                ];
            });

        // Récupérer les filtres pour les statuts
        $filters = BookingFilterHelper::getFiltersList();
        
        return view('admin.booking.bookings', compact('bookings', 'filters'));
    }

    /**
     * Afficher les détails d'une réservation
     * 
     * @param Bookings $booking
     * @return \Illuminate\View\View
     */
    public function show(Bookings $booking)
    {
        $booking->load('eventHall.agence');
        return view("admin.booking.show-booking", compact('booking'));
    }

    /**
     * Supprimer une réservation
     * 
     * @param Bookings $booking
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Bookings $booking)
    {
        try {
            $delete = $booking->delete();
            if(!$delete) throw new Exception("erreur");
            return response()->json([
                'success' => true,
                'message' => 'Réservation supprimée avec succès.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Une erreur est survenue lors de la suppression: ' . $e->getMessage()
            ], 500);
        }
    }
    
    /**
     * Suppression groupée de réservations
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function bulkDestroy(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'integer|exists:bookings,id'
        ]);
        
        $ids = $request->input('ids');
        
        try {
            $count = Bookings::whereIn('id', $ids)->delete();
            
            return response()->json([
                'success' => true,
                'count' => $count,
                'message' => "{$count} réservation(s) ont été supprimée(s) avec succès."
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Une erreur est survenue lors de la suppression: ' . $e->getMessage()
            ], 500);
        }
    }
    
    /**
     * Mettre à jour le statut d'une réservation
     * 
     * @param Request $request
     * @param Bookings $booking
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateStatus(Request $request, Bookings $booking)
    {
         // 1) Valider le statut envoyé
         $data = $request->validate([
            'status' => ['required', Rule::in(Bookings::STATUS)],
        ]);
        $oldStatus = $booking->status;
        
        // Vérifier les transitions d'état autorisées
        $allowed = $this->isStatusTransitionAllowed($oldStatus, $data['status']);
         
        if (!$allowed) {
            return redirect()->back()->with('error', "Le changement de statut de {$oldStatus} à {$data['status']} n'est pas autorisée.");
        }
        
        try {
            DB::beginTransaction();
            
            // 2) Appliquer et sauvegarder
            $booking->status = $data['status'];
            
            // Gérer la date d'expiration pour le statut accepted
            if ($data['status'] === 'accepted') {
                $booking->expires_at = now()->addHours(24);
            }
            
            // Mise à jour du statut de la salle en fonction du statut de la réservation
            if ($booking->eventHall) {
                $eventHall = $booking->eventHall;
                
                // Si le statut passe à "completed", on marque la salle comme indisponible
                if ($data['status'] === 'completed') {
                    $eventHall->status = 'unavailable';
                    $eventHall->save();
                }
                
                // Si le statut passe à "cancelled" ou "refunded", on rend la salle disponible
                if ($data['status'] === 'cancelled' || $data['status'] === 'refunded') {
                    $eventHall->status = 'available';
                    $eventHall->save();
                }
            }
            
            $booking->save();

            // 3) Envoyer les notifications appropriées
            if (in_array($data['status'], ['accepted', 'completed', 'cancelled'])) {
                // Envoyer un email au client
                \Illuminate\Support\Facades\Mail::to($booking->email)
                    ->send(new \App\Mail\Client\EventHallBookingStatusChanged($booking, $data['status']));

                // Envoyer une notification à l'administrateur
                $admin = $booking->eventHall->agence->user;
                $admin->notify(new \App\Notifications\Admin\EventHallBookingStatusChanged($booking, $data['status']));
            }

            DB::commit();
            
            return redirect()
                ->back()
                ->with('success', 'Statut mis à jour avec succès.');
       
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()
                ->back()
                ->with('error', 'Erreur inattendue lors de la mise à jour.' . $e->getMessage());
        }
    }
    
    /**
     * Vérifier si une transition de statut est autorisée
     * 
     * @param string $from Statut actuel
     * @param string $to Nouveau statut
     * @return bool Transition autorisée ou non
     */
    private function isStatusTransitionAllowed($from, $to)
    {
        $allowedTransitions = [
            'pending' => ['accepted', 'cancelled'],
            'accepted' => ['cancelled'],
            'booked' => ['completed', 'cancelled'],
            'completed' => ['refunded'],
            'cancelled' => [],
            'refunded' => []
        ];
        
        if (!isset($allowedTransitions[$from])) {
            return false;
        }
        
        return in_array($to, $allowedTransitions[$from]);
    }
}
