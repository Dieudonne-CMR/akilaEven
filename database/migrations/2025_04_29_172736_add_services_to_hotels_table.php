<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddServicesToHotelsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // php artisan migrate --path=database/migrations/2025_04_29_172736_add_services_to_hotels_table.php
        Schema::table('hotels', function (Blueprint $table) {
            $table->json('services')->nullable()->after('email');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('hotels', function (Blueprint $table) {
            $table->dropColumn('services');
        });
    }
}
