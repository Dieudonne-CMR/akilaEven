<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Agence;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;


class AgenceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Récupère tous les IDs d'utilisateurs existants
        $userIds = User::pluck('id')->toArray();

        // Exemples d’agences avec images depuis Unsplash Source API
        $agences = [
            [
                'nom_agence'         => 'Agence du Lac',
                'description_agence' => 'Un bel agence au bord du lac avec vue panoramique.',
                'logo'              => 'https://images.unsplash.com/photo-1519225421980-715cb0215aed?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80',
                'ville'             => 'Douala',
                'localisation'      => 'Bepanda one to one',
                'bannier1'          => 'https://images.unsplash.com/photo-1515169067868-5387ec356754?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80',
                'bannier2'          => 'https://images.unsplash.com/photo-1464366400600-7168b8af9bc3?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80',
                'bannier3'          => null,
                'date_at'           => Carbon::now()->subDays(10),
                'mat_user'          => Arr::random($userIds),
                'telephone'         => '237699000001',
                'email'             => 'borismbakop611@gmail.com',
                'services'          => ['wifi', 'parking', 'piscine', 'restaurant', 'spa'],
            ],
            [
                'nom_agence'         => 'Résidence Palmier',
                'description_agence' => 'Charme et confort en plein cœur de la ville.',
                'logo'              => 'https://images.unsplash.com/photo-1517457373958-b7bdd4587205?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1469&q=80',
                'ville'             => 'Yaoundé',
                'localisation'      => 'Rue du Marché, Yaoundé',
                'bannier1'          => 'https://images.unsplash.com/photo-1414235077428-338989a2e8c0?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80',
                'bannier2'          => null,
                'bannier3'          => null,
                'date_at'           => Carbon::now()->subDays(5),
                'mat_user'          => Arr::random($userIds),
                'telephone'         => '237699000002',
                'email'             => 'mbakopngako@gmail.com',
                'services'          => ['wifi', 'service en location', 'salle de gym'],
            ],
            [
                'nom_agence'         => 'Lodge Safari',
                'description_agence' => 'Immersion nature et safaris aux portes du parc national.',
                'logo'              => 'https://images.unsplash.com/photo-1414235077428-338989a2e8c0?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80',
                'ville'             => 'Kribi',
                'localisation'      => 'Route du Parc, Kribi',
                'bannier1'          => 'https://images.unsplash.com/photo-1519671482749-fd09be7ccebf?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80',
                'bannier2'          => 'https://images.unsplash.com/photo-1505236858219-8359eb29e329?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1562&q=80',
                'bannier3'          => null,
                'date_at'           => Carbon::now(),
                'mat_user'          => Arr::random($userIds),
                'telephone'         => '237699000003',
                'email'             => 'borismbakop611@gmail.com',
                'services'          => ['wifi', 'parking', 'terrain de tennis', 'bar'],
            ],
        ];

        foreach ($agences as $data) {
            Agence::create($data);
        }
        // ou bien avec la factory
        /* Agence::factory()->count(4)->create(); */
    }
}
