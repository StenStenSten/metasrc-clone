<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParticipantsTable extends Migration
{
    public function up()
    {
        Schema::create('participants', function (Blueprint $table) {
            $table->id();

            // Foreign key linking to the game_matches table
            $table->foreignId('match_id')->constrained('game_matches')->onDelete('cascade');

            // Riot API data
            $table->string('puuid'); // Riot's globally unique player ID
            $table->string('summoner_name'); // Optional but helpful
            $table->integer('champion_id');
            $table->integer('champ_level')->nullable();
            $table->integer('team_id')->nullable(); // 100 or 200
            $table->integer('kills')->nullable();
            $table->integer('deaths')->nullable();
            $table->integer('assists')->nullable();

            // Items & runes
            $table->json('items')->nullable(); // Items 0–6 or more as array
            $table->json('runes')->nullable(); // primary + secondary paths

            // Summoner spells
            $table->integer('spell1_id')->nullable();
            $table->integer('spell2_id')->nullable();

            // Other stats (if you want later)
            $table->boolean('win')->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('participants');
    }
}
