<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use Illuminate\Http\Request;

class RoomController extends Controller
{
   /**
    * Affiche le formulaire de création d'une chambre pour un hôtel spécifique.
    *
    * @param  Hotel  $hotel
    * @return View
    */
   public function createRoom(Hotel $hotel)
   {
       return view('hotels.rooms-create', compact('hotel'));
    
   }
}
