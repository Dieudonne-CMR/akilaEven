<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
// php artisan migrate:fresh --seed pour lancer le seeder
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Enregistrer le seeder
       
        $this->call([
            
            EventHallSeeder::class,
        ]);
         /* User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]); */
        // User::factory(10)->create();
        
       
    }

}
