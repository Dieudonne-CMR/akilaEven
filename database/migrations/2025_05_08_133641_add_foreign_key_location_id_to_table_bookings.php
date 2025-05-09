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
        Schema::table('bookings', function (Blueprint $table) {
            // 1. Modify event_hall_id to be nullable
            //    Requires doctrine/dbal for change()
            $table->dropForeign(['event_hall_id']);
            $table->unsignedBigInteger('event_hall_id')->nullable()->change();
            $table->foreign('event_hall_id')
                  ->references('id')
                  ->on('event_halls')
                  ->onDelete('cascade');

            // 2. Add the nullable foreign key column location_id
            $table->foreignId('location_id')
                  ->nullable()
                  ->constrained('locations')
                  ->onDelete('cascade');        
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            // 1. Revert event_hall_id to non-nullable
            $table->dropForeign(['event_hall_id']);
            $table->unsignedBigInteger('event_hall_id')->nullable(false)->change();
            $table->foreign('event_hall_id')
                  ->references('id')
                  ->on('event_halls')
                  ->onDelete('cascade');

            // 2. Drop the foreign key and column location_id
            $table->dropForeign(['location_id']);
            $table->dropColumn('location_id');
        });
    }
};
