<?php

namespace App\Services\Cache;

interface ICacheService
{
    public function createOrUpdate(array $data): void;

    public function delete(mixed $key): void;

    public function getByKey(mixed $key): mixed;
}
