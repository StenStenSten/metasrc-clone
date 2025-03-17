<?php
namespace App\Services;

use App\Models\GameMatch;
use App\Models\Participant;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;  // For logging

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
        ];

        $region = $tagUrls[$tag] ?? 'euw1';  // Default to 'euw1' if no tag is found

        // Get the summoner data using the correct region URL
        $response = Http::withOptions([
            'verify' => false,  // Disable SSL verification
        ])->get("https://{$region}.api.riotgames.com/lol/summoner/v4/summoners/by-name/{$summonerName}", [
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
        ];

        $region = $tagUrls[$tag] ?? 'euw1';  // Default to 'euw1' if no tag is found

        // Fetch match history for the summoner based on tag
        $response = Http::get("https://{$region}.api.riotgames.com/lol/match/v5/matches/by-puuid/{$puuid}/ids", [
            'api_key' => $this->apiKey,
            'count' => $count,
        ]);

        return $response->json();
    }

    // Updated function to accept $summonerName as an argument
    public function getMatchDetails($matchId, $tag, $summonerName)
    {
        $tagUrls = [
            'na' => 'na1',
            'euw' => 'euw1',
            'kr' => 'kr',
        ];

        $region = $tagUrls[$tag] ?? 'euw1';  // Default to 'euw1' if no tag is found

        // Fetch match details based on tag and pass the correct $summonerName
        $response = Http::withOptions([
            'verify' => false,  // Disable SSL verification
        ])->get("https://{$region}.api.riotgames.com/lol/match/v5/matches/{$matchId}", [
            'api_key' => $this->apiKey
        ]);

        return $response->json();
    }

    public function storeMatchData($matchId, $tag, $summonerName)
    {
        // Fetch match details
        $matchData = $this->getMatchDetails($matchId, $tag, $summonerName); // Pass $summonerName here

        // Ensure that match data exists and is valid
        if (!$matchData || !isset($matchData['info'])) {
            Log::error("Invalid match data for match ID: {$matchId}");
            return;
        }

        // Create the match record
        $match = GameMatch::create([
            'match_id' => $matchId,
            'game_mode' => $matchData['info']['gameMode'] ?? 'Unknown', // Default value if missing
            'queue_type' => $matchData['info']['queueId'] ?? 0,  // Default value if missing
        ]);

        // Log the match data to debug
        Log::info('Match created:', ['match' => $match->toArray()]);

        // Store each participant
        foreach ($matchData['info']['participants'] as $participantData) {
            // Validate participant data before saving
            if (!isset($participantData['summonerId'], $participantData['championId'], $participantData['kills'])) {
                Log::error("Incomplete participant data for match {$matchId}");
                continue;
            }

            // Create the participant record
            Participant::create([
                'match_id' => $match->id,
                'summoner_id' => $participantData['summonerId'], 
                'champion_id' => $participantData['championId'],
                'kills' => $participantData['kills'],
                'deaths' => $participantData['deaths'],
                'assists' => $participantData['assists'],
                'items' => [
                    $participantData['item0'], $participantData['item1'], $participantData['item2'],
                    $participantData['item3'], $participantData['item4'], $participantData['item5']
                ],
            ]);
        }

        Log::info('Match data stored successfully.');
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
            $this->storeMatchData($matchId, $tag, $summonerName); // Pass $summonerName here

            // Fetch the match details
            $matchDetails = $this->getMatchDetails($matchId, $tag, $summonerName); // Pass $summonerName here

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

