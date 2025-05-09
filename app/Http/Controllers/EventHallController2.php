<?php

namespace App\Http\Controllers;

use App\Models\EventHall;
use App\Models\Agence;
use App\Models\Ville;
use App\Http\Requests\StoreEventHallRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class EventHallController2 extends Controller

{
    /**
     * Affiche le formulaire de création d'une salle de fête pour un agence donné.
     *
     * @param  Agence  $agence
     * @return View
     */
    public function create(Agence $agence)
    {
        $villes = Ville::all();
        return view('admin.event-hall.create-event-hall', compact('agence', 'villes'));
    }

    /**
     * Traite la soumission du formulaire pour enregistrer une nouvelle salle de fête.
     *
     * @param  StoreEventHallRequest  $request
     * @param  Agence  $agence
     * @return RedirectResponse
     */
    public function store(StoreEventHallRequest $request, Agence $agence)
    {
        try {
            /* DB::beginTransaction(); */
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
            $eventHall->agence_id = $agence->id;
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

            return redirect()->route('admin.event-hall.create', $agence->id)
                            ->with('success', 'La salle de fête a été créée avec succès.');
        } catch (\Exception $e) {
            // En cas d'erreur, supprimer les fichiers uploadés
            if (isset($eventHall->photo)) {
                Storage::disk('public')->delete($eventHall->photo);
            }
            if (isset($eventHall->photo1)) {
                Storage::disk('public')->delete($eventHall->photo1);
            }
            if (isset($eventHall->photo2)) {
                Storage::disk('public')->delete($eventHall->photo2);
            }
            if (isset($eventHall->photo3)) {
                Storage::disk('public')->delete($eventHall->photo3);
            }
            if (isset($eventHall->photo4)) {
                Storage::disk('public')->delete($eventHall->photo4);
            }
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
        // Récupérer toutes les salles de fête avec leurs relations
        $eventHalls = EventHall::with(['agence', 'ville'])->get();
        
        // Préparer les filtres pour la vue
        $filters = [
            'event_types' => \App\Helpers\EventTypeHelper::getEventTypes(),
            'villes' => Ville::all()
        ];
        
        return view('admin.event-hall.eventHalls', compact('eventHalls', 'filters'));
    }
  
    
    /**
     * Affiche les détails d'une salle de fête spécifique.
     *
     * @param  EventHall  $event_hall
     * @return View
     */
    public function show(EventHall $event_hall)
    {
        $eventhall = $event_hall->load('agence', 'ville', 'user');
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
        $eventhall = $event_hall->load('agence', 'ville');
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
            'agence_id' => 'required|exists:agences,id',
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

    /**
     * Supprime la salle de fête spécifiée.
     *
     * @param  \App\Models\EventHall  $eventHall
     * @return \Illuminate\Http\Response
     */
    public function destroy(EventHall $eventHall)
    {
        try {
            DB::beginTransaction();
            
            // Récupérer l'ID de l'agence avant de supprimer la salle
            $agenceId = $eventHall->agence_id;
            
            // Supprimer la photo si elle existe
            if ($eventHall->photo) {
                Storage::disk('public')->delete($eventHall->photo);
            }
            
            // Supprimer la salle
            $eventHall->delete();
            
            DB::commit();
            
            return redirect()->route('admin.agences.show', $agenceId)
                ->with('toast', [
                    'type' => 'success',
                    'message' => 'Salle de fête supprimée avec succès!'
                ]);
        } catch (\Exception $e) {
            DB::rollBack();
            
            Log::error('Erreur lors de la suppression de la salle de fête: ' . $e->getMessage());
            
            return redirect()->back()
                ->with('toast', [
                    'type' => 'error',
                    'message' => 'Une erreur est survenue lors de la suppression de la salle de fête: ' . $e->getMessage()
                ]);
        }
    }

     /**
     * Supprime plusieurs salles de fête à la fois.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function bulkDestroy(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:event_halls,id'
        ]);
        
        try {
            DB::beginTransaction();
            
            // Récupérer la première salle pour avoir l'agence_id pour la redirection
            $firstHall = EventHall::find($request->ids[0]);
            $agenceId = $firstHall ? $firstHall->agence_id : null;
            
            // Récupérer toutes les salles à supprimer
            $halls = EventHall::whereIn('id', $request->ids)->get();
            
            foreach ($halls as $hall) {
                // Supprimer la photo si elle existe
                if ($hall->photo) {
                    Storage::disk('public')->delete($hall->photo);
                }
                
                // Supprimer la salle
                $hall->delete();
            }
            
            DB::commit();
            
            if ($agenceId) {
                return redirect()->route('admin.agences.show', $agenceId)
                    ->with('toast', [
                        'type' => 'success',
                        'message' => count($request->ids) . ' salles de fête ont été supprimées avec succès.'
                    ]);
            } else {
                return redirect()->route('admin.agences')
                    ->with('toast', [
                        'type' => 'success',
                        'message' => count($request->ids) . ' salles de fête ont été supprimées avec succès.'
                    ]);
            }
        } catch (\Exception $e) {
            DB::rollBack();
            
            Log::error('Erreur lors de la suppression en masse des salles de fête: ' . $e->getMessage());
            
            return redirect()->back()
                ->with('toast', [
                    'type' => 'error',
                    'message' => 'Une erreur est survenue lors de la suppression des salles de fête: ' . $e->getMessage()
                ]);
        }
    }
}
