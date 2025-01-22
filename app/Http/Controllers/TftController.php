<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TftController extends Controller
{
    public function tftranked()
    {
        return view('tft.tftranked');
    }

    public function hyper()
    {
        return view('tft.hyper');
    }

    public function double()
    {
        return view('tft.double');
    }

    public function tocker()
    {
        return view('tft.tocker');
    }
}
