<?php

declare(strict_types=1);

namespace App\Helpers;

use App\Web\Cache\RedisCache;
use \Redis;

$redis = new Redis();

$redis->connect('redis', 6379);

$redisManager = RedisCache::getInstance();

$redisManager->setHelper($redis);
