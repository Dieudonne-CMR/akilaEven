<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Hotel;
use App\Models\Room;
use App\Models\EventHall;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Exception;

use Illuminate\Routing\Controller;

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
        $hotels = Hotel::withCount(['rooms', 'eventHalls'])->get();
        
        return view('admin.hotel.hotels', compact('hotels'));
    }
    public function create(){
        return view('admin.hotel.create-hotel');
        
    }
    public function store(Request $request){
        $request->validate([
            'nom_hotel' => 'required|string|max:255',
            'description_hotel' => 'required|string',
            'ville' => 'required|string|max:255',
            'localisation' => 'required|string|max:255',
            'telephone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'bannier1' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'bannier2' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'bannier3' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'services' => 'nullable|array',
        ]);

        // Gérer les uploads d'images
        $data = $request->except(['logo', 'bannier1', 'bannier2', 'bannier3']);
        
        if ($request->hasFile('logo')) {
            $data['logo'] = $request->file('logo')->store('hotels/logos', 'public');
        }
        
        if ($request->hasFile('bannier1')) {
            $data['bannier1'] = $request->file('bannier1')->store('hotels/banners', 'public');
        }
        
        if ($request->hasFile('bannier2')) {
            $data['bannier2'] = $request->file('bannier2')->store('hotels/banners', 'public');
        }
        
        if ($request->hasFile('bannier3')) {
            $data['bannier3'] = $request->file('bannier3')->store('hotels/banners', 'public');
        }
        
        // Ajouter l'identifiant de l'utilisateur connecté
        $data['mat_user'] = Auth::check() ? Auth::id() : 1; // Fallback à 1 pour le développement
        
        // Sérialiser les services si présents
        if (isset($data['services'])) {
            $data['services'] = json_encode($data['services']);
        }

        Hotel::create($data);

        return redirect()->route('admin.hotels')
            ->with('toast', [
                'type' => 'success',
                'message' => 'Hôtel créé avec succès!'
            ]);
    }
    // Afficher les détails d'un hôtel
    public function show(Hotel $hotel){
        // Charger les relations avec le nombre d'éléments
        $hotel->load(['rooms', 'eventHalls']);
        
        return view('admin.hotel.show', compact('hotel'));
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
}
