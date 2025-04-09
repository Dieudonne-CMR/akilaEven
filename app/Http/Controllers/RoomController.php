<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use Illuminate\Http\Request;

class RoomController extends Controller
{
   public function createRoom(Hotel $hotel)
   {
       return view('hotels.rooms-create', compact('hotel'));
    
   }
}
