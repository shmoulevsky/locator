<?php

namespace Esh\Locator\Utils;


class HttpClient
{
    public function get($url)
    {
        $request = @file_get_contents($url);

        if($request === false){
            throw new \RuntimeException(error_get_last()['message']);
        }
        return json_decode($request, true);
    }
}