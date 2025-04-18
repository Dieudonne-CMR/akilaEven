<?php

namespace App\Http\Controllers;

use App\Models\EventHall;
use App\Models\Hotel;
use App\Models\Ville;
use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\ViewName;

class EventHallController extends Controller

{
    /**
     * Affiche le formulaire de création d'une salle de fête pour un hôtel donné.
     *
     * @param  Hotel  $hotel
     * @return View
     */
    public function createEventHall(Hotel $hotel){

        $villes = Ville::all();
        return view('hotels.eventhall-create', compact('hotel','villes'));
    }

    /**
     * Traite la soumission du formulaire pour enregistrer une nouvelle salle de fête.
     *
     * @param  Request  $request
     * @param  int  $hotel_id
     * @return RedirectResponse
     */
    public function storeEventhall(Request $request, $hotel_id)
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
        ]);
    
        for ($i = 0; $i <= 4; $i++) {
            $field = $i === 0 ? 'photo' : 'photo'.$i;
            if ($request->hasFile($field)) {
                $validated[$field] = $request->file($field)->store("event_halls", 'public');
            }
        }
            
        $validated['user_id'] = auth()->id();
        $validated['hotel_id'] = $hotel_id;
    
        EventHall::create($validated);
    
        return redirect()->route('event-halls.index',$hotel_id)->with('success', 'Salle créée !');
    }
    
    /**
     * Affiche la liste des salles de fête d'un hôtel donné avec pagination.
     *
     * @param  Hotel  $hotel
     * @return View
     */
    public function index(Hotel $hotel)
        {
            $eventHalls = $hotel->eventHalls()
                            ->with('ville') // Chargement relation ville (optionnel)
                            ->paginate(6); // Pagination
            return view('hotels.voir-eventhall',['hotel' => $hotel,'eventHalls' => $eventHalls ]);

        }
    
    /**
     * Affiche les détails d'une salle de fête spécifique.
     *
     * @param  EventHall  $event_hall
     * @return View
     */
    public function show(EventHall $event_hall){

        $eventhall=$event_hall->load('hotel','ville','user');
        return view('hotels.eventhallshow',['eventHall'=>$eventhall]);
    }
    
    /**
     * Affiche le formulaire d'édition d'une salle de fête.
     *
     * @param  EventHall  $event_hall
     * @return View
     */
    public function edit(EventHall $event_hall){

       
        $villes = Ville::all();
        $eventhall=$event_hall->load('hotel','ville');
        return view('hotels.eventhall-edit',['eventHall'=>$eventhall,'villes'=>$villes]);
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
            'hotel_id' => 'required|exists:hotels,id',
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

    
}
