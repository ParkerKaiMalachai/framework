<?php

declare(strict_types=1);

namespace app\src\interfaces\migrations;

interface MigrationManagerInterface
{
    public function getMigrations();

    public function getPendingMigrations();

    public function runPendingMigration();

    public function rollbackMigration();

}