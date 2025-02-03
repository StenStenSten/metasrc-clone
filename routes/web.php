<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LeagueController;
use App\Http\Controllers\TftController;
use App\Http\Controllers\ValoController;

Route::get('/', function () {
    return view(view: 'home');
});
//league
Route::get('/league/ranked', [LeagueController::class, 'ranked']);
    return view(view: 'league.ranked');

Route::get('/league/aram', [LeagueController::class, 'aram']);
    return view(view: 'league.aram');

Route::get('/league/arena', [LeagueController::class, 'arena']);
    return view(view: 'league.arena');

Route::get('/league/swiftplay', [LeagueController::class, 'swiftplay']);
    return view(view: 'league.swiftplay');
//tft
Route::get('/tft/ranked', [TftController::class, 'tftranked'])->name('tft.ranked');

Route::get('/tft/hyper', [TftController::class, 'hyper'])->name('tft.hyper');

Route::get('/tft/double', [TftController::class, 'double'])->name('tft.double');

Route::get('/tft/tocker', [TftController::class, 'tocker'])->name('tft.tocker');
//valo
Route::get('/valorant/valoranked', [ValoController::class, 'valoranked']);

