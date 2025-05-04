<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        // Nécessite le package doctrine/dbal pour la méthode change()
        // 1. Transformer les valeurs existantes en JSON valide
        DB::statement("UPDATE event_halls SET event_type = JSON_ARRAY(event_type) WHERE event_type IS NOT NULL AND NOT JSON_VALID(event_type)");
        DB::statement("UPDATE event_halls SET event_type = '[]' WHERE event_type IS NULL OR event_type = ''");

        // 2. Modifier la colonne en JSON
        Schema::table('event_halls', function (Blueprint $table) {
            $table->json('event_type')->nullable()->change();
        });

        // 2. Modifier la colonne en JSON
        Schema::table('event_halls', function (Blueprint $table) {
            $table->json('event_type')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('event_halls', function (Blueprint $table) {
            // Revenir à chaine de caractères
            $table->string('event_type')->nullable()->change();
        });
    }
};
