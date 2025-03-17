<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LeagueController;
use App\Http\Controllers\TftController;
use App\Http\Controllers\ValoController;
use App\Http\Controllers\Api\ChampionController;
use App\Http\Controllers\Api\ChampionBuildController;
use App\Http\Controllers\RiotController;

Route::get('/', function () {
    return view('home');
});

// League Routes
Route::get('/league/ranked', [LeagueController::class, 'ranked'])->name('league.ranked');
Route::get('/league/aram', [LeagueController::class, 'aram'])->name('league.aram');
Route::get('/league/arena', [LeagueController::class, 'arena'])->name('league.arena');
Route::get('/league/swiftplay', [LeagueController::class, 'swiftplay'])->name('league.swiftplay');

// Fetch league champions from API (you can adjust this if needed)
Route::get('/league/champions', [ChampionController::class, 'index'])->name('league.champions');

// Champion-specific routes for different game modes (Ranked, ARAM, Arena, Swiftplay)
Route::get('/{game_mode}/champion/{champion_name}', [ChampionController::class, 'show'])->name('league.champion-show');

// TFT Routes
Route::get('/tft/ranked', [TftController::class, 'tftranked'])->name('tft.ranked');
Route::get('/tft/hyper', [TftController::class, 'hyper'])->name('tft.hyper');
Route::get('/tft/double', [TftController::class, 'double'])->name('tft.double');
Route::get('/tft/tocker', [TftController::class, 'tocker'])->name('tft.tocker');

// Valorant Routes
Route::get('/valorant/valoranked', [ValoController::class, 'valoranked'])->name('valorant.ranked');

// Riot API route
Route::get('/summoner/{summonerName}/store-matches-recursively', [RiotController::class, 'storeMatchesRecursively'])->name('riot.storeMatchesRecursively');
Route::get('/fetch-summoner/{summonerName}/{tag}', [RiotController::class, 'fetchSummonerData']);
