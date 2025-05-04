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
        
        Schema::table('event_halls', function (Blueprint $table) {
            // Liste des équipements de la salle de fête
            $table->json('equipments')->after('event_type');

            // Règlement d'utilisation de la salle (optionnel)
            $table->text('rules')->nullable()->after('equipments');

            // Statut de disponibilité
            $table->enum('status', ['available', 'unavailable'])
                    ->default('available')
                    ->after('rules');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    //php artisan migrate:rollback --path=/database/migrations/2025_05_02_133803_add_fields_to_event_halls_table.php
    public function down(): void
    {
        Schema::table('event_halls', function (Blueprint $table) {
            Schema::table('event_halls', function (Blueprint $table) {
                $table->dropColumn(['equipments', 'rules', 'status']);
            });
        });
    }
};
