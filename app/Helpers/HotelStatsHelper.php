<?php

namespace App\Helpers;

use App\Models\Hotel;
use App\Models\Bookings;
use App\Models\EventHall;
use App\Models\Room;
use Illuminate\Support\Carbon;

class HotelStatsHelper
{
    /**
     * Récupère les statistiques globales d'un hôtel
     * 
     * @param Hotel $hotel L'hôtel concerné
     * @return array Les statistiques calculées
     */
    public static function getHotelStats(Hotel $hotel)
    {
        // Récupérer le nombre de chambres et de salles
        $roomsCount = $hotel->rooms()->count();
        $hallsCount = $hotel->eventHalls()->count();
        
        // Récupérer les réservations des salles de l'hôtel
        $eventHallIds = $hotel->eventHalls()->pluck('id')->toArray();
        $totalBookings = Bookings::whereIn('event_hall_id', $eventHallIds)->count();
        
        // Calculer le nombre de salles disponibles
        $availableHalls = $hotel->eventHalls()->where('status', 'available')->count();
        
        // Calcul du taux d'occupation des chambres
        $occupancyRate = $roomsCount > 0 
            ? round(($hotel->rooms()->where('status', 'unavailable')->count() / $roomsCount) * 100) 
            : 0;
        
        // Calculer le nombre de réservations par type
        $roomBookings = Bookings::whereIn('event_hall_id', $eventHallIds)
            ->whereHas('eventHall', function($query) {
                $query->where('type', 'room');
            })
            ->count();
            
        $hallBookings = Bookings::whereIn('event_hall_id', $eventHallIds)
            ->whereHas('eventHall', function($query) {
                $query->where('type', 'hall');
            })
            ->count();
        
        // Calcul de l'augmentation des réservations (comparaison avec le mois précédent)
        $bookingsThisMonth = Bookings::whereIn('event_hall_id', $eventHallIds)
            ->whereMonth('created_at', Carbon::now()->month)
            ->count();
            
        $bookingsLastMonth = Bookings::whereIn('event_hall_id', $eventHallIds)
            ->whereMonth('created_at', Carbon::now()->subMonth()->month)
            ->count();
            
        $bookingsIncrease = $bookingsLastMonth > 0 
            ? round((($bookingsThisMonth - $bookingsLastMonth) / $bookingsLastMonth) * 100) 
            : ($bookingsThisMonth > 0 ? 100 : 0);
        
        // Calculer le taux de réservations réussies
        $successfulBookings = Bookings::whereIn('event_hall_id', $eventHallIds)
            ->whereIn('status', ['completed', 'booked'])
            ->count();
            
        $successRate = $totalBookings > 0 
            ? round(($successfulBookings / $totalBookings) * 100) 
            : 0;
            
        // Calculer l'augmentation du taux de réussite
        $successRateLastMonth = 0;
        
        if ($bookingsLastMonth > 0) {
            $successfulBookingsLastMonth = Bookings::whereIn('event_hall_id', $eventHallIds)
                ->whereIn('status', ['completed'])
                ->whereMonth('created_at', Carbon::now()->subMonth()->month)
                ->count();
                
            $successRateLastMonth = round(($successfulBookingsLastMonth / $bookingsLastMonth) * 100);
        }
        
        $successRateIncrease = $successRateLastMonth > 0 
            ? $successRate - $successRateLastMonth 
            : 0;
        
        // Agréger toutes les statistiques
        return [
            'total_bookings' => [
                'value' => $totalBookings,
                'increase' => $bookingsIncrease,
                'icon' => 'calendar-check'
            ],
            'rooms_count' => [
                'value' => $roomsCount,
                'occupancy_rate' => $occupancyRate,
                'icon' => 'bed'
            ],
            'halls_count' => [
                'value' => $hallsCount,
                'available' => $availableHalls,
                'icon' => 'landmark'
            ],
            'success_rate' => [
                'value' => $successRate,
                'increase' => $successRateIncrease,
                'icon' => 'check-circle'
            ],
            'room_bookings' => [
                'value' => $roomBookings,
                'increase' => $bookingsIncrease,
                'icon' => 'hotel'
            ],
            'hall_bookings' => [
                'value' => $hallBookings,
                'increase' => $bookingsIncrease,
                'icon' => 'party-popper'
            ]
        ];
    }
} 