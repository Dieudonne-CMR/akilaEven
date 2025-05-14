<?php

namespace App\Helpers;

use App\Models\Agence;
use App\Models\Bookings;
use App\Models\EventHall;
use App\Models\Location;
use Illuminate\Support\Carbon;

class DashboardStatsHelper
{
    /**
     * Calcule et retourne les statistiques pour le tableau de bord
     * 
     * @return array Tableau des statistiques formatées
     */
    public static function getStatistics()
    {
        // Dates pour les calculs
        $now = Carbon::now();
        $startOfMonth = $now->copy()->startOfMonth();
        $startOfPreviousMonth = $now->copy()->subMonth()->startOfMonth();
        $endOfPreviousMonth = $now->copy()->subMonth()->endOfMonth();
        $startOfWeek = $now->copy()->startOfWeek();
        
        return [
            self::getTotalBookingsStats($startOfPreviousMonth, $endOfPreviousMonth),
            self::getEventHallsStats($startOfWeek),
            self::getLocationsStats(),
            self::getAgencesStats($startOfWeek),
            self::getSuccessfulBookingsStats(),
            self::getLocationBookingsStats($startOfPreviousMonth, $endOfPreviousMonth),
            self::getEventHallBookingsStats($startOfPreviousMonth, $endOfPreviousMonth),
        ];
    }

    /**
     * Calcule les statistiques de réservations totales
     * 
     * @param Carbon $startOfPreviousMonth Début du mois précédent
     * @param Carbon $endOfPreviousMonth Fin du mois précédent
     * @return array Statistiques formatées
     */
    private static function getTotalBookingsStats($startOfPreviousMonth, $endOfPreviousMonth)
    {
        // Total des réservations
        $totalBookings = Bookings::count();
        
        // Total des réservations du mois précédent
        $lastMonthBookings = Bookings::whereBetween('created_at', [$startOfPreviousMonth, $endOfPreviousMonth])->count();
        
        // Calcul de la croissance des réservations
        $bookingsGrowth = $lastMonthBookings > 0 
            ? round(($totalBookings - $lastMonthBookings) / $lastMonthBookings * 100, 1) 
            : 100;
        $bookingsGrowthText = ($bookingsGrowth >= 0 ? '+' : '') . $bookingsGrowth . '%';

        return [
            'title' => 'Réservations totales',
            'value' => $totalBookings,
            'icon' => 'calendar',
            'badge' => $bookingsGrowthText,
            'badgeText' => 'par rapport au mois dernier',
            'gradientFrom' => 'blue',
            'gradientTo' => 'blue'
        ];
    }

    /**
     * Calcule les statistiques des salles de fêtes
     * 
     * @param Carbon $startOfWeek Début de la semaine courante
     * @return array Statistiques formatées
     */
    private static function getEventHallsStats($startOfWeek)
    {
        // Salles de fêtes disponibles
        $availableEventHalls = EventHall::count();
        
        // Nouvelles salles de fêtes cette semaine
        $newEventHalls = EventHall::where('created_at', '>=', $startOfWeek)->count();
        $eventHallsGrowthText = '+' . $newEventHalls;

        return [
            'title' => 'Salles de fêtes disponibles',
            'value' => $availableEventHalls,
            'icon' => 'party-popper',
            'badge' => $eventHallsGrowthText,
            'badgeText' => 'nouvelles cette semaine',
            'gradientFrom' => 'purple',
            'gradientTo' => 'purple'
        ];
    }

    /**
     * Calcule les statistiques des locations
     * 
     * @return array Statistiques formatées
     */
    private static function getLocationsStats()
    {
        // Locations disponibles
        $totalLocations = Location::count() ?? 0;
        
        // Calcul du taux d'occupation des locations
        $occupiedLocations = Location::whereHas('bookings', function($query) {
            $query->where('status', 'booked')->orWhere('status', 'completed');
        })->count();
        
        $locationsOccupancy = $totalLocations > 0 
            ? round(($occupiedLocations / $totalLocations) * 100)
            : 0;
        $locationsOccupancyText = $locationsOccupancy . '%';

        return [
            'title' => 'Locations d\'agence disponibles',
            'value' => $totalLocations,
            'icon' => 'agence',
            'badge' => $locationsOccupancyText,
            'badgeText' => 'taux d\'occupation',
            'gradientFrom' => 'blue',
            'gradientTo' => 'blue'
        ];
    }

