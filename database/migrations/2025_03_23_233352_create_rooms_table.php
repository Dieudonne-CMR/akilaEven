<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
          // On ne crée la table que si elle n'existe pas déjà
          if (!Schema::hasTable('rooms')) {
            Schema::create('rooms', function (Blueprint $table) {
                $table->id();
                $table->foreignId('hotel_id')
                      ->constrained()
                      ->onDelete('cascade');
                $table->string('nom_chambre');
                $table->text('description_chambre');
                $table->text('localisation');
                $table->integer('capacite');
                $table->decimal('prix', 10, 2);
                $table->string('photo')->nullable();
                $table->string('photo1')->nullable();
                $table->string('photo2')->nullable();
                $table->string('photo3')->nullable();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
