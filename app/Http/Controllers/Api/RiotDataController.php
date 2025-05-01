<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\GameMatch;
use App\Models\Participant;

class RiotDataController extends Controller
{
    protected $apiKey;

    public function __construct()
    {
        $this->apiKey = config('services.riot.key');
    }

    public function getSummonerInfo($summonerName)
    {
        $response = Http::get("https://na1.api.riotgames.com/lol/summoner/v4/summoners/by-name/{$summonerName}?api_key={$this->apiKey}");
        return $response->json();
    }

    public function getMatchIdsByPuuid($puuid)
    {
        $response = Http::get("https://americas.api.riotgames.com/lol/match/v5/matches/by-puuid/{$puuid}/ids?start=0&count=5&api_key={$this->apiKey}");
        return $response->json();
    }

    public function fetchAndStoreMatch($matchId)
    {
        $response = Http::get("https://americas.api.riotgames.com/lol/match/v5/matches/{$matchId}?api_key={$this->apiKey}");
        $data = $response->json();

        if (!$data || isset($data['status'])) {
            return response()->json(['error' => 'Failed to fetch match data'], 400);
        }

        // Check if match already exists
        $existingMatch = GameMatch::where('match_id', $matchId)->first();
        if ($existingMatch) {
            return response()->json(['message' => 'Match already exists in database']);
        }

        // Create game match
        $gameMatch = GameMatch::create([
            'match_id' => $matchId,
            'game_mode' => $data['info']['gameMode'] ?? null,
            'queue_type' => $data['info']['queueId'] ?? null,
        ]);

        // Save participants
        foreach ($data['info']['participants'] as $participant) {
            Participant::create([
                'match_id'    => $matchId,
                'summoner_id' => $participant['summonerId'],
                'puuid'       => $participant['puuid'],
                'champion_id' => $participant['championId'],
                'kills'       => $participant['kills'],
                'deaths'      => $participant['deaths'],
                'assists'     => $participant['assists'],
                'items'       => json_encode([
                    $participant['item0'],
                    $participant['item1'],
                    $participant['item2'],
                    $participant['item3'],
                    $participant['item4'],
                    $participant['item5'],
                    $participant['item6'],
                ]),
            ]);
        }

        return response()->json(['message' => 'Match and participants stored successfully']);
    }

    public function fetchMatchesBySummonerName($summonerName)
    {

        dd("Controller hit with summoner name: {$summonerName}");

        $summoner = $this->getSummonerInfo($summonerName);

        if (!isset($summoner['puuid'])) {
            return response()->json(['error' => 'Summoner not found'], 404);
        }

        $matchIds = $this->getMatchIdsByPuuid($summoner['puuid']);

        if (empty($matchIds)) {
            return response()->json(['message' => 'No matches found for this summoner.']);
        }

        foreach ($matchIds as $matchId) {
            $this->fetchAndStoreMatch($matchId);
        }

        return response()->json(['message' => 'Matches fetched and stored successfully.']);
    }
}
