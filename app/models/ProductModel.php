<?php

declare(strict_types=1);

namespace app\models;

use app\src\classes\exceptions\ParamNotFoundException;
use app\src\interfaces\cache\CacheInterface;
use app\src\interfaces\models\ModelInterface;
use InvalidArgumentException;
use PDO;

final class ProductModel implements ModelInterface
{

    public function __construct(private PDO $connection, private CacheInterface $redisManager) {}

    public function getItemByID(string $id): mixed
    {
        if (!isset($id) || empty($id)) {

            throw new InvalidArgumentException('Empty param');
        }

        $query = "SELECT * FROM products WHERE id=$id";

        $result = $this->runQuery($query);

        if (empty($result)) {

            throw new ParamNotFoundException("Param $id not found");
        }

        return $result;
    }

    private function runQuery(string $query): mixed
    {
        $response = $this->redisManager->get($query);

        if ($response) {

            return unserialize($response);
        }

        $response = $this->connection->query($query)->fetchAll();

        $this->redisManager->set($query, serialize($response));

        if (empty($response)) {
            return [];
        }

        return $response;
    }
}
