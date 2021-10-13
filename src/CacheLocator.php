<?php

namespace Esh\Locator;

use Esh\Locator\Entities\IP;
use Esh\Locator\Entities\Location;
use Esh\Locator\Interfaces\Locator;
use Esh\Locator\Utils\Cache;

class CacheLocator implements Locator
{
    const cacheId = 'locator-';
    private Locator $next;
    private Cache $cache;
    private int $ttl;

    public function __construct(Locator $next, Cache $cache, int $ttl)
    {
        $this->next = $next;
        $this->cache = $cache;
        $this->ttl = $ttl;
    }

    public function locate(IP $ip): ?Location
    {
        $key = self::cacheId . $ip->getValue();
        $location = $this->cache->get($key);

        if($location === null){
            $location = $this->next->locate($ip);
            $this->cache->set($key, $location, $this->ttl);
        }

        return $location;
    }
}