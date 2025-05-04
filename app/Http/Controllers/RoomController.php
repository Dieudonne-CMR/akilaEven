<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Hotel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Helpers\ToastHelper;

class RoomController extends Controller
{
    /**
     * Afficher le formulaire de création d'une chambre.
     *
     * @param  \App\Models\Hotel  $hotel
     * @return \Illuminate\Http\Response
     */
    public function create(Hotel $hotel)
    {
        return view('admin.room.create', compact('hotel'));
    }

    /**
     * Enregistrer une nouvelle chambre.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Hotel  $hotel
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Hotel $hotel)
    {
        $request->validate([
            'nom_chambre' => 'required|string|max:255',
            'description_chambre' => 'required|string',
            'localisation' => 'required|string|max:255',
            'capacite' => 'required|integer|min:1',
            'prix' => 'required|numeric|min:0',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'photo1' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'photo2' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'photo3' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Préparer les données
        $data = $request->except(['photo', 'photo1', 'photo2', 'photo3']);
        $data['hotel_id'] = $hotel->id;
        
        // Gérer les uploads d'images
        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('rooms', 'public');
        }
        
        if ($request->hasFile('photo1')) {
            $data['photo1'] = $request->file('photo1')->store('rooms', 'public');
        }
        
        if ($request->hasFile('photo2')) {
            $data['photo2'] = $request->file('photo2')->store('rooms', 'public');
        }
        
        if ($request->hasFile('photo3')) {
            $data['photo3'] = $request->file('photo3')->store('rooms', 'public');
        }

        // Créer la chambre
        Room::create($data);

        return redirect()->route('admin.hotels.show', $hotel)
            ->with('toast', ToastHelper::success('Chambre créée avec succès!'));
    }

    /**
     * Afficher les détails d'une chambre.
     *
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function show(Room $room)
    {
        return view('admin.room.show', compact('room'));
    }

    /**
     * Afficher le formulaire d'édition d'une chambre.
     *
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function edit(Room $room)
    {
        return view('admin.room.edit', compact('room'));
    }

    /**
     * Mettre à jour une chambre.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Room $room)
    {
        $request->validate([
            'nom_chambre' => 'required|string|max:255',
            'description_chambre' => 'required|string',
            'localisation' => 'required|string|max:255',
            'capacite' => 'required|integer|min:1',
            'prix' => 'required|numeric|min:0',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'photo1' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'photo2' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'photo3' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Préparer les données
        $data = $request->except(['photo', 'photo1', 'photo2', 'photo3']);
        
        // Gérer les uploads d'images
        if ($request->hasFile('photo')) {
            // Supprimer l'ancienne image
            if ($room->photo) {
                Storage::disk('public')->delete($room->photo);
            }
            $data['photo'] = $request->file('photo')->store('rooms', 'public');
        }
        
        if ($request->hasFile('photo1')) {
            if ($room->photo1) {
                Storage::disk('public')->delete($room->photo1);
            }
            $data['photo1'] = $request->file('photo1')->store('rooms', 'public');
        }
        
        if ($request->hasFile('photo2')) {
            if ($room->photo2) {
                Storage::disk('public')->delete($room->photo2);
            }
            $data['photo2'] = $request->file('photo2')->store('rooms', 'public');
        }
        
        if ($request->hasFile('photo3')) {
            if ($room->photo3) {
                Storage::disk('public')->delete($room->photo3);
            }
            $data['photo3'] = $request->file('photo3')->store('rooms', 'public');
        }

        // Mettre à jour la chambre
        $room->update($data);

        return redirect()->route('admin.hotels.show', $room->hotel_id)
            ->with('toast', ToastHelper::success('Chambre mise à jour avec succès!'));
    }

    /**
     * Supprimer une chambre.
     *
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function destroy(Room $room)
    {
        $hotelId = $room->hotel_id;
        
        // Supprimer les images
        if ($room->photo) {
            Storage::disk('public')->delete($room->photo);
        }
        
        if ($room->photo1) {
            Storage::disk('public')->delete($room->photo1);
        }
        
        if ($room->photo2) {
            Storage::disk('public')->delete($room->photo2);
        }
        
        if ($room->photo3) {
            Storage::disk('public')->delete($room->photo3);
        }
        
        // Supprimer la chambre
        $room->delete();
        
        return redirect()->route('admin.hotels.show', $hotelId)
            ->with('toast', ToastHelper::success('Chambre supprimée avec succès!'));
    }
}
