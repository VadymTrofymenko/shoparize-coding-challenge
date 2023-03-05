<?php

declare(strict_types=1);

namespace App\Redis;

use Redis;

class Client implements RedisClientInterface
{
    private Redis $redis;

    public function __construct(string $host, int $port)
    {
        $this->redis = new Redis();
        $this->redis->connect($host, $port);
    }

    public function write(string $key, string $value): void
    {
        $this->redis->set($key, $value);
    }

    public function read(string $key): mixed
    {
        return $this->redis->get($key);
    }

    public function __destruct()
    {
        $this->redis->close();
    }
}