<?php

namespace Esh\Locator\Utils;

class Cache
{
    private string $root;

    public function __construct()
    {
        $this->root = $_SERVER['DOCUMENT_ROOT'] . '/locator/cache/';
        if (!file_exists($this->root)) {
            mkdir($this->root, 0777, true);
        }
    }

    public function get(string $id)
    {
        $data = null;

        if (file_exists($this->getPath($id))) {
            $data = unserialize(file_get_contents($this->getPath($id)));
        }

        return $data;
    }

    public function set(string $id, $data, $ttl): void
    {
        if (empty($id)) {
            throw new \Exception('id is empty');
        }

        if (empty($data)) {
            throw new \Exception('data is empty');
        }

        file_put_contents($this->getPath($id), serialize($data));
    }

    private function getPath($id): string
    {
        return $this->root . '/' . $id;
    }

}