<?php

namespace App\Http\Controllers;

use App\Helpers\DashboardStatsHelper;
use App\Models\Bookings;
use App\Models\EventHall;
use App\Models\Agence;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function dashboard()
    {
       
        
        // Récupérer les 5 agences les plus récents
        $agences = Agence::with('user')->latest()->take(5)->get();
        
        // Récupérer les 5 salles de fêtes les plus récentes
        $eventHalls = EventHall::with(['agence', 'ville'])->latest()->take(5)->get();
        
        // Récupérer les 5 réservations les plus récentes
        $bookings = Bookings::with('eventHall')->latest()->take(5)->get();
        // Recuperer les 5 réservations complétées
        $completedBookings = Bookings::with('eventHall')->where('status', 'Completed')->latest()->take(5)->get();
        
       
        return view('admin.pages.dashboard', compact(
           
            'agences', 
            'eventHalls',
            'bookings', 
            'completedBookings', 
           
        ));
    }
    
    
} 