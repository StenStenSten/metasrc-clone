<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LeagueController extends Controller
{
    public function ranked()
    {
        return view('league.ranked');
    }

    public function aram()
    {
        return view('league.aram');
    }

    public function arena()
    {
        return view('league.arena');
    }

    public function swiftplay()
    {
        return view('league.swiftplay');
    }
}