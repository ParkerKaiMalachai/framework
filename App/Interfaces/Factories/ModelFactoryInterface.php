<?php

declare(strict_types=1);

namespace App\Interfaces\Factories;

use App\Interfaces\Models\ModelInterface;

interface ModelFactoryInterface
{
    public static function createModel(string $name, array $response): ModelInterface;
}
