<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GameMatch extends Model
{
    use HasFactory;

    protected $fillable = [
        'match_id', 
        'game_mode', 
        'queue_type',
        'game_type',  
        'game_version', 
        'game_start_time', 
        'duration' 
    ];

    public function participants()
    {
        return $this->hasMany(Participant::class);
    }
}
