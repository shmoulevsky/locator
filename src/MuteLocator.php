<?php

namespace Esh\Locator;

use Esh\Locator\Entities\IP;
use Esh\Locator\Entities\Location;
use Esh\Locator\Interfaces\Locator;

class MuteLocator implements Locator
{
    private Locator $next;

    public function __construct(Locator $next)
    {
        $this->next = $next;
    }


    public function locate(IP $ip): ?Location
    {
        try{
            return $this->next->locate($ip);
        }catch (\Exception $exception){
            return null;
        }
    }
}