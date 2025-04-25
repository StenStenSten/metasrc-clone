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
        Schema::table('game_matches', function (Blueprint $table) {
            // Make the 'items' column nullable
            $table->text('items')->nullable()->change(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('game_matches', function (Blueprint $table) {
            // Revert the 'items' column to non-nullable if rolled back
            $table->text('items')->nullable(false)->change();
        });
    }
};
