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
        Schema::create('game_matches', function (Blueprint $table) {
            $table->id();  // Auto-incrementing primary key
            $table->string('match_id')->unique();  // Match ID from Riot API (ensure uniqueness)
            $table->string('game_mode');  // Game mode like "Ranked", "ARAM", etc.
            $table->integer('queue_type'); 
            $table->text('items'); 
            $table->text('runes');
            $table->text('summoner_spells');
            $table->integer('kills');
            $table->integer('deaths');
            $table->integer('assists');
            $table->timestamps();  // Created at and updated at timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('game_matches');
    }
};
