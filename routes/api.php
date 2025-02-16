<?php

use App\Http\Controllers\Api\ChampionController;
use Illuminate\Support\Facades\Route;

// Route for fetching champions
Route::get('champions', [ChampionController::class, 'getChampions']);


