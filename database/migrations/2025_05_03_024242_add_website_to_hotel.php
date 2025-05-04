<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        // Nécessite le package doctrine/dbal pour la méthode change()
        Schema::table('event_halls', function (Blueprint $table) {
            // Transformer event_type en JSON pour stocker un tableau
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
