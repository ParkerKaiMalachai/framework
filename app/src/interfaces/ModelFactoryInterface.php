<?php

declare(strict_types=1);

namespace app\src\interfaces;

use app\src\interfaces\ModelInterface;

interface ModelFactoryInterface
{
    public static function createModel(): ModelInterface;
}
