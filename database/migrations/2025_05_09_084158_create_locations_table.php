<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Location;
return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('locations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('agence_id')->constrained()->onDelete('cascade');
            $table->string('nom_location');
            $table->text('description_location')->nullable();
            $table->string('localisation');
            $table->decimal('area', 10, 2)->nullable();
            $table->enum('type_location', Location::TYPE_LOCATION);
            $table->enum('type_logement', Location::TYPE_LOGEMENT);              
            $table->json('equipments')->nullable();
            $table->text('rules')->nullable();
            $table->enum('status', Location::STATUS);
            $table->foreignId('ville_id')->constrained();
           /*  ->onDelete('cascade'); */
            $table->foreignId('user_id')->constrained();
            /* ->onDelete('cascade'); */
            $table->decimal('prix', 15, 2);
            $table->string('photo');
            $table->string('photo1')->nullable();
            $table->string('photo2')->nullable();
            $table->string('photo3')->nullable();            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    //php artisan migrate:rollback --path=/database/migrations/2025_05_09_084158_create_locations_table.php
    public function down()
    {
        Schema::dropIfExists('locations');
    }
};
