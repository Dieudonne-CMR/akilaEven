<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hotel;

use Illuminate\Routing\Controller;

class HotelController2 extends Controller
{
     // 1. Ajoutez le constructeur ici
     public function __construct()
     {
         // Applique le middleware 'auth' à toutes les méthodes
         /* $this->middleware('auth'); */
         
         // Optionnel : appliquer à des méthodes spécifiques
         // $this->middleware('auth')->only(['create', 'store']);
     }


    /**
     * Affiche la liste des hôtels.
     *
     * @return View
     */
    public function index() {
        $hotels= Hotel::all();
        return view('admin.hotel.hotels',compact('hotels'));
    }
    public function create(){
        return view('admin.hotel.create-hotel');
        
    }
    public function store(Request $request){
        
        // Redirection avec un message flash
        return redirect()->route('admin.hotels.create')->with('success', 'Hôtel créé avec succès !');
    }
    public function show(Hotel $hotel){
       
        // dd($hotel);
        $eventHalls = $hotel->eventHalls()
        ->with('ville') // Chargement relation ville (optionnel)
        ->paginate(6); // Pagination

        session(['selected_hotel' => $hotel->id]); // Enregistrer l'ID de l'hôtel dans la session

        return view('admin.hotel.show-hotel', compact('hotel', 'eventHalls'));
    }

}
