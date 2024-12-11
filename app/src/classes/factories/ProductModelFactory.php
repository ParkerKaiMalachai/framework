<?php

declare(strict_types=1);

namespace app\src\classes\factories;

use app\models\ProductModel;
use app\src\interfaces\factories\ModelFactoryInterface;
use app\src\interfaces\models\ModelInterface;

final class ProductModelFactory implements ModelFactoryInterface
{
    public static function createModel(): ModelInterface
    {
        return new ProductModel();
    }
}
