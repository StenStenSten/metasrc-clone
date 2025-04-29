<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\GameMatch;
use App\Models\Participant;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MatchController extends Controller
{
    // Fetch match data from Riot API and store it in the database
    public function fetchMatchData($matchId)
    {
        $client = new Client();
        $riotApiUrl = "https://api.riotgames.com/lol/matches/{$matchId}";  // Replace with the actual Riot API URL

        try {
            // Fetch match data from Riot API
            $response = $client->get($riotApiUrl, [
                'headers' => [
                    'X-Riot-Token' => env('RIOT_API_KEY'), // Add your Riot API key to .env
                ]
            ]);
            $matchData = json_decode($response->getBody()->getContents(), true);

            // Save match data to the database
            $gameMatch = GameMatch::create([
                'match_id' => $matchData['match_id'],
                'game_mode' => $matchData['info']['game_mode'],
                'game_type' => $matchData['info']['game_type'],
                'queue_type' => $matchData['info']['queue_type'],
                'game_version' => $matchData['info']['game_version'],
                'game_start_time' => $matchData['info']['game_start_time_utc'],
                'duration' => $matchData['info']['total_turn_count'],
            ]);

            // Save participants data to the database
            foreach ($matchData['info']['players'] as $player) {
                Participant::create([
                    'match_id' => $gameMatch->id,
                    'summoner_id' => $player['summoner_id'],
                    'puuid' => $player['puuid'],
                    'champion_id' => $player['champion_id'],
                    'kills' => $player['kills'],
                    'deaths' => $player['deaths'],
                    'assists' => $player['assists'],
                    'items' => json_encode($player['items']),
                ]);
            }

            return response()->json([
                'success' => true,
                'message' => 'Match data fetched and saved successfully.',
                'match' => $gameMatch,
            ], 200);
            
        } catch (\Exception $e) {
            Log::error("Error fetching match data: " . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch match data.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
