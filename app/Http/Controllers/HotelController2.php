<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Hotel;
use App\Models\Room;
use App\Models\Ville;
use App\Models\EventHall;
use App\Http\Requests\StoreHotelRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Exception;
use App\Helpers\InitialsHelper;  // ← import du helper
use Illuminate\Routing\Controller;
use App\Http\Requests\UpdateHotelMediaRequest;

class HotelController2 extends Controller
{
     // 1. Ajoutez le constructeur ici
     public function __construct()
     {
         // Applique le middleware 'auth' à toutes les méthodes
         /* $this->middleware('auth'); */
         
         // Optionnel : appliquer à des méthodes spécifiques
         // $this->middleware('auth')->only(['create', 'store']);
     }


    /**
     * Affiche la liste des hôtels.
     *
     * @return View
     */
    public function index() {
        // Récupérer les hôtels avec le nombre de chambres et de salles de fête
        $hotels = Hotel::withCount(['rooms', 'eventHalls'])->get()->map(function ($hotel) {
            $hotel->initials = InitialsHelper::generate($hotel->nom_hotel);
            return $hotel;
        });
        
        return view('admin.hotel.hotels', compact('hotels'));
    }

    /**
     * Affiche le formulaire de création d'un hôtel avec la liste des villes.
     *
     * @return View
     */
    public function create(){
        // Récupérer toutes les villes pour le formulaire
        $villes = Ville::orderBy('nom')->get();
        
        return view('admin.hotel.create-hotel', compact('villes'));
    }

    /**
     * Traite la soumission du formulaire pour créer un nouvel hôtel.
     *
     * @param  StoreHotelRequest  $request
     * @return RedirectResponse
     */
    public function store(StoreHotelRequest $request){
         try {
            DB::beginTransaction();
            
            // Récupérer les données validées
            $data = $request->validated();
            
            // Gérer les uploads d'images
            if ($request->hasFile('logo')) {
                $data['logo'] = $request->file('logo')->store('logos', 'public');
            }
            
            if ($request->hasFile('bannier1')) {
                $data['bannier1'] = $request->file('bannier1')->store('banners', 'public');
            }
            
            if ($request->hasFile('bannier2')) {
                $data['bannier2'] = $request->file('bannier2')->store('banners', 'public');
            }
            
            if ($request->hasFile('bannier3')) {
                $data['bannier3'] = $request->file('bannier3')->store('banners', 'public');
            }
            
            // Ajouter l'ID de l'utilisateur connecté
            $data['mat_user'] = Auth::check() ? Auth::id() : 1; // Fallback à 1 pour le développement
            
            // Sérialiser les services si présents
            if (isset($data['services'])) {
                $data['services'] = json_encode($data['services']);
            }

            // Créer l'hôtel
            Hotel::create($data);
            
             DB::commit();
 
            // Redirection avec message de succès
            return redirect()->route('admin.hotels')
                ->with('success', [
                    'type' => 'success',
                    'message' => 'Hôtel créé avec succès!'
                ]);
                
         } catch (\Exception $e) {
            DB::rollBack();
            
            // Log l'erreur
            Log::error('Erreur lors de la création de l\'hôtel: ' . $e->getMessage());
            return redirect()->back(); 
            // Redirection avec message d'erreur et les anciennes données
             return redirect()->back()
                ->withInput()
                ->withErrors(['general' => 'Une erreur est survenue lors de la création de l\'hôtel: ' . $e->getMessage()])
                ->with('toast', [
                    'type' => 'error',
                    'message' => 'Une erreur est survenue lors de la création de l\'hôtel: ' . $e->getMessage()
                ]);
        }
    }

    // Afficher les détails d'un hôtel
    public function show(Hotel $hotel){
        // Charger les relations avec le nombre d'éléments
        $hotel->load(['rooms', 'eventHalls']);
        
        return view('admin.hotel.show-hotel', compact('hotel'));
    }

