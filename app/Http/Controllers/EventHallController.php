<?php

namespace App\Http\Controllers;

use App\Models\EventHall;
use App\Models\Agence;
use App\Models\Ville;
use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class EventHallController extends Controller

{
    /**
     * Affiche le formulaire de création d'une salle de fête pour un agence donné.
     *
     * @param  Agence  $agence
     * @return View
     */
    public function createEventHall(Agence $agence){

        $villes = Ville::all();
        return view('agences.eventhall-create', compact('agence','villes'));
    }

    /**
     * Traite la soumission du formulaire pour enregistrer une nouvelle salle de fête.
     *
     * @param  Request  $request
     * @param  int  $agence_id
     * @return RedirectResponse
     */
    public function storeEventhall(Request $request, $agence_id)
    {
        
        // dd($request->all());
        $validated = $request->validate([
            'nom_salle' => 'required|string|max:255',
            'description_salle' => 'string',
            'localisation' => 'string',
            'capacite' => 'required|integer',
            'prix' => 'required|decimal:0,2',
            'ville_id' => 'required|exists:villes,id',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'photo1' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'photo2' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'photo3' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'photo4' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'area' => "required|decimal:2",
            'event_type' => "required|string",
        ]);
    
        for ($i = 0; $i <= 4; $i++) {
            $field = $i === 0 ? 'photo' : 'photo'.$i;
            if ($request->hasFile($field)) {
                $validated[$field] = $request->file($field)->store("event_halls", 'public');
            }
        }
            
        $validated['user_id'] = Auth::id();
        $validated['agence_id'] = $agence_id;
    
        EventHall::create($validated);
    
        return redirect()->route('event-halls.index',$agence_id)->with('success', 'Salle créée !');
    }
    
    /**
     * Affiche la liste des salles de fête d'un agence donné avec pagination.
     *
     * @param  Agence  $agence
     * @return View
     */
    public function index(Agence $agence)
        {
            $eventHalls = $agence->eventHalls()
                            ->with('ville') // Chargement relation ville (optionnel)
                            ->paginate(6); // Pagination
            return view('agences.voir-eventhall',['agence' => $agence,'eventHalls' => $eventHalls ]);

        }
    
    /**
     * Affiche les détails d'une salle de fête spécifique.
     *
     * @param  EventHall  $event_hall
     * @return View
     */
    public function show(EventHall $event_hall){

        $eventhall=$event_hall->load('agence','ville','user');
        return view('agences.eventhallshow',['eventHall'=>$eventhall]);
    }
    
    /**
     * Affiche le formulaire d'édition d'une salle de fête.
     *
     * @param  EventHall  $event_hall
     * @return View
     */
    public function edit(EventHall $event_hall){

       
        $villes = Ville::all();
        $eventhall=$event_hall->load('agence','ville');
        return view('agences.eventhall-edit',['eventHall'=>$eventhall,'villes'=>$villes]);
    }
    
    /**
     * Traite la mise à jour des informations d'une salle de fête existante.
     *
     * @param  Request  $request
     * @param  EventHall  $event_hall
     * @return RedirectResponse
     */
    public function update(Request $request, EventHall $event_hall){

        $validated = $request->validate([
            'nom_salle' => 'required|string|max:255',
            'description_salle' => 'required|string',
            'localisation' => 'string',
            'capacite' => 'required|integer',
            'prix' => 'required|decimal:0,2',
            'ville_id' => 'required|exists:villes,id',
            'agence_id' => 'required|exists:agences,id',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'photo1' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'photo2' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'photo3' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            // 'photo4' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // gestion des images
        $photoFields=['photo','photo1','photo2','photo3'];

       foreach ($photoFields as $field) {
        // Suppression demandée
        if ($request->has("delete_$field")) {
            Storage::delete('public/' . $event_hall->$field);
            $event_hall->$field = null;
        }
        
        // Nouveau fichier uploadé
        if ($request->hasFile($field)) {
            // Supprimer l'ancien fichier s'il existe
            if ($event_hall->$field) {
                Storage::delete('public/' . $event_hall->$field);
            }
            $path = $request->file($field)->store("event_halls", 'public');
            $validated[$field] = $path;
        } else {
            // Conserver l'ancienne valeur si pas de changement
            $validated[$field] = $event_hall->$field;
        }
    }

        
        $event_hall->update($validated);

    // return redirect()->back()->with('success', 'Modifications enregistrées !');

    return redirect()->route('event-halls.show', $event_hall->id)
        ->with('success', 'Salle mise à jour avec succès');
    }

    /**
     * Affiche le formulaire de création d'une salle de fête.
     *
     * @param  \App\Models\Agence  $agence
     * @return \Illuminate\Http\Response
     */
    public function create(Agence $agence)
    {
        return view('agences.eventHall-create', compact('agence'));
    }

    

   
}
