<?php

declare(strict_types=1);

namespace app\src\interfaces\factories;

use app\src\interfaces\migrations\MigrationInterface;

interface MigrationFactoryInterface
{
    public static function createMigration(string $name): MigrationInterface;
}
