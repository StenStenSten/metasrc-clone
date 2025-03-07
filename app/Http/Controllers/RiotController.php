<?php

namespace App\Http\Controllers;

use App\Services\RiotService;

class RiotController extends Controller
{
    protected $riotService;

    public function __construct(RiotService $riotService)
    {
        $this->riotService = $riotService;
    }

    // Method to fetch and store match data for a summoner
    public function fetchSummonerData($summonerName, $tag)
    {
        // Ensure tag is lower case
        $tag = strtolower($tag);

        // Call the service to store matches recursively for the given summoner and tag
        $this->riotService->storeMatchesForSummonerRecursively($summonerName, $tag, 2);  // You can adjust maxDepth if needed

        // Optionally return a response after processing
        return response()->json([
            'message' => "Matches for summoner {$summonerName} (Tag: {$tag}) have been fetched and stored."
        ]);
    }
}
