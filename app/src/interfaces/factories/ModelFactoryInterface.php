<?php

declare(strict_types=1);

namespace app\src\interfaces\factories;

use app\src\interfaces\models\ModelInterface;

interface ModelFactoryInterface
{
    public static function createModel(): ModelInterface;
}
