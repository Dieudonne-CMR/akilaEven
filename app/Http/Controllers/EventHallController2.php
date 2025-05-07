<?php

namespace App\Http\Controllers;

use App\Models\EventHall;
use App\Models\Hotel;
use App\Models\Ville;
use App\Http\Requests\StoreEventHallRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\ViewName;

class EventHallController2 extends Controller

{
    /**
     * Affiche le formulaire de création d'une salle de fête pour un hôtel donné.
     *
     * @param  Hotel  $hotel
     * @return View
     */
    public function create(Hotel $hotel)
    {
        $villes = Ville::all();
        return view('admin.event-hall.create-event-hall', compact('hotel', 'villes'));
    }

    /**
     * Traite la soumission du formulaire pour enregistrer une nouvelle salle de fête.
     *
     * @param  StoreEventHallRequest  $request
     * @param  Hotel  $hotel
     * @return RedirectResponse
     */
    public function store(StoreEventHallRequest $request, Hotel $hotel)
    {
        try {
            // Récupérer les données validées
            $validated = $request->validated();

            // Création de la salle de fête
            $eventHall = new EventHall();
            $eventHall->nom_salle = $validated['name'];
            $eventHall->description_salle = $validated['description'];
            $eventHall->localisation = $validated['location'];
            $eventHall->ville_id = $validated['ville_id'];
            $eventHall->capacite = $validated['capacity'];
            $eventHall->area = $validated['area'];
            $eventHall->prix = $validated['price'];
            $eventHall->hotel_id = $hotel->id;
            $eventHall->user_id = Auth::id();
            $eventHall->equipments = isset($validated['amenities']) ? $validated['amenities'] : [];
            $eventHall->rules = $validated['rules'] ?? null;
            $eventHall->status = 'available';

            // Gestion de l'upload de l'image principale
            if ($request->hasFile('main_image')) {
                $mainImage = $request->file('main_image');
                $mainImageName = 'main_' . time() . '_' . Str::random(10) . '.' . $mainImage->getClientOriginalExtension();
                $mainImagePath = $mainImage->storeAs('event_halls', $mainImageName, 'public');
                $eventHall->photo = $mainImagePath;
            }

            // Gestion des images additionnelles
            $additionalFields = ['photo1', 'photo2', 'photo3', 'photo4'];
            
            if ($request->hasFile('additional_images')) {
                $additionalImages = $request->file('additional_images');
                
                foreach ($additionalImages as $index => $image) {
                    if ($image && $index < count($additionalFields)) {
                        $additionalImageName = 'additional_' . time() . '_' . Str::random(10) . '_' . $index . '.' . $image->getClientOriginalExtension();
                        $additionalImagePath = $image->storeAs('event_halls', $additionalImageName, 'public');
                        $eventHall->{$additionalFields[$index]} = $additionalImagePath;
                    }
                }
            }

            $eventHall->save();

            return redirect()->route('admin.hotels.show', $hotel->id)
                            ->with('success', 'La salle de fête a été créée avec succès.');
        } catch (\Exception $e) {
            return redirect()->back()
                            ->withInput()
                            ->with('error', 'Une erreur est survenue lors de la création de la salle: ' . $e->getMessage());
        }
    }
    
    /**
     * Affiche la liste des salles de fête.
     *
     * @return View
     */
    public function index()
    {
        return view('admin.event-hall.eventHalls');
    }
  
    
    /**
     * Affiche les détails d'une salle de fête spécifique.
     *
     * @param  EventHall  $event_hall
     * @return View
     */
    public function show(EventHall $event_hall)
    {
        $eventhall = $event_hall->load('hotel', 'ville', 'user');
        return view('admin.event-hall.show-event-hall', ['eventHall' => $eventhall]);
    }
    
    /**
     * Affiche le formulaire d'édition d'une salle de fête.
     *
     * @param  EventHall  $event_hall
     * @return View
     */
    public function edit(EventHall $event_hall)
    {
        $villes = Ville::all();
        $eventhall = $event_hall->load('hotel', 'ville');
        return view('admin.event-hall.edit-event-hall', ['eventHall' => $eventhall, 'villes' => $villes]);
    }
    
    /**
     * Traite la mise à jour des informations d'une salle de fête existante.
     *
     * @param  Request  $request
     * @param  EventHall  $event_hall
     * @return RedirectResponse
     */
    public function update(Request $request, EventHall $event_hall)
    {
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
        ]);

        // gestion des images
        $photoFields = ['photo', 'photo1', 'photo2', 'photo3'];

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

        return redirect()->route('admin.event-hall.show', $event_hall->id)
            ->with('success', 'Salle mise à jour avec succès');
    }
}
