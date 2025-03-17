<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use File;
use Log;
use Symfony\Component\DomCrawler\Crawler;

class ChampionBuildController extends Controller
{
    public function show($game_mode, $championName)
    {
        $client = new Client();
        $championData = null;
        $itemData = null;
        $metaBuild = null;

        try {
            // Define the path where the extracted data resides
            $extractedPath = public_path('dragontail/dragontail-15.4.1/15.4.1/data/en_US/champion/');
            Log::info("Extracted Path: " . $extractedPath);

            if (!File::exists($extractedPath)) {
                throw new \Exception("Data extraction folder not found.");
            }

            // Fetch champion data
            $championFilePath = $extractedPath . "{$championName}.json";
            Log::info("Champion file path: " . $championFilePath);

            if (File::exists($championFilePath)) {
                $championData = json_decode(File::get($championFilePath), true);
            } else {
                Log::warning("Champion data file not found for {$championName}.");
            }

            // Fetch item data
            $itemFile = public_path('dragontail/dragontail-15.4.1/15.4.1/data/en_US/item.json');
            Log::info("Item file path: " . $itemFile);

            if (File::exists($itemFile)) {
                $itemData = json_decode(File::get($itemFile), true);
            } else {
                Log::warning("Item data file not found.");
            }

            if (!$championData && $metaBuild) {
                return response()->json([
                    'champion' => null,
                    'metaBuild' => $metaBuild,
                    'gameMode' => $game_mode,
                    'buildItems' => []
                ], 200);
            }

            if (!$championData) {
                return response()->json(['error' => 'Champion not found'], 404);
            }

            // Prepare build items based on the meta build
            $buildItems = $this->prepareBuildItems($metaBuild['recommended_items'] ?? [], $itemData);

            return response()->json([
                'champion' => $championData['data'][$championName] ?? null,
                'metaBuild' => $metaBuild,
                'gameMode' => $game_mode,
                'buildItems' => $buildItems,
            ], 200);

        } catch (\Exception $e) {
            Log::error("Error in show method: " . $e->getMessage());
            return response()->json(['error' => 'Failed to fetch champion data. ' . $e->getMessage()], 500);
        }
    }


    private function prepareBuildItems($recommendedItems, $itemData)
    {
        $buildItems = [];

        foreach ($recommendedItems as $type => $itemName) {
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

    private function getItemIdFromName($itemName, $itemData)
    {
        foreach ($itemData['data'] ?? [] as $itemId => $item) {
            if (strtolower($item['name']) === strtolower($itemName)) {
                return $itemId;
            }
        }
        return null;
    }
}
