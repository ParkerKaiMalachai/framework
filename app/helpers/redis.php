<?php

declare(strict_types=1);

use app\src\classes\cache\RedisCache;

$redis = new Redis();

$redis->connect('redis', 6379);

$redisManager = RedisCache::getInstance();

$redisManager->setHelper($redis);
