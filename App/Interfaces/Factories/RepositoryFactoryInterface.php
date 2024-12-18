<?php

declare(strict_types=1);

namespace App\Interfaces\Factories;

use App\Interfaces\Cache\CacheInterface;
use App\Interfaces\Repositories\RepositoryInterface;
use PDO;

interface RepositoryFactoryInterface
{
    public static function createRepository(PDO $connection, CacheInterface $redisManager, string $name): RepositoryInterface;
}
