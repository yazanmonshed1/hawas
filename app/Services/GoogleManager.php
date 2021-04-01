<?php

namespace App\Services;

use GuzzleHttp\Client;

class GoogleManager
{
    public function __construct(Client $client)
    {
        $this->client = $client;
        $this->apiKey = env('YOUTUBE_API_KEY', 'AIzaSyB5k7F0n8c2tZGVTQrQIWxd6c9IhTVNCn8');
        $this->channelID = env('YOUTUBE_CHANNEL_ID');

        $this->url = 'https://www.googleapis.com/youtube/v3/search?order=date&part=snippet&channelId=';
    }

    public function fetch()
    {
        $url = $this->url . $this->channelID . '&key=' . $this->apiKey . '&maxResults=50';
        $request = new \GuzzleHttp\Psr7\Request('GET', $url);
        $promise = $this->client->sendAsync($request)->then(function ($response) {
            return json_decode($response->getBody()->getContents());
        });

        return $promise->wait();
    }
}
