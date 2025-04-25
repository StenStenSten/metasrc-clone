<?php

namespace App\Console\Commands;

use App\Services\RiotService;
use Illuminate\Console\Command;

class StoreMatchesFromPuuid extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:store-matches-from-puuid {puuid} {region} {maxDepth=2}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch and store match data for a summoner based on their PUUID and region.';

    /**
     * The RiotService instance.
     *
     * @var RiotService
     */
    protected $riotService;

    /**
     * Create a new command instance.
     *
     * @param RiotService $riotService
     * @return void
     */
    public function __construct(RiotService $riotService)
    {
        parent::__construct();
        $this->riotService = $riotService;
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        // Get the PUUID, region, and max depth from the arguments
        $puuid = $this->argument('puuid');
        $region = $this->argument('region');
        $maxDepth = $this->argument('maxDepth');

        // Log information for clarity
        $this->info("Fetching match data for PUUID: {$puuid} in region: {$region} with max depth: {$maxDepth}");

        // Call the method to recursively fetch and store match data
        $this->riotService->storeMatchesForSummonerRecursivelyFromPuuid($puuid, $region, $maxDepth);

        // Inform the user when done
        $this->info('Match data stored successfully.');
    }
}
