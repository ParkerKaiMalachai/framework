<?php

declare(strict_types=1);

namespace app\src\classes\factories;

use app\src\interfaces\migrations\MigrationInterface;
use InvalidArgumentException;

final class MigrationFactory
{
    public static function createMigration(string $name): MigrationInterface
    {
        $migrationClassName = sprintf("app\\src\\classes\\migrations\\list\\%s", $name);

        if (!class_exists($migrationClassName)) {
            throw new InvalidArgumentException("Class doesn't exist. Check the passed arguments.");
        }

        return new $migrationClassName();
    }
}
