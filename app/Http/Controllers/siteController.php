<?php

namespace App\Http\Controllers;

use App\Models\EventHall;
use Illuminate\Http\Request;
use PHPUnit\Event\TestSuite\Loaded;

class siteController extends Controller
{
    /**
     * Affiche la page d'accueil du site.
     *
     * @return View
     */
    public function index()
    {
        return view('site.home');
    }

    /**
     * Affiche la liste paginée de toutes les salles de fête.
     *
     * @param  EventHall  $eventHall
     * @return View
     */
    public function salleFete(EventHall $eventHall)
    {
        // $eventHalls = EventHall::all();
        $eventHalls = EventHall::with(['ville','hotel'])->paginate(6);
        // $eventHalls= $eventHall->Load('hotel', 'ville');
        // dd($eventHalls);
        return view('site.salleFete', compact('eventHalls'));
    }
  
    /**
     * Affiche les détails d'une salle de fête avec des suggestions d'autres salles.
     *
     * @param  EventHall  $eventHall
     * @return View
     */
    public function detailFallesFetes(EventHall $eventHall) 
    {
        // $eventHall = EventHall::find($id);
        // $eventHall = EventHall::with(['ville','hotel'])->find($id);
        // $eventHall = EventHall::with(['ville','hotel'])->find($eventHall->id);
        $eventhall = $eventHall->load('hotel','ville','user');
        $event_Halls =  EventHall::with(['ville','hotel'])->paginate(2);
        // $eventHall = EventHall::with(['ville','hotel'])->find($eventHall->id);
        // $eventHall = EventHall::with(['ville','hotel'])->find($eventHall->id);

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
        return view('contact');
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
}
