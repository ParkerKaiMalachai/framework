<?php

declare(strict_types=1);

namespace app\src\interfaces\factories;

use app\src\interfaces\cache\CacheInterface;
use app\src\interfaces\models\ModelInterface;
use PDO;

interface ModelFactoryInterface
{
    public static function createModel(PDO $connection, CacheInterface $redisManager, string $name): ModelInterface;
}
