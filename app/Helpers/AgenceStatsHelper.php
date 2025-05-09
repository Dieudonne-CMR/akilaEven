<?php

namespace App\Helpers;

use App\Models\Agence;
use App\Models\Bookings;
use App\Models\EventHall;
use App\Models\Location;
use Illuminate\Support\Carbon;

class AgenceStatsHelper
{
    /**
     * Récupère les statistiques globales d'une agence
     * 
     * @param Agence $agence L'agence concerné
     * @return array Les statistiques calculées
     */
    public static function getAgenceStats(Agence $agence)
    {
        // Récupérer le nombre de locations et de salles
        $locationsCount = $agence->locations()->count();
        $hallsCount = $agence->eventHalls()->count();
        
        // Récupérer les réservations des salles de l'agence
        $eventHallIds = $agence->eventHalls()->pluck('id')->toArray();
        // Récupérer toutes les réservations des locations d'agence
        $locationIds = $agence->locations()->pluck('id')->toArray();
        $totalBookings = Bookings::whereIn('event_hall_id', $eventHallIds)
            ->orWhereIn('location_id', $locationIds)
            ->count();
        
        // Calculer le nombre de salles disponibles
        $availableHalls = $agence->eventHalls()->where('status', 'available')->count();
        
        // Calcul du taux d'occupation des locations
        $occupancyRate = $locationsCount > 0 
            ? round(($agence->locations()->where('status', 'unavailable')->count() / $locationsCount) * 100) 
            : 0;
        
        // Calculer le nombre de réservations par type
        $locationBookings = Bookings::whereIn('location_id', $eventHallIds)
            ->whereHas('location', function($query) {
                $query->where('type_booking', 'location');
            })
            ->count();
            
        $hallBookings = Bookings::whereIn('event_hall_id', $eventHallIds)
            ->whereHas('eventHall', function($query) {
                $query->where('type_booking', 'hall');
            })
            ->count();
        
        // Calcul de l'augmentation des réservations (comparaison avec le mois précédent)
        // Pour les deux types de réservations
        $AllbookingsThisMonth = Bookings::where(function($query) use ($eventHallIds) {
                $query->whereIn('event_hall_id', $eventHallIds)
                      ->orWhereIn('location_id', $eventHallIds);
            })
            ->whereMonth('created_at', Carbon::now()->month)
            ->count();
            
        $AllbookingsLastMonth = Bookings::where(function($query) use ($eventHallIds) {
                $query->whereIn('event_hall_id', $eventHallIds)
                      ->orWhereIn('location_id', $eventHallIds);
            })
            ->whereMonth('created_at', Carbon::now()->subMonth()->month)
            ->count();
            
        $AllbookingsIncrease = $AllbookingsLastMonth > 0 
            ? round((($AllbookingsThisMonth - $AllbookingsLastMonth) / $AllbookingsLastMonth) * 100) 
            : ($AllbookingsThisMonth > 0 ? 100 : 0);
        // Pour les salles de fête
        $HallsbookingsThisMonth = Bookings::whereIn('event_hall_id', $eventHallIds)
            ->whereMonth('created_at', Carbon::now()->month)
            ->count();
            
        $HallsbookingsLastMonth = Bookings::whereIn('event_hall_id', $eventHallIds)
            ->whereMonth('created_at', Carbon::now()->subMonth()->month)
            ->count();
            
        $HallsbookingsIncrease = $HallsbookingsLastMonth > 0 
            ? round((($HallsbookingsThisMonth - $HallsbookingsLastMonth) / $HallsbookingsLastMonth) * 100) 
            : ($HallsbookingsThisMonth > 0 ? 100 : 0);
        // Pour les locations
        $LocationsbookingsThisMonth = Bookings::whereIn('location_id', $locationIds)
            ->whereMonth('created_at', Carbon::now()->month)
            ->count();
            
        $LocationsbookingsLastMonth = Bookings::whereIn('location_id', $locationIds)
            ->whereMonth('created_at', Carbon::now()->subMonth()->month)
            ->count();
            
        $LocationsbookingsIncrease = $LocationsbookingsLastMonth > 0 
            ? round((($LocationsbookingsThisMonth - $LocationsbookingsLastMonth) / $LocationsbookingsLastMonth) * 100) 
            : ($LocationsbookingsThisMonth > 0 ? 100 : 0);
        
        // Calculer le taux de réservations réussies
        $successfulBookings = Bookings::where(function($query) use ($eventHallIds, $locationIds) {
                $query->whereIn('event_hall_id', $eventHallIds)
                      ->orWhereIn('location_id', $locationIds);
            })
            ->where('status', 'completed')
            ->count();
        $successRate = $totalBookings > 0 
            ? round(($successfulBookings / $totalBookings) * 100) 
            : 0;
            
        // Calculer l'augmentation du taux de réussite
        $successRateLastMonth = 0;
        
        if ($AllbookingsLastMonth > 0) {
            $successfulBookingsLastMonth = Bookings::where(function($query) use ($eventHallIds, $locationIds) {
                $query->whereIn('event_hall_id', $eventHallIds)
                      ->orWhereIn('location_id', $locationIds);
            })
            ->where('status', 'completed')
            ->whereMonth('created_at', Carbon::now()->subMonth()->month)
            ->count();
                
            $successRateLastMonth = round(($successfulBookingsLastMonth / $AllbookingsLastMonth) * 100);
        }
        
        $successRateIncrease = $successRateLastMonth > 0 
            ? $successRate - $successRateLastMonth 
            : 0;
        
        // Agréger toutes les statistiques
        return [
            'total_bookings' => [
                'value' => $totalBookings,
                'increase' => $AllbookingsIncrease,
                'icon' => 'calendar-check'
            ],
            'locations_count' => [
                'value' => $locationsCount,
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
            'location_bookings' => [
                'value' => $locationBookings,
                'increase' => $LocationsbookingsIncrease,
                'icon' => 'building-2'
            ],
            'hall_bookings' => [
                'value' => $hallBookings,
                'increase' => $HallsbookingsIncrease,
                'icon' => 'party-popper'
            ]
        ];
    }
} 