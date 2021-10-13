<?php

namespace Esh\Locator;

use Esh\Locator\Entities\IP;
use Esh\Locator\Entities\Location;
use Esh\Locator\Interfaces\Locator;

class ChainLocator implements Locator
{
    private $locators;

    public function __construct(Locator ...$locators)
    {
        $this->locators = $locators;
    }

    public function locate(IP $ip): ?Location
    {
        foreach ($this->locators as $locator){
            $location = $locator->locate($ip);
            if($location !== null) {
                return $location;
            }
        }
        return null;
    }
}