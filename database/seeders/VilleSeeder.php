<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VilleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $villes = [
            'Douala',
            'Yamoussoukro',
            'Bouaké',
            'Daloa',
            'San-Pédro',
            'Korhogo',
            'Man',
            'Gagnoa',
            'Abengourou',
            'Divo'
        ];

        foreach ($villes as $nom) {
            Ville::create(['nom' => $nom]);
        }
    }
}
