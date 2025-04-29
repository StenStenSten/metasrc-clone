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
            $table->id(); // Auto-incrementing primary key
            $table->string('match_id')->unique(); // Match ID from Riot API (ensure uniqueness)
            $table->string('game_mode')->nullable(); // e.g., "CLASSIC"
            $table->string('game_type')->nullable(); // e.g., "MATCHED_GAME"
            $table->integer('queue_type')->nullable(); // e.g., 420, 440, etc.
            $table->string('game_version')->nullable(); // Patch version
            $table->timestamp('game_start_time')->nullable(); // Converted from Unix timestamp
            $table->integer('duration')->nullable(); // Game duration in seconds or minutes

            // New: foreign key to match_types table
            $table->foreignId('match_type_id')->nullable()->constrained('match_types')->onDelete('set null');

            $table->timestamps(); // created_at and updated_at
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
