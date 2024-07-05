<?php

namespace App\Services\Cache;

use Illuminate\Support\Facades\Cache;

class CacheService implements ICacheService
{

    public function createOrUpdate(array $data): void
    {
        Cache::forever($data['id'], $data);
    }

    public function delete(mixed $key): void
    {
        Cache::forget($key);
    }

    public function getByKey(mixed $key): mixed
    {
        return Cache::get($key);
    }
}
