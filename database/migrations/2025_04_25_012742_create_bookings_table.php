<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Bookings;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {   // php artisan migrate --path=database/migrations/2025_04_25_012742_create_bookings_table.php
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();

            // Référence à la salle d'événement
            $table->foreignId('event_hall_id')
                  ->constrained()
                  ->onDelete('cascade');

            // Infos du client
            $table->string('full_name');            
            $table->string('email');
            $table->string('phone');
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('region')->nullable();
            $table->string('country')->nullable();
            $table->string("message");

            // Horaires de l'événement
            $table->dateTime('arrival_time');
            $table->dateTime('departure_time');

            // Statut de la réservation
            $table->enum('status', Bookings::STATUS)
                  ->default('pending');

            // Expiration 24 h après acceptation
            $table->dateTime('expires_at')->nullable();

            // Montant total calculé (prix * durée + (taxe * durée))
            $table->decimal('total_price', 10, 2)->nullable();
            $table->string('confirmation_token', 64)->nullable()->unique();
            // Date à laquelle la réservation a été confirmée(statut réservation acceptée)
            $table->timestamp('confirmed_at')->nullable();
           
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
