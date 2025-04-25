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

    public function getSummonerByName($summonerName, $region)
    {
        // URL-encode the summoner name to handle special characters
        $encodedSummonerName = urlencode($summonerName);

        // Map regions to Riot API regions
        $regionUrls = [
            'europe' => 'europe',  // Europe
            'america' => 'america', // America
            'asia' => 'asia',       // Asia
        ];

        // Default to 'europe' if region is not recognized
        $region = $regionUrls[$region] ?? 'europe';

        // Get the summoner data using the correct region URL
        $response = Http::withOptions([
            'verify' => false,  // Disable SSL verification
        ])->get("https://{$region}.api.riotgames.com/riot/account/v1/accounts/by-riot-id/{$encodedSummonerName}", [
            'api_key' => $this->apiKey
        ]);

        // Return the response JSON
        return $response->json();
    }

    public function getMatchHistory($puuid, $region, $count = 10)
    {
        // Map regions to Riot API regions
        $regionUrls = [
            'europe' => 'europe',  // Europe
            'america' => 'america', // America
            'asia' => 'asia',       // Asia
        ];

        // Default to 'europe' if region is not recognized
        $region = $regionUrls[$region] ?? 'europe';

        // Fetch match history for the summoner based on region
        $response = Http::withOptions([
            'verify' => false,  // Disable SSL verification
        ])->get("https://{$region}.api.riotgames.com/lol/match/v5/matches/by-puuid/{$puuid}/ids", [
            'api_key' => $this->apiKey,
            'count' => $count,
        ]);

        return $response->json();
    }

    public function getMatchDetails($matchId, $region, $summonerName)
    {
        // Map regions to Riot API regions
        $regionUrls = [
            'europe' => 'europe',  // Europe
            'america' => 'america', // America
            'asia' => 'asia',       // Asia
        ];

        // Default to 'europe' if region is not recognized
        $region = $regionUrls[$region] ?? 'europe';

        // Fetch match details based on region and pass the correct $summonerName
        $response = Http::withOptions([
            'verify' => false,  // Disable SSL verification
        ])->get("https://{$region}.api.riotgames.com/lol/match/v5/matches/{$matchId}", [
            'api_key' => $this->apiKey
        ]);

        return $response->json();
    }

    public function storeMatchData($matchId, $region, $summonerName)
    {
        // Fetch match details
        $matchData = $this->getMatchDetails($matchId, $region, $summonerName); // Pass $summonerName here

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

    public function storeMatchesForSummonerRecursivelyFromPuuid($puuid, $region, $maxDepth = 2, $currentDepth = 0)
    {
        // Prevent going beyond max depth
        if ($currentDepth >= $maxDepth) {
            return;
        }

        // Fetch match history for the given PUUID
        $matchIds = $this->getMatchHistory($puuid, $region, 10); // Fetch 10 matches or adjust the count

        // For each match in the history
        foreach ($matchIds as $matchId) {
            // Store match data
            $this->storeMatchData($matchId, $region, $puuid); // Pass the PUUID here for consistency

            // Fetch the match details
            $matchDetails = $this->getMatchDetails($matchId, $region, $puuid); // Pass PUUID here for participant lookup

            // Iterate through participants in the match
            foreach ($matchDetails['info']['participants'] as $participantData) {
                $participantPuuid = $participantData['puuid']; // Get the PUUID of the participant

                // Recursively call this function for each participant (if they are not the original summoner)
                if ($participantPuuid !== $puuid) {
                    $this->storeMatchesForSummonerRecursivelyFromPuuid($participantPuuid, $region, $maxDepth, $currentDepth + 1);
                }
            }
        }
    }
}
