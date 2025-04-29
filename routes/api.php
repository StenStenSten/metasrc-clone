<?php

use App\Http\Controllers\Api\ChampionController;
use App\Http\Controllers\Api\MatchController;
use Illuminate\Support\Facades\Route;

// Route for fetching champions
Route::get('champions', [ChampionController::class, 'getChampions']);


// Route for fetching match data
Route::get('fetch-match/{matchId}', [MatchController::class, 'fetchMatchData']);