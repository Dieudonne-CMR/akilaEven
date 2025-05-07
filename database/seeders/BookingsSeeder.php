<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Bookings;
use App\Models\EventHall;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Faker\Factory as Faker;

class BookingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        // Récupère tous les IDs de salles d'événement existantes
        $eventHallIds = EventHall::pluck('id')->toArray();

        // Génère 50 réservations
        foreach (range(1, 8) as $i) {
            $arrival   = $faker->dateTimeBetween('-1 month', '+1 month');
            $departure = (clone $arrival)->modify('+'.mt_rand(1, 5).' hours');
            $status    = $faker->randomElement(Bookings::STATUS);

            Bookings::create([
                'full_name'          => $faker->name,
                'email'              => $faker->unique()->safeEmail,
                'phone'              => $faker->phoneNumber,
                'address'            => $faker->streetAddress,
                'city'               => $faker->city,
                'arrival_time'       => Carbon::instance($arrival),
                'departure_time'     => Carbon::instance($departure),
                'status'             => $status,
                'message'            => $faker->text(200),
                'expires_at'         => $status === 'accepted'
                                        ? Carbon::instance($arrival)->addHours(24)
                                        : null,
                'total_price'        => $faker->randomFloat(2, 100, 2000),
                'event_hall_id'      => $faker->randomElement($eventHallIds),
                'confirmation_token' => Str::random(32),
                'confirmed_at'       => in_array($status, ['completed'])
                                        ? Carbon::instance($arrival)->addHour()
                                        : null,
            ]);
        }
    }
}
/**
 * 
 * Explications clés

    On utilise Faker pour générer du contenu réaliste (name, email, dates, etc.).

    On s’appuie sur la constante Bookings::STATUS pour choisir un statut valide.

    Les dates expires_at et confirmed_at sont conditionnelles selon le statut.

    On récupère les IDs de EventHall pour lier chaque booking à une salle existante.
 */