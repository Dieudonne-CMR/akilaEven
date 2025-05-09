<?php

namespace App\Http\Controllers;

use App\Models\Bookings;
use App\Models\EventHall;
use App\Models\Agence;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // Récupérer les statistiques pour le carrousel
        $stats = $this->getStatistics();
        
        // Récupérer les agences
        $agences = Agence::with('user')->get();
        
        // Récupérer les salles de fêtes
        $eventHalls = EventHall::with(['agence', 'ville'])->get();
        
        // Récupérer les réservations
        $bookings = Bookings::with('eventHall')->get();
        
        // Récupérer les réservations complétées
        $completedBookings = Bookings::where('status', 'completed')
            ->with('eventHall')
            ->get();
        
        return view('admin.dashboard', compact(
            'stats', 
            'agences', 
            'eventHalls', 
            'bookings', 
            'completedBookings'
        ));
    }
    
    /**
     * Récupérer toutes les statistiques pour le tableau de bord
     */
    private function getStatistics()
    {
        // Dates pour les calculs
        $now = Carbon::now();
        $startOfMonth = $now->copy()->startOfMonth();
        $startOfPreviousMonth = $now->copy()->subMonth()->startOfMonth();
        $endOfPreviousMonth = $now->copy()->subMonth()->endOfMonth();
        $startOfWeek = $now->copy()->startOfWeek();
        
        // Total des réservations
        $totalBookings = Bookings::count();
        
        // Total des réservations du mois précédent
        $lastMonthBookings = Bookings::whereBetween('created_at', [$startOfPreviousMonth, $endOfPreviousMonth])->count();
        
        // Calcul de la croissance des réservations
        $bookingsGrowth = $lastMonthBookings > 0 
            ? round(($totalBookings - $lastMonthBookings) / $lastMonthBookings * 100, 1) 
            : 100;
        $bookingsGrowthText = ($bookingsGrowth >= 0 ? '+' : '') . $bookingsGrowth . '%';
        
        // Salles de fêtes disponibles
        $availableEventHalls = EventHall::count();
        
        // Nouvelles salles de fêtes cette semaine
        $newEventHalls = EventHall::where('created_at', '>=', $startOfWeek)->count();
        $eventHallsGrowthText = '+' . $newEventHalls;
        
        // Locations disponibles
        $totalLocations = Location::count() ?? 0;
        
        // Calcul du taux d'occupation des locations (si vous avez une table de réservations de locations)
        // Supposons que vous avez une manière de savoir quelles locations sont actuellement occupées
        // Par exemple, en comparant avec les réservations actives
        $occupiedLocations = 0; // À adapter selon votre structure de données
        $locationsOccupancy = $totalLocations > 0 
            ? round(($occupiedLocations / $totalLocations) * 100)
            : 0;
        $locationsOccupancyText = $locationsOccupancy . '%';
        
        // Nombre d'agences partenaires
        $partnerAgences = Agence::count();
        
        // Nouveaux agences partenaires cette semaine
        $newPartners = Agence::where('created_at', '>=', $startOfWeek)->count();
        $newPartnersText = '+' . $newPartners;
        
        // Réservations réussies (complétées)
        $successfulBookings = Bookings::where('status', 'completed')->count();
        
        // Taux de réussite des réservations
        $completionRate = $totalBookings > 0 
            ? round(($successfulBookings / $totalBookings) * 100)
            : 0;
        $completionRateText = $completionRate . '%';
        
        // Réservations de locations
        $locationBookings = 0; // À adapter selon votre structure de données
        
        // Réservations de locations du mois précédent
        $lastMonthLocationBookings = 0; // À adapter selon votre structure de données
        
        // Calcul de la croissance des réservations de locations
        $locationGrowth = $lastMonthLocationBookings > 0 
            ? round(($locationBookings - $lastMonthLocationBookings) / $lastMonthLocationBookings * 100, 1)
            : 0;
        $locationGrowthText = ($locationGrowth >= 0 ? '+' : '') . $locationGrowth . '%';
        
        // Réservations de salles de fêtes
        $eventHallBookings = Bookings::whereNotNull('event_hall_id')->count();
        
        // Réservations de salles de fêtes du mois précédent
        $lastMonthEventHallBookings = Bookings::whereNotNull('event_hall_id')
            ->whereBetween('created_at', [$startOfPreviousMonth, $endOfPreviousMonth])
            ->count();
        
        // Calcul de la croissance des réservations de salles de fêtes
        $eventHallGrowth = $lastMonthEventHallBookings > 0 
            ? round(($eventHallBookings - $lastMonthEventHallBookings) / $lastMonthEventHallBookings * 100, 1)
            : 100;
        $eventHallGrowthText = ($eventHallGrowth >= 0 ? '+' : '') . $eventHallGrowth . '%';
        
        return [
            [
                'title' => 'Réservations totales',
                'value' => $totalBookings,
                'icon' => 'calendar',
                'badge' => $bookingsGrowthText,
                'badgeText' => 'par rapport au mois dernier',
                'gradientFrom' => 'blue',
                'gradientTo' => 'blue'
            ],
            [
                'title' => 'Salles de fêtes disponibles',
                'value' => $availableEventHalls,
                'icon' => 'party-popper',
                'badge' => $eventHallsGrowthText,
                'badgeText' => 'nouvelles cette semaine',
                'gradientFrom' => 'purple',
                'gradientTo' => 'purple'
            ],
            [
                'title' => 'Locations d\'agence disponibles',
                'value' => $totalLocations,
                'icon' => 'agence',
                'badge' => $locationsOccupancyText,
                'badgeText' => 'taux d\'occupation',
                'gradientFrom' => 'emerald',
                'gradientTo' => 'emerald'
            ],
            [
                'title' => 'Agences partenaires',
                'value' => $partnerAgences,
                'icon' => 'building',
                'badge' => $newPartnersText,
                'badgeText' => 'nouveaux partenaires',
                'gradientFrom' => 'amber',
                'gradientTo' => 'amber'
            ],
            [
                'title' => 'Réservations réussies',
                'value' => $successfulBookings,
                'icon' => 'check-circle',
                'badge' => $completionRateText,
                'badgeText' => 'taux de réussite',
                'gradientFrom' => 'blue',
                'gradientTo' => 'blue'
            ],
            [
                'title' => 'Réservations de locations',
                'value' => $locationBookings,
                'icon' => 'bed',
                'badge' => $locationGrowthText,
                'badgeText' => 'par rapport au mois dernier',
                'gradientFrom' => 'indigo',
                'gradientTo' => 'indigo'
            ],
            [
                'title' => 'Réservations de salles',
                'value' => $eventHallBookings,
                'icon' => 'music',
                'badge' => $eventHallGrowthText,
                'badgeText' => 'par rapport au mois dernier',
                'gradientFrom' => 'rose',
                'gradientTo' => 'rose'
            ]
        ];
    }
} 