<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use GuzzleHttp\Client;

class ChampionController extends Controller
{
    // Fetch all champions
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

    // Fetch individual champion's meta build for different game modes
    public function show($game_mode, $champion_name)
    {
        $client = new Client();

        try {
            // Get champion data
            $response = $client->get("https://ddragon.leagueoflegends.com/cdn/15.3.1/data/en_US/champion/{$champion_name}.json", [
                'verify' => false, // Disable SSL verification
            ]);

            $champion_data = json_decode($response->getBody()->getContents(), true);

            // Get meta build based on the game mode (ranked, aram, etc.)
            $meta_build = $this->getMetaBuild($game_mode, $champion_name);

            // Pass data to Blade view
            return view('champions.show', compact('champion_data', 'meta_build', 'game_mode'));

        } catch (\GuzzleHttp\Exception\RequestException $e) {
            return view('champions.show')->with('error', 'Failed to fetch champion data.');
        }
    }

    // Get different meta builds based on the game mode
    private function getMetaBuild($game_mode, $champion_name)
    {
        // Example: Fetch different meta builds for the game mode
        // You can fetch this data from a real API or mock it

        $meta_builds = [
            'ranked' => [
                'items' => ['item1', 'item2', 'item3'],
                'runes' => ['rune1', 'rune2'],
                'spells' => ['spell1', 'spell2'],
            ],
            'aram' => [
                'items' => ['aram_item1', 'aram_item2'],
                'runes' => ['aram_rune1', 'aram_rune2'],
                'spells' => ['aram_spell1', 'aram_spell2'],
            ],
            'arena' => [
                'items' => ['arena_item1', 'arena_item2'],
                'runes' => ['arena_rune1', 'arena_rune2'],
                'spells' => ['arena_spell1', 'arena_spell2'],
            ],
            'swiftplay' => [
                'items' => ['swiftplay_item1', 'swiftplay_item2'],
                'runes' => ['swiftplay_rune1', 'swiftplay_rune2'],
                'spells' => ['swiftplay_spell1', 'swiftplay_spell2'],
            ]
        ];

        // Return meta build for the specified game mode
        return $meta_builds[$game_mode] ?? [];
    }
}
