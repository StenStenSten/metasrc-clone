<?php

namespace App\Console\Commands;

use App\Services\RiotService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;  

class FetchMatchData extends Command
{
    // Modify the signature to accept summonerName and tag arguments
    protected $signature = 'fetch:matches {summonerName} {tag}';
    protected $description = 'Fetch and store matches from Riot API';

    // Dependency Injection of RiotService
    public function __construct(private RiotService $riotService)
    {
        parent::__construct();
    }

    // Handle the command logic
    public function handle()
    {
        // Get the summoner name and tag from the command arguments
        $summonerName = $this->argument('summonerName');
        $tag = $this->argument('tag');

        // Fetch the summoner's details using the summoner name and tag
        $summoner = $this->riotService->getSummonerByName($summonerName, $tag);

        // Log the response to understand its structure
        Log::info('Summoner response:', $summoner);

        // Check if the summoner exists and if 'puuid' is set
        if (!$summoner || !isset($summoner['puuid'])) {
            $this->error("Summoner not found or PUUID not found: {$summonerName}");
            return;
        }

        // Get the PUUID of the summoner
        $puuid = $summoner['puuid'];

        // Fetch the match history for the summoner using their PUUID
        $matchIds = $this->riotService->getMatchHistory($puuid, $tag, 10);  // Fetch the latest 10 matches

        // Iterate through the match IDs and fetch match details for each match
        foreach ($matchIds as $matchId) {
            // Fetch and store match details
            $this->riotService->storeMatchData($matchId, $tag, $summonerName);
        }

        $this->info('Match data fetching completed!');
    }
}



