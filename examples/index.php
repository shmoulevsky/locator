<?php
require __DIR__ . './../vendor/autoload.php';

use Esh\Locator\CacheLocator;
use Esh\Locator\ChainLocator;
use Esh\Locator\Entities\IP;
use Esh\Locator\Locators\IPApiLocator;
use Esh\Locator\Locators\IPGeolocationLocator;
use Esh\Locator\MuteLocator;
use Esh\Locator\Utils\Cache;
use Esh\Locator\Utils\HttpClient;

$client = new HttpClient();
//api key from https://ipgeolocation.io/
$apiKey = 'enter key here';

$chainLocator = new  ChainLocator(
    new CacheLocator(new MuteLocator(new IPApiLocator($client)), new Cache(), 60),
    new CacheLocator(new MuteLocator(new IPGeolocationLocator($client, $apiKey)), new Cache(), 60),
);

$info = $chainLocator->locate( new IP('8.8.8.8'));

echo '<pre>'; print_r($info); echo '</pre>';

?>