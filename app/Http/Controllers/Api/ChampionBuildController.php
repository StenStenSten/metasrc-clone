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

            // Scrape meta build data
            $metaBuild = $this->scrapeChampionBuildFromOpGG($championName);

            // Ensure the scraper works
            Log::info("Scraped Data: " . json_encode($metaBuild));

            // If champion data is missing, but scraping works, return scraped data
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

    public function scrapeChampionBuildFromOpGG($championName)
    {
        try {
            $client = new Client();
            $url = "https://www.op.gg/champions/" . strtolower($championName) . "/build";
            
            Log::info("Fetching OP.GG URL: " . $url);

            $response = $client->get($url, [
                'headers' => [
                    'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36'
                ],
                'verify' => false, // Disable SSL verification
            ]);

            $html = $response->getBody()->getContents();
            
            // Log first 500 characters to check response
            Log::info("HTML response from OP.GG: " . substr($html, 0, 500));

            $crawler = new Crawler($html);

            // Extract core build items
            $items = $crawler->filter('.css-1wvfkid.e1wc33z60 img')->each(function ($node) {
                return $node->attr('alt'); // Extract item name from alt text
            });

            // Extract primary runes
            $runes = $crawler->filter('.perk-page img')->each(function ($node) {
                return $node->attr('alt'); // Extract rune names
            });

            // Extract summoner spells
            $summonerSpells = $crawler->filter('.summoner-spells img')->each(function ($node) {
                return $node->attr('alt'); // Extract spell names
            });

            return [
                'items' => $items,
                'runes' => $runes,
                'summonerSpells' => $summonerSpells,
            ];
        } catch (\Exception $e) {
            Log::error("Scraping failed for $championName: " . $e->getMessage());
            return null;
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
