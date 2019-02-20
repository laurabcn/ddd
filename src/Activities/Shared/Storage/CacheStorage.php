<?php

namespace App\Activities\Shared\Storage;

interface CacheStorage
{
    public function save(string $key, $value, int $ttl = 0): void;

    public function retrieve(string $request);

    public function exists(string $request);

    public function clear(string $baseKey): void;
}
