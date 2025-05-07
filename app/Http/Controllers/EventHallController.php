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
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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

    /**
     * Affiche le formulaire de création d'une salle de fête.
     *
     * @param  \App\Models\Hotel  $hotel
     * @return \Illuminate\Http\Response
     */
    public function create(Hotel $hotel)
    {
        return view('admin.event-hall.create', compact('hotel'));
    }

    /**
     * Stocke une nouvelle salle de fête.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Hotel  $hotel
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Hotel $hotel)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'capacity' => 'required|integer|min:1',
            'event_type' => 'required|array',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        try {
            DB::beginTransaction();

            $eventHall = new EventHall();
            $eventHall->name = $request->name;
            $eventHall->description = $request->description;
            $eventHall->price = $request->price;
            $eventHall->capacity = $request->capacity;
            $eventHall->hotel_id = $hotel->id;
            $eventHall->ville = $hotel->ville;
            $eventHall->localisation = $hotel->localisation;
            $eventHall->event_type = json_encode($request->event_type);
            $eventHall->status = 'available';

            if ($request->hasFile('photo')) {
                $eventHall->photo = $request->file('photo')->store('event-halls', 'public');
            }

            $eventHall->save();

            DB::commit();

            return redirect()->route('admin.hotels.show', $hotel)
                ->with('toast', [
                    'type' => 'success',
                    'message' => 'Salle de fête créée avec succès!'
                ]);
        } catch (\Exception $e) {
            DB::rollBack();
            
            Log::error('Erreur lors de la création de la salle de fête: ' . $e->getMessage());
            
            return redirect()->back()
                ->withInput()
                ->with('toast', [
                    'type' => 'error',
                    'message' => 'Une erreur est survenue lors de la création de la salle de fête: ' . $e->getMessage()
                ]);
        }
    }

    /**
     * Affiche les détails d'une salle de fête spécifique.
     *
     * @param  \App\Models\EventHall  $eventHall
     * @return \Illuminate\Http\Response
     */
    public function show(EventHall $eventHall)
    {
        $eventHall->load('hotel');
        
        return view('admin.event-hall.show', compact('eventHall'));
    }

    /**
     * Affiche le formulaire de modification d'une salle de fête.
     *
     * @param  \App\Models\EventHall  $eventHall
     * @return \Illuminate\Http\Response
     */
    public function edit(EventHall $eventHall)
    {
        $eventHall->load('hotel');
        
        return view('admin.event-hall.edit', compact('eventHall'));
    }

    /**
     * Met à jour la salle de fête spécifiée.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EventHall  $eventHall
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EventHall $eventHall)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'capacity' => 'required|integer|min:1',
            'event_type' => 'required|array',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        try {
            DB::beginTransaction();

            $eventHall->name = $request->name;
            $eventHall->description = $request->description;
            $eventHall->price = $request->price;
            $eventHall->capacity = $request->capacity;
            $eventHall->event_type = json_encode($request->event_type);

            if ($request->hasFile('photo')) {
                if ($eventHall->photo) {
                    Storage::disk('public')->delete($eventHall->photo);
                }
                $eventHall->photo = $request->file('photo')->store('event-halls', 'public');
            }

            $eventHall->save();

            DB::commit();

            return redirect()->route('admin.hotels.show', $eventHall->hotel_id)
                ->with('toast', [
                    'type' => 'success',
                    'message' => 'Salle de fête mise à jour avec succès!'
                ]);
        } catch (\Exception $e) {
            DB::rollBack();
            
            Log::error('Erreur lors de la mise à jour de la salle de fête: ' . $e->getMessage());
            
            return redirect()->back()
                ->withInput()
                ->with('toast', [
                    'type' => 'error',
                    'message' => 'Une erreur est survenue lors de la mise à jour de la salle de fête: ' . $e->getMessage()
                ]);
        }
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
            
            // Récupérer l'ID de l'hôtel avant de supprimer la salle
            $hotelId = $eventHall->hotel_id;
            
            // Supprimer la photo si elle existe
            if ($eventHall->photo) {
                Storage::disk('public')->delete($eventHall->photo);
            }
            
            // Supprimer la salle
            $eventHall->delete();
            
            DB::commit();
            
            return redirect()->route('admin.hotels.show', $hotelId)
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
            
            // Récupérer la première salle pour avoir l'hotel_id pour la redirection
            $firstHall = EventHall::find($request->ids[0]);
            $hotelId = $firstHall ? $firstHall->hotel_id : null;
            
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
            
            if ($hotelId) {
                return redirect()->route('admin.hotels.show', $hotelId)
                    ->with('toast', [
                        'type' => 'success',
                        'message' => count($request->ids) . ' salles de fête ont été supprimées avec succès.'
                    ]);
            } else {
                return redirect()->route('admin.hotels')
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
