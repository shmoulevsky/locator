<?php

namespace Esh\Locator\Locators;

use Esh\Locator\Entities\IP;
use Esh\Locator\Entities\Location;
use Esh\Locator\Interfaces\Locator;
use Esh\Locator\Utils\HttpClient;

class IPApiLocator implements Locator
{
    private $client;

    public function __construct(HttpClient $client)
    {
        $this->client = $client;
    }

    public function locate(IP $ip) : ?Location
    {
        $url = 'http://ip-api.com/json/'.$ip->getValue();

        $info = array_map( function ($value) {
            return $value !== '-' ? $value : null;
        }, (array)$this->client->get($url));

        return new Location($info['country'], $info['region'], $info['city']);
    }
}