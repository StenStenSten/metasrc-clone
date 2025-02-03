<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ValoController extends Controller
{
    public function valoranked()
    {
        return view('valorant.valoranked'); 
    }
}
