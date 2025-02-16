<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LeagueController;
use App\Http\Controllers\TftController;
use App\Http\Controllers\ValoController;
use App\Http\Controllers\Api\ChampionController;

Route::get('/', function () {
    return view(view: 'home');
});
//league
Route::get('/league/ranked', [LeagueController::class, 'ranked'])->name('league.ranked');
Route::get('/league/aram', [LeagueController::class, 'aram'])->name('league.aram');
Route::get('/league/arena', [LeagueController::class, 'arena'])->name('league.arena');
Route::get('/league/swiftplay', [LeagueController::class, 'swiftplay'])->name('league.swiftplay');
//fetch league champions from api
Route::get('/league/champions', [ChampionController::class, 'getChampions'])->name('league.champions');
//tft
Route::get('/tft/ranked', [TftController::class, 'tftranked'])->name('tft.ranked');
Route::get('/tft/hyper', [TftController::class, 'hyper'])->name('tft.hyper');
Route::get('/tft/double', [TftController::class, 'double'])->name('tft.double');
Route::get('/tft/tocker', [TftController::class, 'tocker'])->name('tft.tocker');
//valo
Route::get('/valorant/valoranked', [ValoController::class, 'valoranked'])->name('valorant.ranked');

