<?php

declare(strict_types=1);

namespace App\Web\Http\Request;

use App\DataWrappers\UUID;
use App\Interfaces\Cache\CacheInterface;
use App\Interfaces\Repositories\RepositoryInterface;
use App\Interfaces\Request\RequestInterface;
use PDO;

use const App\Helpers\FACTORY_NAMESPACE;

class Request implements RequestInterface
{

    public function __construct(private PDO $connection, private CacheInterface $redisManager) {}

    public function getRepository(string $name): ?RepositoryInterface
    {
        $factoryName = FACTORY_NAMESPACE . "RepositoryFactory";

        if (!class_exists($factoryName)) {
            return null;
        }

        $repository = $factoryName::createRepository($this->connection, $this->redisManager, $name);

        return $repository;
    }

    public function getUUID(string $id): ?UUID
    {
        $UUID = new UUID($id);

        return $UUID;
    }
}
