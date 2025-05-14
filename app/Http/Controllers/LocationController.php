<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\Agence;
use App\Models\Ville;
use App\Http\Requests\StoreLocationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Helpers\ToastHelper;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
class LocationController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    /**
     * Afficher la liste des locations.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $locations = Location::with(['agence', 'ville'])->get();
        
        // Préparer les filtres disponibles
        $filters = [
            'all' => [
                'label' => 'Toutes les locations',
                'dot_class' => ''
            ],
            'meublé' => [
                'label' => 'Meublé',
                'dot_class' => 'bg-blue-500'
            ],
            'habitation' => [
                'label' => 'Habitation',
                'dot_class' => 'bg-green-500'
            ]
        ];
        
        return view('admin.pages.location.locations', compact('locations', 'filters'));
    }

    /**
     * Supprimer plusieurs locations.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function bulkDestroy(Request $request)
    {
        try {
            $ids = $request->input('ids', []);
            
            if (empty($ids)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Aucune location sélectionnée'
                ]);
            }
            
            // Récupérer les locations à supprimer pour obtenir leurs images
            $locations = Location::whereIn('id', $ids)->get();
            
            // Supprimer les images associées
            foreach ($locations as $location) {
                if ($location->photo) {
                    Storage::disk('public')->delete($location->photo);
                }
                if ($location->photo1) {
                    Storage::disk('public')->delete($location->photo1);
                }
                if ($location->photo2) {
                    Storage::disk('public')->delete($location->photo2);
                }
                if ($location->photo3) {
                    Storage::disk('public')->delete($location->photo3);
                }
            }
            
            // Supprimer les locations
            Location::whereIn('id', $ids)->delete();
            
            return response()->json([
                'success' => true,
                'message' => count($ids) . ' locations ont été supprimées avec succès'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Une erreur est survenue lors de la suppression: ' . $e->getMessage()
            ]);
        }
    }

    /**
     * Afficher le formulaire de création d'une location.
     *
     * @param  \App\Models\Agence  $agence
     * @return \Illuminate\Http\Response
     */
    public function create(Agence $agence)
    {
        $villes = Ville::all();
       
        return view('admin.pages.location.create-location', compact('agence', 'villes'));
    }

    /**
     * Enregistrer une nouvelle location.
     *
     * @param  \App\Http\Requests\StoreLocationRequest  $request
     * @param  \App\Models\Agence  $agence
     * @return \Illuminate\Http\Response
     */
    public function store(StoreLocationRequest $request, Agence $agence)
    {
        try {
            // Préparer les données validées
            $data = $request->validated();
            $data['agence_id'] = $agence->id;           
            $data['status'] = 'available';

            // Gestion de l'upload de l'image principale
            if ($request->hasFile('photo')) {
                $mainImage = $request->file('photo');
                $mainImageName = 'main_' . time() . '_' . Str::random(10) . '.' . $mainImage->getClientOriginalExtension();
                $mainImagePath = $mainImage->storeAs('locations', $mainImageName, 'public');
                $data['photo'] = $mainImagePath;
            }

            // Gestion des images additionnelles
            $additionalFields = ['photo1', 'photo2', 'photo3'];
            
            if ($request->hasFile('additional_images')) {
                $additionalImages = $request->file('additional_images');
                
                foreach ($additionalImages as $index => $image) {
                    if ($image && $index < count($additionalFields)) {
                        $additionalImageName = 'additional_' . time() . '_' . Str::random(10) . '_' . $index . '.' . $image->getClientOriginalExtension();
                        $additionalImagePath = $image->storeAs('locations', $additionalImageName, 'public');
                        $data[$additionalFields[$index]] = $additionalImagePath;
                    }
                }
            }

            // Créer la location
            $location = Location::create($data);

            return redirect()->route('admin.location.create', $agence->id)
                ->with('success', 'Location créée avec succès!');
        } catch (\Exception $e) {
            // En cas d'erreur, supprimer les fichiers uploadés
            if (isset($data['photo'])) {
                Storage::disk('public')->delete($data['photo']);
            }
            if (isset($data['photo1'])) {
                Storage::disk('public')->delete($data['photo1']);
            }
            if (isset($data['photo2'])) {
                Storage::disk('public')->delete($data['photo2']);
            }
            if (isset($data['photo3'])) {
                Storage::disk('public')->delete($data['photo3']);
            }

            return redirect()->back()
                ->withInput()
                ->with('error', 'Une erreur est survenue lors de la création de la location' 
                /* . $e->getMessage() */
            );
        }
    }

    /**
     * Afficher les détails d'une location.
     *
     * @param  \App\Models\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function show(Location $location)
    {
        return view('admin.pages.location.show-location', compact('location'));
    }

    /**
     * Afficher le formulaire d'édition d'une location.
     *
     * @param  \App\Models\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function edit(Location $location)
    {
        return view('admin.pages.location.edit-location', compact('location'));
    }

    /**
     * Mettre à jour une location.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Location $location)
    {
        $request->validate([
            'nom_location' => 'required|string|max:255',
            'description_location' => 'required|string',
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
            if ($location->photo) {
                Storage::disk('public')->delete($location->photo);
            }
            $data['photo'] = $request->file('photo')->store('locations', 'public');
        }
        
        if ($request->hasFile('photo1')) {
            if ($location->photo1) {
                Storage::disk('public')->delete($location->photo1);
            }
            $data['photo1'] = $request->file('photo1')->store('locations', 'public');
        }
        
        if ($request->hasFile('photo2')) {
            if ($location->photo2) {
                Storage::disk('public')->delete($location->photo2);
            }
            $data['photo2'] = $request->file('photo2')->store('locations', 'public');
        }
        
        if ($request->hasFile('photo3')) {
            if ($location->photo3) {
                Storage::disk('public')->delete($location->photo3);
            }
            $data['photo3'] = $request->file('photo3')->store('locations', 'public');
        }

        // Mettre à jour la location
        $location->update($data);

        return redirect()->route('admin.agences.show', $location->agence_id)
            ->with('success', 'Location mise à jour avec succès');
    }

    /**
     * Supprimer une location.
     *
     * @param  \App\Models\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function destroy(Location $location)
    {
        $agenceId = $location->agence_id;
        
        // Supprimer les images
        if ($location->photo) {
            Storage::disk('public')->delete($location->photo);
        }
        
        if ($location->photo1) {
            Storage::disk('public')->delete($location->photo1);
        }
        
        if ($location->photo2) {
            Storage::disk('public')->delete($location->photo2);
        }
        
        if ($location->photo3) {
            Storage::disk('public')->delete($location->photo3);
        }
        
        // Supprimer la location
        $location->delete();
        
        return redirect()->route('admin.pages.agences.show', $agenceId)
            ->with('error', 'Location supprimée avec succès');
    }
}
