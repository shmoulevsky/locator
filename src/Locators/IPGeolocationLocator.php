<?php

namespace Esh\Locator\Locators;

use Esh\Locator\Entities\IP;
use Esh\Locator\Entities\Location;
use Esh\Locator\Interfaces\Locator;
use Esh\Locator\Utils\HttpClient;

class IPGeolocationLocator implements  Locator
{
    private $client;
    private string $apiKey;

    public function __construct(HttpClient $client, string $apiKey)
    {
        $this->client = $client;
        $this->apiKey = $apiKey;
    }

    public function locate(IP $ip) : ?Location
    {
        $url = 'https://api.ipgeolocation.io/ipgeo?'.http_build_query([
            'apiKey' => $this->apiKey,
            'ip' => $ip->getValue()
        ]);

        $info = array_map( function ($value) {
            return $value !== '-' ? $value : null;
        }, (array)$this->client->get($url));

        return new Location($info['country_code2'], $info['state_prov'], $info['city']);
    }
}