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
        // php artisan migrate --path=database/migrations/2025_04_18_210933_add_event_type_and_area_to_event_halls_table.php
        Schema::table('event_halls', function (Blueprint $table) {
            $table->string('event_type')->nullable();
            $table->decimal('area', 8, 2)->nullable();
            
        });
    }
    //php artisan migrate:rollback --path=/database/migrations/2025_04_18_210933_add_event_type_to_event_halls_table.php

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Supprime les colonnes area et event_type de la table event_halls
        Schema::table('event_halls', function (Blueprint $table) {
            //
            $table->dropColumn(['event_type', 'area']);
        });
    }
};
