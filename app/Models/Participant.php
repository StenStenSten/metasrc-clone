<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    use HasFactory;

    protected $fillable = [
        'match_id', 
        'summoner_id', 
        'puuid', 
        'champion_id', 
        'kills', 
        'deaths', 
        'assists', 
        'items'
    ];

    protected $casts = [
        'items' => 'array',  // Casts 'items' as an array for easier access
    ];

    // Relationship with GameMatch
    public function gameMatch()  
    {
        return $this->belongsTo(GameMatch::class);  
    }
}

