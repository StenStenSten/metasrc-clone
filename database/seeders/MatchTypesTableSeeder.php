<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\MatchType;

class MatchTypesTableSeeder extends Seeder
{
    public function run(): void
    {
        $types = [
            'ARAM',
            'Ranked Solo',
            'Ranked Flex',
            'Normal',
            'Clash',
            'URF',
        ];
    
        foreach ($types as $type) {
            MatchType::firstOrCreate(['name' => $type]);
        }
    }
}
