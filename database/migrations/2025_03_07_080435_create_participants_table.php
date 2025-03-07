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
            $table->foreignId('match_id')->constrained()->onDelete('cascade');
            $table->integer('summoner_id'); // Store summoner id or username if needed
            $table->integer('champion_id'); // Champion ID or name
            $table->integer('kills');
            $table->integer('deaths');
            $table->integer('assists');
            $table->json('items'); // Store items in JSON format for this match
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('participants');
    }
}
