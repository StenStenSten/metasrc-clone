<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LeagueController;

Route::get('/', function () {
    return view(view: 'home');
});

Route::get('/league/ranked', [LeagueController::class, 'ranked']);
    return view(view: 'league.ranked');

Route::get('/league/aram', [LeagueController::class, 'aram']);
    return view(view: 'league.aram');

Route::get('/league/arena', [LeagueController::class, 'arena']);
    return view(view: 'league.arena');

Route::get('/league/swiftplay', [LeagueController::class, 'swiftplay']);
    return view(view: 'league.swiftplay');


