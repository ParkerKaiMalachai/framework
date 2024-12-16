<?php

declare(strict_types=1);

namespace app\src\classes;

use app\src\interfaces\cache\CacheInterface;
use app\src\interfaces\RequestInterface;
use PDO;

class Request implements RequestInterface
{
    public function __construct(private PDO $connection, private CacheInterface $redisManager) {}

    public function requestToModel(string $param, string $name, string $method): mixed
    {
        $factoryName = FACTORY_NAMESPACE . "ModelFactory";

        if (!class_exists($factoryName)) {
            return null;
        }

        $model = $factoryName::createModel($this->connection, $this->redisManager, $name);

        $result = $model->$method($param);

        return $result;
    }
}
