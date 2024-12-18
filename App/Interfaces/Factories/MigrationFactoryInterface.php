<?php

declare(strict_types=1);

namespace App\Interfaces\Factories;

use App\Interfaces\Migrations\MigrationInterface;

interface MigrationFactoryInterface
{
    public static function createMigration(string $name): MigrationInterface;
}