    /**
     * Supprimer l'hôtel spécifié.
     *
     * @param  \App\Models\Hotel  $hotel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Hotel $hotel)
    {
        
        try {
            DB::beginTransaction();
        
        
        // Essayer de supprimer l'hôtel avec forceDelete pour ignorer la soft delete
        // Supprimer les chambres
        $roomCount = Room::where('hotel_id', $hotel->id)->delete();
        Log::info("{$roomCount} chambres supprimées");
        
        // Supprimer les salles d'événements
        $hallCount = EventHall::where('hotel_id', $hotel->id)->delete();
        Log::info("{$hallCount} salles d'événements supprimées");
        
        // Supprimer les images
        $this->deleteHotelImages($hotel);
        
        // Supprimer l'hôtel en dernier
        $deleted = $hotel->forceDelete();
        
        if (!$deleted) {
            // Si la suppression normale échoue, utiliser une requête SQL directe
            $forceDeleted = DB::table('hotels')->where('id', $hotel->id)->delete();
            
            if ($forceDeleted === 0) {
                throw new Exception("La suppression forcée a échoué");
            }
            
            Log::info("Hôtel ID:{$hotel} supprimé avec succès (méthode SQL directe)");
        } else {
            Log::info("Hôtel ID:{$hotel} supprimé avec succès (méthode normale)");
        }
        
        DB::commit();
        
        return response()->json([
            'success' => true,
            'message' => 'Hôtel supprimé avec succès.'
        ]);
        } catch (\Exception $e) {
            DB::rollBack();
            
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la suppression de l\'hôtel: ' . $e->getMessage()
            ], 500);
        }
    }
    
    /**
     * Supprimer plusieurs hôtels à la fois.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function bulkDestroy(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:hotels,id'
        ]);
        
        try {
            DB::beginTransaction();
            
            $hotels = Hotel::whereIn('id', $request->ids)->get();
            
            foreach ($hotels as $hotel) {
                // Supprimer les images
                $this->deleteHotelImages($hotel);
                
                // Supprimer l'hôtel
                $hotel->delete();
            }
            
            DB::commit();
            
            return response()->json([
                'success' => true,
                'message' => count($request->ids) . ' hôtels ont été supprimés avec succès.'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la suppression des hôtels: ' . $e->getMessage()
            ], 500);
        }
    }
    
    /**
     * Supprimer les images associées à un hôtel.
     *
     * @param  \App\Models\Hotel  $hotel
     * @return void
     */
    private function deleteHotelImages(Hotel $hotel)
    {
        // Supprimer le logo s'il existe
        if ($hotel->logo) {
            Storage::disk('public')->delete($hotel->logo);
        }
        
        // Supprimer les bannières si elles existent
        if ($hotel->bannier1) {
            Storage::disk('public')->delete($hotel->bannier1);
        }
        
        if ($hotel->bannier2) {
            Storage::disk('public')->delete($hotel->bannier2);
        }
        
        if ($hotel->bannier3) {
            Storage::disk('public')->delete($hotel->bannier3);
        }
    }

    /**
     * Mettre à jour le logo et les bannières d'un hôtel.
     * 
     * @param  \App\Http\Requests\UpdateHotelMediaRequest  $request
     * @param  \App\Models\Hotel  $hotel
     * @return \Illuminate\Http\Response
     */
    public function updateMedia(UpdateHotelMediaRequest $request, Hotel $hotel)
    {
        try {
            DB::beginTransaction();
            
            // Récupérer les données validées
            $data = $request->validated();
            $updated = false;
            
            // Gérer le logo
            if ($request->hasFile('logo')) {
                // Supprimer l'ancien logo s'il existe
                if ($hotel->logo) {
                    Storage::disk('public')->delete($hotel->logo);
                }
                
                // Enregistrer le nouveau logo
                $hotel->logo = $request->file('logo')->store('logos', 'public');
                $updated = true;
            }
            
            // Gérer les bannières
            for ($i = 1; $i <= 3; $i++) {
                $field = "bannier{$i}";
                
                if ($request->hasFile($field)) {
                    // Supprimer l'ancienne bannière s'il elle existe
                    if ($hotel->$field) {
                        Storage::disk('public')->delete($hotel->$field);
                    }
                    
                    // Enregistrer la nouvelle bannière
                    $hotel->$field = $request->file($field)->store('banners', 'public');
                    $updated = true;
                }
            }
            
            // Sauvegarder les modifications
            if ($updated) {
                $hotel->save();
            }
            
            DB::commit();
            
            return redirect()->route('admin.hotels.show', $hotel)
                ->with('toast', [
                    'type' => 'success',
                    'message' => 'Médias de l\'hôtel mis à jour avec succès!'
                ]);
                
        } catch (\Exception $e) {
            DB::rollBack();
            
            // Log l'erreur
            Log::error('Erreur lors de la mise à jour des médias de l\'hôtel: ' . $e->getMessage());
            
            // Redirection avec message d'erreur
            return redirect()->back()
                ->withInput()
                ->with('toast', [
                    'type' => 'error',
                    'message' => 'Une erreur est survenue lors de la mise à jour des médias: ' . $e->getMessage()
                ]);
        }
    }
}
