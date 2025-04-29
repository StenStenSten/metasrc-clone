<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('match_types', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique(); // e.g., ARAM, Ranked Solo, Normal
            $table->timestamps();
        });

        // Optional: seed some default match types
        DB::table('match_types')->insert([
            ['name' => 'Ranked Solo', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Ranked Flex', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'ARAM', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Normal', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Clash', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Bot', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('match_types');
    }
};
