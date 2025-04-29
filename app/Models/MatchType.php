<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MatchType extends Model
{
    use HasFactory;

    // If the table name is not the plural of the model name
    // protected $table = 'match_types'; // Uncomment this if needed

    protected $fillable = ['name'];
}
