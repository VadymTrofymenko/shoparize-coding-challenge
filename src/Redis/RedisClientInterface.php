<?php

declare(strict_types=1);

namespace App\Redis;

interface RedisClientInterface
{
    public function write(string $key, string $value): void;

    public function read(string $key): mixed;
}