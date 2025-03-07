<?php

namespace App\Services;

use App\Models\GameMatch;  // Assuming GameMatch is the model
use App\Models\Participant;
use Illuminate\Support\Facades\Http;

class RiotService
{
    protected $apiKey;

    public function __construct()
    {
        $this->apiKey = env('RIOT_API_KEY');
    }

    public function getSummonerByName($summonerName, $tag)
    {
        // Construct the correct base URL based on tag
        $tagUrls = [
            'na' => 'na1', 
            'euw' => 'euw1', 
            'kr' => 'kr', 
            // Add more tag mappings as necessary
        ];

        $region = $tagUrls[$tag] ?? 'euw1';  // Default to 'euw1' if no tag is found

        // Get the summoner data using the correct region URL
        $response = Http::get("https://{$region}.api.riotgames.com/lol/summoner/v4/summoners/by-name/{$summonerName}", [
            'api_key' => $this->apiKey
        ]);

        return $response->json();
    }

    public function getMatchHistory($puuid, $tag, $count = 10)
    {
        $tagUrls = [
            'na' => 'na1',
            'euw' => 'euw1',
            'kr' => 'kr',
            // Add more tag mappings as necessary
        ];

        $region = $tagUrls[$tag] ?? 'euw1';  // Default to 'euw1' if no tag is found

        // Fetch match history for the summoner based on tag
        $response = Http::get("https://{$region}.api.riotgames.com/lol/match/v5/matches/by-puuid/{$puuid}/ids", [
            'api_key' => $this->apiKey,
            'count' => $count,
        ]);

        return $response->json();
    }

    public function getMatchDetails($matchId, $tag)
    {
        $tagUrls = [
            'na' => 'na1',
            'euw' => 'euw1',
            'kr' => 'kr',
            // Add more tag mappings as necessary
        ];

        $region = $tagUrls[$tag] ?? 'euw1';  // Default to 'euw1' if no tag is found

        // Fetch match details based on tag
        $response = Http::get("https://{$region}.api.riotgames.com/lol/match/v5/matches/{$matchId}", [
            'api_key' => $this->apiKey
        ]);

        return $response->json();
    }

    public function storeMatchData($matchId, $tag)
    {
        // Fetch match details
        $matchData = $this->getMatchDetails($matchId, $tag);

        // Create the match record
        $match = GameMatch::create([
            'match_id' => $matchId,
            'game_mode' => $matchData['info']['gameMode'], // Ranked, ARAM, etc.
            'queue_type' => $matchData['info']['queueId'], // e.g., 420 for Ranked Solo
        ]);

        // Store each participant
        foreach ($matchData['info']['participants'] as $participantData) {
            Participant::create([
                'match_id' => $match->id,
                'summoner_id' => $participantData['summonerId'], // Store summoner ID or name
                'champion_id' => $participantData['championId'], // Champion played
                'kills' => $participantData['kills'],
                'deaths' => $participantData['deaths'],
                'assists' => $participantData['assists'],
                'items' => [
                    $participantData['item0'], $participantData['item1'], $participantData['item2'],
                    $participantData['item3'], $participantData['item4'], $participantData['item5']
                ],
            ]);
        }
    }

    public function storeMatchesForSummonerRecursively($summonerName, $tag, $maxDepth = 2, $currentDepth = 0)
    {
        // Prevent going beyond max depth
        if ($currentDepth >= $maxDepth) {
            return;
        }

        // Get the summoner by name and tag
        $summoner = $this->getSummonerByName($summonerName, $tag);

        if (!$summoner) {
            return; // If summoner is not found, exit
        }

        $puuid = $summoner['puuid'];

        // Fetch match history for this summoner
        $matchIds = $this->getMatchHistory($puuid, $tag, 10); // Adjust number of matches as needed

        // For each match in the history
        foreach ($matchIds as $matchId) {
            // Store match data
            $this->storeMatchData($matchId, $tag);

            // Fetch the match details
            $matchDetails = $this->getMatchDetails($matchId, $tag);
            
            // Iterate through participants in the match
            foreach ($matchDetails['info']['participants'] as $participantData) {
                $participantSummonerName = $participantData['summonerName'];

                // Recursively call this function for each participant (if they are not the original summoner)
                if ($participantSummonerName !== $summonerName) {
                    $this->storeMatchesForSummonerRecursively($participantSummonerName, $tag, $maxDepth, $currentDepth + 1);
                }
            }
        }
    }
}
