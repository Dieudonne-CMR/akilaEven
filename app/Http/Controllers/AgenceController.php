<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Agence;

use Illuminate\Routing\Controller;

class AgenceController extends Controller
{
     // 1. Ajoutez le constructeur ici
     public function __construct()
     {
         // Applique le middleware 'auth' à toutes les méthodes
         $this->middleware('auth');
         
         // Optionnel : appliquer à des méthodes spécifiques
         // $this->middleware('auth')->only(['create', 'store']);
     }

    /**
     * Affiche le formulaire de création d'un agence.
     *
     * @return View
     */
    public function create(){
        return view('agences.create_hote');
    }

    /**
     * Traite la soumission du formulaire pour enregistrer un nouvel agence.
     *
     * @param  Request  $request
     * @return RedirectResponse
     */
    public function store(Request $request){
        // Validation des données
        $validated = $request->validate([
            'nom_agence' => 'required|string|max:255',
            'description_agence' => 'required|string',
            'telephone' => 'nullable|regex:/^[0-9]{10}$/',
            'email' => 'nullable|email',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'ville' => 'required|string|max:255',
            'localisation' => 'required|string|max:255',
            'bannier1' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'bannier2' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'bannier3' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
          
        ]);

        // Gérer les fichiers uploadés
        if($request->hasFile('logo')){
            $validated['logo']=  $request->file('logo')->store('logos', 'public');
        }

        for($i=1; $i<=3; $i++){
            $field = "bannier{$i}";
            if($request->hasFile($field)){
                $validated[$field]= $request->file($field)->store('banners', 'public');           
            }
        }
        // Ajouter l'utilisateur connecté
        $validated['mat_user'] = \Illuminate\Support\Facades\Auth::user()->id;

        // Créer l'agence
        Agence::create($validated);

        // Redirection avec un message flash
        return redirect()->route('agences.create')->with('success', 'Agence créé avec succès !');
    }

    /**
     * Affiche la liste des agences disponibles pour sélection.
     *
     * @return View
     */
    public function selectAgence() {
        $agences= Agence::all();
        return view('agences.select-agence',compact('agences'));
    }

    /**
     * Affiche l'interface de gestion d'un agence spécifique avec ses salles de fête.
     *
     * @param  Agence  $agence
     * @return View
     */
    public function manageAgence(Agence $agence){
        // dd($agence);
        $eventHalls = $agence->eventHalls()
        ->with('ville') // Chargement relation ville (optionnel)
        ->paginate(6); // Pagination

        session(['selected_agence' => $agence->id]); // Enregistrer l'ID de l'agence dans la session

        return view('agences.manage', compact('agence', 'eventHalls'));
    }
}
