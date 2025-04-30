<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller

{
    /**
     * Affiche le tableau de bord de l'application.
     *
     * @return View
     */
    public function dasboard() {
        // session_destroy(session('current_hotel_id'));
        return view('dashboard');
    }

    /**
     * Affiche la page d'accueil.
     *
     * @return View
     */
    public function index() {
        return view('home');
    }

    /**
     * Affiche le formulaire d'ajout d'une salle.
     *
     * @return View
     */
    public function addsalle() {
        return view('add-salle');
    }
    
    /**
     * Affiche la liste des salles.
     *
     * @return View
     */
    public function salles() {
        return view('salle');
    }
    
}
