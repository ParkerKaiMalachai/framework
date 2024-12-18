<?php

declare(strict_types=1);

namespace App\Repositories;

use App\DataWrappers\UUID;
use App\Exceptions\Routes\ParamNotFoundException;
use App\Interfaces\Cache\CacheInterface;
use App\Interfaces\Repositories\RepositoryInterface;
use PDO;

use const App\Helpers\FACTORY_NAMESPACE;

final class ProductRepository implements RepositoryInterface
{
    public function __construct(private PDO $connection, private CacheInterface $redisManager) {}

    public function getByID(UUID $id): mixed
    {
        if (!isset($id)) {
            throw new ParamNotFoundException('Empty param');
        }

        $idValue = $id->getID();

        $query = "SELECT * FROM products WHERE id = $idValue";

        $response = $this->redisManager->get($query);

        if ($response) {

            $model = $this->getModel(unserialize($response)['id'], unserialize($response)['name']);

            return $model->getFields();
        }

        $response = $this->connection->query($query)->fetch(PDO::FETCH_ASSOC);

        if (empty($response)) {
            return [];
        }

        $this->redisManager->set($query, serialize($response));

        $model = $this->getModel(unserialize($response)['id'], unserialize($response)['name']);

        return $model->getFields();
    }

    private function getModel(int $id, string $name): mixed
    {
        $factoryName = FACTORY_NAMESPACE . "ModelFactory";

        if (!class_exists($factoryName)) {
            return null;
        }

        $model = $factoryName::createModel('Product', ['id' => $id, 'name' => $name]);

        return $model;
    }
}