    /**
     * Calcule les statistiques des agences
     * 
     * @param Carbon $startOfWeek Début de la semaine courante
     * @return array Statistiques formatées
     */
    private static function getAgencesStats($startOfWeek)
    {
        // Nombre d'agences partenaires
        $partnerAgences = Agence::count();
        
        // Nouveaux agences partenaires cette semaine
        $newPartners = Agence::where('created_at', '>=', $startOfWeek)->count();
        $newPartnersText = '+' . $newPartners;

        return [
            'title' => 'Agences partenaires',
            'value' => $partnerAgences,
            'icon' => 'building',
            'badge' => $newPartnersText,
            'badgeText' => 'nouveaux partenaires',
            'gradientFrom' => 'amber',
            'gradientTo' => 'amber'
        ];
    }

    /**
     * Calcule les statistiques des réservations réussies
     * 
     * @return array Statistiques formatées
     */
    private static function getSuccessfulBookingsStats()
    {
        // Total des réservations
        $totalBookings = Bookings::count();
        
        // Réservations réussies (complétées)
        $successfulBookings = Bookings::where('status', 'completed')->count();
        
        // Taux de réussite des réservations
        $completionRate = $totalBookings > 0 
            ? round(($successfulBookings / $totalBookings) * 100)
            : 0;
        $completionRateText = $completionRate . '%';

        return [
            'title' => 'Réservations réussies',
            'value' => $successfulBookings,
            'icon' => 'check-circle',
            'badge' => $completionRateText,
            'badgeText' => 'taux de réussite',
            'gradientFrom' => 'emerald',
            'gradientTo' => 'emerald'
        ];
    }

    /**
     * Calcule les statistiques des réservations de locations
     * 
     * @param Carbon $startOfPreviousMonth Début du mois précédent
     * @param Carbon $endOfPreviousMonth Fin du mois précédent
     * @return array Statistiques formatées
     */
    private static function getLocationBookingsStats($startOfPreviousMonth, $endOfPreviousMonth)
    {
        // Réservations de locations
        $locationBookings = Bookings::whereNotNull('location_id')->count();
        
        // Réservations de locations du mois précédent
        $lastMonthLocationBookings = Bookings::whereNotNull('location_id')
            ->whereBetween('created_at', [$startOfPreviousMonth, $endOfPreviousMonth])
            ->count();
        
        // Calcul de la croissance des réservations de locations
        $locationGrowth = $lastMonthLocationBookings > 0 
            ? round(($locationBookings - $lastMonthLocationBookings) / $lastMonthLocationBookings * 100, 1)
            : ($locationBookings > 0 ? 100 : 0);
            
        $locationGrowthText = ($locationGrowth >= 0 ? '+' : '') . $locationGrowth . '%';

        return [
            'title' => 'Réservations de locations',
            'value' => $locationBookings,
            'icon' => 'bed',
            'badge' => $locationGrowthText,
            'badgeText' => 'par rapport au mois dernier',
            'gradientFrom' => 'indigo',
            'gradientTo' => 'indigo'
        ];
    }

    /**
     * Calcule les statistiques des réservations de salles de fêtes
     * 
     * @param Carbon $startOfPreviousMonth Début du mois précédent
     * @param Carbon $endOfPreviousMonth Fin du mois précédent
     * @return array Statistiques formatées
     */
    private static function getEventHallBookingsStats($startOfPreviousMonth, $endOfPreviousMonth)
    {
        // Réservations de salles de fêtes
        $eventHallBookings = Bookings::whereNotNull('event_hall_id')->count();
        
        // Réservations de salles de fêtes du mois précédent
        $lastMonthEventHallBookings = Bookings::whereNotNull('event_hall_id')
            ->whereBetween('created_at', [$startOfPreviousMonth, $endOfPreviousMonth])
            ->count();
        
        // Calcul de la croissance des réservations de salles de fêtes
        $eventHallGrowth = $lastMonthEventHallBookings > 0 
            ? round(($eventHallBookings - $lastMonthEventHallBookings) / $lastMonthEventHallBookings * 100, 1)
            : ($eventHallBookings > 0 ? 100 : 0);
            
        $eventHallGrowthText = ($eventHallGrowth >= 0 ? '+' : '') . $eventHallGrowth . '%';

        return [
            'title' => 'Réservations de salles',
            'value' => $eventHallBookings,
            'icon' => 'music',
            'badge' => $eventHallGrowthText,
            'badgeText' => 'par rapport au mois dernier',
            'gradientFrom' => 'rose',
            'gradientTo' => 'rose'
        ];
    }
} 