<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\EventHall;
// On génère le seeder avec la commande php artisan make:seeder EventHallSeeder --model=EventHall
class EventHallSeeder extends Seeder
{
    public function run(): void
    {
        // Crée 20 salles d’événements
        EventHall::factory()
            ->count(2)
            ->create();
    }
}
