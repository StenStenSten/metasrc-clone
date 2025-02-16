<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Handler\StreamHandler;
use GuzzleHttp\HandlerStack;

class LeagueController extends Controller
{
    public function ranked()
    {
        // Use StreamHandler to avoid cURL
        $stack = HandlerStack::create(new StreamHandler());

        $client = new Client([
            'handler' => $stack, // Set the handler to StreamHandler
            'timeout' => 30, // Timeout in seconds
            'verify' => false, // Ignore SSL verification if needed
        ]);

        try {
            // Fetch champions from Riot's Data Dragon API
            $response = $client->request('GET', 'https://ddragon.leagueoflegends.com/cdn/15.3.1/data/en_US/champion.json');
            $data = json_decode($response->getBody(), true);

            // Extract only the champions from the "data" key
            $champions = $data['data'] ?? [];

            return view('league.ranked', compact('champions'));
        } catch (RequestException $e) {
            \Log::error('Failed to fetch champions: ' . $e->getMessage());
            return view('league.ranked', ['champions' => []]);
        }
    }


    public function aram()
    {
        return view('league.aram');
    }

    public function arena()
    {
        return view('league.arena');
    }

    public function swiftplay()
    {
        return view('league.swiftplay');
    }
}
