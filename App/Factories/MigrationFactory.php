<?php

declare(strict_types=1);

namespace App\Factories;

use App\Interfaces\Migrations\MigrationInterface;
use InvalidArgumentException;

final class MigrationFactory
{
    public static function createMigration(string $name): MigrationInterface
    {
        $migrationClassName = sprintf("App\\Web\\Database\\Migrations\\List\\%s", $name);

        if (!class_exists($migrationClassName)) {
            throw new InvalidArgumentException("Class doesn't exist. Check the passed arguments.");
        }

        return new $migrationClassName();
    }
}
