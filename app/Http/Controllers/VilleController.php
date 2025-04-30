<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Ville;
use Illuminate\Http\Request;

class VilleController extends Controller
{
    //
    public function index()
    {
        // Retourne uniquement les noms, pas besoin de timestamps, id etc.
        return Ville::select('nom')->orderBy('nom')->get()->pluck('nom');
    }
    public function store(Request $request)
    {
        $request->validate([
            'ville' => 'required|string|max:255'
        ]);
    
        $ville = ucfirst(strtolower($request->ville)); // Nettoyage simple
    
        // Optionnel : enregistrer la ville si elle n'existe pas
        $villeModel = \App\Models\Ville::firstOrCreate(['nom' => $ville]);
    
        // Ensuite, associer à la salle ou autre logique...
    }
}
