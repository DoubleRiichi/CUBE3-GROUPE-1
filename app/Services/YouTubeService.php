<?php

namespace App\Services;

use GuzzleHttp\Client;

class YouTubeService
{
    protected $client;
    protected $apiKey;

    public function __construct()
    {
        $this->client = new Client();
        $this->apiKey = env('AIzaSyCPDFG_EDKXduJ6KMTLq0cBTWyuVIAhgeU');
    }

    public function getMovieTrailers($query)
    {
        $response = $this->client->get('https://www.googleapis.com/youtube/v3/search', [
            'query' => [
                'part' => 'snippet',
                'q' => $query . ' trailer',
                'type' => 'video',
                'key' => $this->apiKey,
                'maxResults' => 5
            ]
        ]);

        return json_decode($response->getBody(), true);
    }
}
