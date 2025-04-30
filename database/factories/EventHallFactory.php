<?php

namespace Database\Factories;

use App\Models\EventHall;
use App\Models\Ville;
use App\Models\User;
use App\Models\Hotel;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
//On crée le factory avec la commande php artisan make:factory EventHallFactory --model=EventHall

class EventHallFactory extends Factory
{
    protected $model = EventHall::class;

    public function definition(): array
    {
        // Récupère aléatoirement un id existant pour les relations
        $villeId = Ville::inRandomOrder()->first()?->id;
        $hotelId = Hotel::inRandomOrder()->first()?->id;
        $userId  = User::inRandomOrder()->first()?->id;
        // 1. Parcours le dossier public/.../event_halls
        $files = File::files(public_path('assets_site/images_site/event_halls'));
        
        // 2. Choisit au hasard l'un d'entre eux et récupère son nom de fichier
        $fileName = $this->faker->randomElement($files)->getFilename();
        return [
            'nom_salle'          => $this->faker->words(3, true),         // ex. "Grand Salon Royal"
            'description_salle'  => $this->faker->paragraph(),            // texte libre
            'localisation'       => $this->faker->address(),              // adresse factice
            'capacite'           => $this->faker->numberBetween(50, 500), // nombre entre 50 et 500
            'area'               => $this->faker->randomFloat(2, 50, 800),// float 2 décimales
            'prix'               => $this->faker->randomFloat(2, 100, 2000), 
            // Pour les photos, on peut stocker un chemin ou URL placeholder
           /*  'photo'              => 'event_halls/' . $this->faker->image('storage/app/public/event_halls', 640, 480, null, false), */
             // 3. Génère l'URL publique via le disque "public"
        //    /storage/event_halls/nom_de_fichier.jpg
            'photo' => "event_halls/{$fileName}",
            'photo1'             => null,
            'photo2'             => null,
            'photo3'             => null,
            'photo4'             => null,
            'event_type'         => $this->faker->randomElement(['conference', 'mariage', 'concert', 'cocktail']),
            'ville_id'           => $villeId,
            'hotel_id'           => $hotelId,
            'user_id'            => $userId,
        ];
    }
}
