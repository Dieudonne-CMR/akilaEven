<?php

namespace App\Http\Controllers;

use App\Models\EventHall;
use Illuminate\Http\Request;
use PHPUnit\Event\TestSuite\Loaded;

class siteController extends Controller
{
    public function index()
    {
        $eventhalls = EventHall::with(['ville', 'hotel'])->take(2)->get();

        return view('site.home', compact('eventhalls'));
    }
    public function salleFete(EventHall $eventHall)
    {
        // $eventHalls = EventHall::all();
        $eventHalls = EventHall::with(['ville','hotel'])->paginate(6);
        // $eventHalls= $eventHall->Load('hotel', 'ville');
        // dd($eventHalls);
        return view('site.salleFete', compact('eventHalls'));
    }
  

    public function detailFallesFetes(EventHall $eventHall) 
    {
        // $eventHall = EventHall::find($id);
        // $eventHall = EventHall::with(['ville','hotel'])->find($id);
        // $eventHall = EventHall::with(['ville','hotel'])->find($eventHall->id);
        $eventhall = $eventHall->load('hotel','ville','user');
        $event_Halls =  EventHall::with(['ville','hotel'])->paginate(2);
        $eventhall->increment('views'); // Increment the views count
        
        // $eventHall = EventHall::with(['ville','hotel'])->find($eventHall->id);
        // $eventHall = EventHall::with(['ville','hotel'])->find($eventHall->id);

        return view('site.detailssalleFete', compact('eventHall', 'event_Halls'));
    }

    public function about()
    {
        return view('about');
    }

    public function contact()
    {
        return view('contact');
    }

    public function services()
    {
        return view('services');
    }

    public function blogSite(){
        return view('site.blog');
    }
}
