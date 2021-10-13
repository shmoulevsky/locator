<?php

namespace Esh\Locator\Entities;


class IP
{
    private $value;

    public function __construct(string $ip)
    {
        if(empty($ip)) {
            throw new \InvalidArgumentException('ip is empty');
        }

        if(filter_var($ip, FILTER_VALIDATE_IP) === false){
            throw new \InvalidArgumentException('ip is not valid');
        }

        $this->value = $ip;
    }

    public function getValue(): string
    {
        return $this->value;
    }
}