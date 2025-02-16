<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use GuzzleHttp\Client;

class ChampionController extends Controller
{
    public function getChampions()
    {
        $client = new Client();

        try {
            $response = $client->get("https://ddragon.leagueoflegends.com/cdn/15.3.1/data/en_US/champion.json", [
                'verify' => false, // Disable SSL verification 
            ]);

            $champions = json_decode($response->getBody()->getContents(), true);

            return response()->json($champions);

        } catch (\GuzzleHttp\Exception\RequestException $e) {
            return response()->json(['message' => 'Failed to fetch champions data.'], 500);
        }
    }
}
