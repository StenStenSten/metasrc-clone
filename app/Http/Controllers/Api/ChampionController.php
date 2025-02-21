<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use GuzzleHttp\Client;

class ChampionController extends Controller
{
    public function index()
    {
        $client = new Client();

        try {
            $response = $client->get("https://ddragon.leagueoflegends.com/cdn/15.3.1/data/en_US/champion.json", [
                'verify' => false, // Disable SSL verification 
            ]);

            $champions = json_decode($response->getBody()->getContents(), true);

            // Pass data to Blade view
            return view('champions.index', compact('champions'));

        } catch (\GuzzleHttp\Exception\RequestException $e) {
            return view('champions.index')->with('error', 'Failed to fetch champions data.');
        }
    }
}
