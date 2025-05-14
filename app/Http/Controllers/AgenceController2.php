<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Agence;
use App\Models\Location;
use App\Models\Ville;
use App\Models\EventHall;
use App\Http\Requests\StoreAgenceRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Exception;
use App\Helpers\InitialsHelper;  // ← import du helper
use Illuminate\Routing\Controller;
use App\Http\Requests\UpdateAgenceMediaRequest;

class AgenceController2 extends Controller
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
     * Affiche la liste des agences.
     *
     * @return View
     */
    public function index() {
        // Récupérer les agences avec le nombre de locations et de salles de fête
        $agences = Agence::withCount(['locations', 'eventHalls'])->get()->map(function ($agence) {
            $agence->initials = InitialsHelper::generate($agence->nom_agence);
            return $agence;
        });
        
        return view('admin.pages.agence.agences', compact('agences'));
    }

    /**
     * Affiche le formulaire de création d'un agence avec la liste des villes.
     *
     * @return View
     */
    public function create(){
        // Récupérer toutes les villes pour le formulaire
        $villes = Ville::orderBy('nom')->get();
        
        return view('admin.pages.agence.create-agence', compact('villes'));
    }

    /**
     * Traite la soumission du formulaire pour créer un nouvel agence.
     *
     * @param  StoreAgenceRequest  $request
     * @return RedirectResponse
     */
    public function store(StoreAgenceRequest $request){
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

            // Créer l'agence
            Agence::create($data);
            
             DB::commit();
 
            // Redirection avec message de succès
            return redirect()->route('admin.agences')
                ->with('success', [
                    'type' => 'success',
                    'message' => 'Agence créé avec succès!'
                ]);
                
         } catch (\Exception $e) {
            DB::rollBack();
            
            // Log l'erreur
            Log::error('Erreur lors de la création de l\'agence: ' . $e->getMessage());
            return redirect()->back(); 
            // Redirection avec message d'erreur et les anciennes données
             return redirect()->back()
                ->withInput()
                ->withErrors(['general' => 'Une erreur est survenue lors de la création de l\'agence: ' . $e->getMessage()])
                ->with('error','Une erreur est survenue lors de la création de l\'agence:');
        }
    }

    // Afficher les détails d'un agence
    public function show(Agence $agence){
        // Charger les relations avec le nombre d'éléments
        $agence->load(['locations', 'eventHalls']);
        
        return view('admin.pages.agence.show-agence', compact('agence'));
    }

    /**
     * Supprimer l'agence spécifié.
     *
     * @param  \App\Models\Agence  $agence
     * @return \Illuminate\Http\Response
     */
    public function destroy(Agence $agence)
    {
        
        try {
            DB::beginTransaction();
        
        
        // Essayer de supprimer l'agence avec forceDelete pour ignorer la soft delete
        // Supprimer les locations
        $locationCount = Location::where('agence_id', $agence->id)->delete();
        Log::info("{$locationCount} locations supprimées");
        
        // Supprimer les salles d'événements
        $hallCount = EventHall::where('agence_id', $agence->id)->delete();
        Log::info("{$hallCount} salles d'événements supprimées");
        
        // Supprimer les images
        $this->deleteAgenceImages($agence);
        
        // Supprimer l'agence en dernier
        $deleted = $agence->forceDelete();
        
        if (!$deleted) {
            // Si la suppression normale échoue, utiliser une requête SQL directe
            $forceDeleted = DB::table('agences')->where('id', $agence->id)->delete();
            
            if ($forceDeleted === 0) {
                throw new Exception("La suppression forcée a échoué");
            }
            
            Log::info("Agence ID:{$agence} supprimé avec succès (méthode SQL directe)");
        } else {
            Log::info("Agence ID:{$agence} supprimé avec succès (méthode normale)");
        }
        
        DB::commit();
        
        return response()->json([
            'success' => true,
            'message' => 'Agence supprimé avec succès.'
        ]);
        } catch (\Exception $e) {
            DB::rollBack();
            
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la suppression de l\'agence: ' . $e->getMessage()
            ], 500);
        }
    }
    
    /**
     * Supprimer plusieurs agences à la fois.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function bulkDestroy(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:agences,id'
        ]);
        
        try {
            DB::beginTransaction();
            
            $agences = Agence::whereIn('id', $request->ids)->get();
            
            foreach ($agences as $agence) {
                // Supprimer les images
                $this->deleteAgenceImages($agence);
                
                // Supprimer l'agence
                $agence->delete();
            }
            
            DB::commit();
            
            return response()->json([
                'success' => true,
                'message' => count($request->ids) . ' agences ont été supprimés avec succès.'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la suppression des agences: ' . $e->getMessage()
            ], 500);
        }
    }
    
    /**
     * Supprimer les images associées à un agence.
     *
     * @param  \App\Models\Agence  $agence
     * @return void
     */
    private function deleteAgenceImages(Agence $agence)
    {
        // Supprimer le logo s'il existe
        if ($agence->logo) {
            Storage::disk('public')->delete($agence->logo);
        }
        
        // Supprimer les bannières si elles existent
        if ($agence->bannier1) {
            Storage::disk('public')->delete($agence->bannier1);
        }
        
        if ($agence->bannier2) {
            Storage::disk('public')->delete($agence->bannier2);
        }
        
        if ($agence->bannier3) {
            Storage::disk('public')->delete($agence->bannier3);
        }
    }

    /**
     * Mettre à jour le logo et les bannières d'un agence.
     * 
     * @param  \App\Http\Requests\UpdateAgenceMediaRequest  $request
     * @param  \App\Models\Agence  $agence
     * @return \Illuminate\Http\Response
     */
    public function updateMedia(UpdateAgenceMediaRequest $request, Agence $agence)
    {
        try {
            DB::beginTransaction();
            
            // Récupérer les données validées
            $data = $request->validated();
            $updated = false;
            
            // Gérer le logo
            if ($request->hasFile('logo')) {
                // Supprimer l'ancien logo s'il existe
                if ($agence->logo) {
                    Storage::disk('public')->delete($agence->logo);
                }
                
                // Enregistrer le nouveau logo
                $agence->logo = $request->file('logo')->store('logos', 'public');
                $updated = true;
            }
            
            // Gérer les bannières
            for ($i = 1; $i <= 3; $i++) {
                $field = "bannier{$i}";
                
                if ($request->hasFile($field)) {
                    // Supprimer l'ancienne bannière s'il elle existe
                    if ($agence->$field) {
                        Storage::disk('public')->delete($agence->$field);
                    }
                    
                    // Enregistrer la nouvelle bannière
                    $agence->$field = $request->file($field)->store('banners', 'public');
                    $updated = true;
                }
            }
            
            // Sauvegarder les modifications
            if ($updated) {
                $agence->save();
            }
            
            DB::commit();
            
            return redirect()->route('admin.agences.show', $agence)
                ->with('toast', [
                    'type' => 'success',
                    'message' => 'Médias de l\'agence mis à jour avec succès!'
                ]);
                
        } catch (\Exception $e) {
            DB::rollBack();
            
            // Log l'erreur
            Log::error('Erreur lors de la mise à jour des médias de l\'agence: ' . $e->getMessage());
            
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
