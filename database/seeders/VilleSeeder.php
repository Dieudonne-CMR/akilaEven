<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Ville;
class VilleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $villes = [
            'Douala',
            'Yaoundé',
            'Buéa',
            'Kribi',
            'Bafoussam',
            
        ];

        foreach ($villes as $nom) {
            Ville::create(['nom' => $nom]);
        }
    }
}
