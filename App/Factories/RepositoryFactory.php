<?php

declare(strict_types=1);

namespace App\factories;

use App\Interfaces\Cache\CacheInterface;
use App\Interfaces\Factories\RepositoryFactoryInterface;
use App\Interfaces\Repositories\RepositoryInterface;
use InvalidArgumentException;
use PDO;

final class RepositoryFactory implements RepositoryFactoryInterface
{
    public static function createRepository(PDO $connection, CacheInterface $redisManager, string $name): RepositoryInterface
    {
        $repositoryClassName = sprintf('App\\Repositories\\%sRepository', $name);

        if (!class_exists($repositoryClassName)) {
            throw new InvalidArgumentException("Class doesn't exist. Check the passed arguments.");
        }

        return new $repositoryClassName($connection, $redisManager);
    }
}
