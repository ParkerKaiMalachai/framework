<?php

declare(strict_types=1);

namespace app\src\classes\factories;

use app\src\interfaces\cache\CacheInterface;
use app\src\interfaces\factories\ModelFactoryInterface;
use app\src\interfaces\models\ModelInterface;
use InvalidArgumentException;
use PDO;

final class ModelFactory implements ModelFactoryInterface
{
    public static function createModel(PDO $connection, CacheInterface $redisManager, string $name): ModelInterface
    {
        $modelClassName = sprintf('app\\models\\%sModel', $name);

        if (!class_exists($modelClassName)) {
            throw new InvalidArgumentException("Class doesn't exist. Check the passed arguments.");
        }

        return new $modelClassName($connection, $redisManager);
    }
}
