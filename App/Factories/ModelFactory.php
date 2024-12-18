<?php

declare(strict_types=1);

namespace App\factories;

use App\DataWrappers\UUID;
use App\Interfaces\Factories\ModelFactoryInterface;
use App\Interfaces\Models\ModelInterface;
use InvalidArgumentException;

final class ModelFactory implements ModelFactoryInterface
{
    public static function createModel(string $name, array $response): ModelInterface
    {
        $modelClassName = sprintf('App\\Models\\%s', $name);

        if (!class_exists($modelClassName)) {
            throw new InvalidArgumentException("Class doesn't exist. Check the passed arguments.");
        }

        return new $modelClassName(new UUID((string) $response['id']), $response['name']);
    }
}
