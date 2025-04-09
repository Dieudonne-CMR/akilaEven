<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller

{
    public function dasboard() {
        // session_destroy(session('current_hotel_id'));
        return view('dashboard');
    }

    public function index() {
        return view('home');
    }

    public function addsalle() {
        return view('add-salle');
    }
    
    public function salles() {
        return view('salle');
    }
    
}
