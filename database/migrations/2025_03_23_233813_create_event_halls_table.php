<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Location;
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if(!Schema::hasTable('event_halls')){
            Schema::create('event_halls', function (Blueprint $table) {
                $table->id();
                $table->foreignId('agence_id')->constrained()->onDelete('cascade');
                $table->string('nom_salle');
                $table->text('description_salle');
                $table->text('localisation');
                $table->integer('capacite');
                $table->decimal('prix', 10, 2);
                $table->string('photo')->nullable();
                $table->string('photo1')->nullable();
                $table->string('photo2')->nullable();
                $table->string('photo3')->nullable();
                $table->string('photo4')->nullable();
                $table->timestamps();
                // Aire
                $table->decimal('area', 8, 2)->nullable();
                // Pour le type d'évènement
                $table->json('event_type')->nullable();
                // Liste des équipements de la salle de fête
                $table->json('equipments')->nullable();
                // Règlement d'utilisation de la salle (optionnel)
                $table->text('rules')->nullable();
                // Statut de disponibilité
                $table->enum('status', Location::STATUS)
                        ->default('available');
                        

            
            });
        }
    }
// php artisan migrate:rollback pour annuler ce qui a été fait dans le up
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
     
      
         Schema::dropIfExists('event_halls');
    }
};
