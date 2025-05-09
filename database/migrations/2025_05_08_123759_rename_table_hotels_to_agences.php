<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * Rename table 'hotel' to 'agence'.
     *
     * @return void
     */
    public function up(): void
    {
        if (Schema::hasTable('hotels')) {
            Schema::rename('hotels', 'agences');
        }
    }

    /**
     * Reverse the migrations.
     *
     * Rename table 'agence' back to 'hotel'.
     *
     * @return void
     */
    public function down(): void
    {
        if (Schema::hasTable('agences')) {
            Schema::rename('agences', 'hotels');
        }
    }
};
