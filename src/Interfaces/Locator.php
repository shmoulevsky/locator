<?php

namespace Esh\Locator\Interfaces;

use Esh\Locator\Entities\IP;
use Esh\Locator\Entities\Location;

interface Locator
{
    public function locate(IP $ip) : ?Location;
}