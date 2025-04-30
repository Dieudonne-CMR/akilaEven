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
        if(!Schema::hasTable('hotels')){
            Schema::create('hotels', function (Blueprint $table) {
                $table->id();
                $table->string('nom_hotel');
                $table->text('description_hotel');
                $table->string('logo')->nullable(); // Chemin vers le fichier
                $table->string('ville');
                $table->string('localisation'); // Adresse ou coordonnées GPS
                $table->string('bannier1')->nullable();
                $table->string('bannier2')->nullable();
                $table->string('bannier3')->nullable();
                $table->string('matricule_hotel')->unique(); // Identifiant unique
                $table->timestamp('date_at')->useCurrent(); // Date de création
                $table->unsignedBigInteger('mat_user'); // Clé étrangère
                
                // Clé étrangère vers la table users
                $table->foreign('mat_user')
                      ->references('id')
                      ->on('users')
                      ->onDelete('cascade');    
                $table->timestamps(); // created_at et updated_at
            });
        }   
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hotels');
    }
};
