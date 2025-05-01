<?php

use App\Http\Controllers\Api\ChampionController;
use App\Http\Controllers\Api\RiotDataController;
use Illuminate\Support\Facades\Route;

// Route for fetching champions
Route::get('champions', [ChampionController::class, 'getChampions']);

// Route for fetching and storing match data by match ID
Route::get('fetch-match/{matchId}', [RiotDataController::class, 'fetchAndStoreMatch']);

Route::get('fetch-by-summoner/{summonerName}', [RiotDataController::class, 'fetchMatchesBySummonerName']);
