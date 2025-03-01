<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use File; // For file handling

class ChampionBuildController extends Controller
{
    // Fetch champion builds based on game mode and champion
    public function show($game_mode, $championName)
    {
        $client = new Client();
        $championData = null;
        $itemData = null;
        $metaBuild = null;

        try {
            // Define the path where the extracted data resides (adjust as needed)
            $extractedPath = storage_path('app/public/dragontail/'); // You can use any folder you prefer
            
            // Check if the data exists
            if (!File::exists($extractedPath)) {
                throw new \Exception("Data extraction folder not found.");
            }

            // Fetch champion data from the extracted folder (JSON for champion data)
            $championFile = $extractedPath . "data/en_US/champion.json";
            if (File::exists($championFile)) {
                $championData = json_decode(File::get($championFile), true);
            } else {
                throw new \Exception("Champion data file not found.");
            }

            // Fetch item data from the extracted folder (JSON for item data)
            $itemFile = $extractedPath . "data/en_US/item.json";
            if (File::exists($itemFile)) {
                $itemData = json_decode(File::get($itemFile), true);
            } else {
                throw new \Exception("Item data file not found.");
            }

            // Fetch meta build data from a dynamic source or predefined method
            $metaBuild = $this->getMetaBuildForChampion($championName, $game_mode);

            // Get the champion details by name
            $champion = $championData['data'][$championName] ?? null;

            // Handle case where champion data is not found
            if (!$champion) {
                return response()->json(['error' => 'Champion not found'], 404);
            }

            // Prepare build items based on the meta build
            $buildItems = $this->prepareBuildItems($metaBuild['recommended_items'], $itemData);

            // Return the response as JSON with champion data, build items, and meta build
            return response()->json([
                'champion' => $champion,
                'metaBuild' => $metaBuild,
                'gameMode' => $game_mode,
                'buildItems' => $buildItems,
            ], 200);

        } catch (\Exception $e) {
            // Catch all exceptions and return an error response
            return response()->json(['error' => 'Failed to fetch champion data. ' . $e->getMessage()], 500);
        }
    }

    // Fetch meta build for a given champion and game mode (dynamically)
    private function getMetaBuildForChampion($championName, $game_mode)
    {
        // Here, you'd fetch the meta build from a source or API (could be dynamically based on game mode)
        // As an example, we are just returning predefined build data (this can be extended with actual logic)
        return [
            'recommended_items' => [
                'Mythic Item' => 'Galeforce',
                'Core Item' => 'Kraken Slayer',
                'Boots' => 'Berserker\'s Greaves',
                'Situational Item' => 'Guardian Angel',
            ],
            'recommended_runes' => [
                'Primary' => 'Precision',
                'Secondary' => 'Domination',
            ],
            'summoner_spells' => ['Flash', 'Ignite'],
        ];
    }

    // Prepare build items based on the recommended items from the meta build
    private function prepareBuildItems($recommendedItems, $itemData)
    {
        $buildItems = [];
        
        foreach ($recommendedItems as $type => $itemName) {
            // Get item ID from the predefined name
            $itemId = $this->getItemIdFromName($itemName, $itemData);

            if ($itemId) {
                $buildItems[] = [
                    'name' => $itemName,
                    'id' => $itemId,
                    'image' => "https://ddragon.leagueoflegends.com/cdn/15.4.1/img/item/{$itemId}.png",
                    'type' => $type
                ];
            }
        }

        return $buildItems;
    }

    // Fetch item ID from Riot's item data based on the item name
    private function getItemIdFromName($itemName, $itemData)
    {
        foreach ($itemData['data'] as $itemId => $item) {
            if (strtolower($item['name']) === strtolower($itemName)) {
                return $itemId;
            }
        }

        return null;
    }
}
