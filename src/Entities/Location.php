<?php

namespace Esh\Locator\Entities;

class Location
{

    private $country;
    private $city;
    private $region;

    public function __construct(string $country, string $city, string $region)
    {
        $this->country = $country;
        $this->city = $city;
        $this->region = $region;
    }

    public function getCountry(): string
    {
        return $this->country;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function getRegion(): string
    {
        return $this->region;
    }
}