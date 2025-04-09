<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hotel;

use Illuminate\Routing\Controller;

class HotelController extends Controller
{
     // 1. Ajoutez le constructeur ici
     public function __construct()
     {
         // Applique le middleware 'auth' à toutes les méthodes
         $this->middleware('auth');
         
         // Optionnel : appliquer à des méthodes spécifiques
         // $this->middleware('auth')->only(['create', 'store']);
     }

    // afficher le formulaire de creation
    public function create(){
        return view('hotels.create_hote');
    }

    public function store(Request $request){
        // Validation des données
        $validated = $request->validate([
            'nom_hotel' => 'required|string|max:255',
            'description_hotel' => 'required|string',
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

        // Créer l'hôtel
        Hotel::create($validated);

        // Redirection avec un message flash
        return redirect()->route('hotels.create')->with('success', 'Hôtel créé avec succès !');
    }

    public function selectHotel() {
        $hotels= Hotel::all();
        return view('hotels.select-hotel',compact('hotels'));
    }

    public function manageHotel(Hotel $hotel){
        // dd($hotel);
        $eventHalls = $hotel->eventHalls()
        ->with('ville') // Chargement relation ville (optionnel)
        ->paginate(6); // Pagination

        session(['selected_hotel' => $hotel->id]); // Enregistrer l'ID de l'hôtel dans la session

        return view('hotels.manage', compact('hotel', 'eventHalls'));
    }
}
