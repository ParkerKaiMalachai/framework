<?php

declare(strict_types=1);

namespace App\Web\Database\Migrations;

use \PDO;
use App\Abstractions\AbstractMigration;
use App\Interfaces\Migrations\MigrationInterface;
use App\Interfaces\Migrations\MigrationManagerInterface;

use const App\Helpers\FACTORY_NAMESPACE;

final class MigrationManager implements MigrationManagerInterface
{
    private array $allMigrations = [];

    private array $pendingMigrations = [];

    private PDO $connection;

    public function __construct(PDO $connection, array $allFiles)
    {
        if (count($allFiles) > 0) {

            foreach ($allFiles as $file) {
                $this->allMigrations[] = pathinfo($file, PATHINFO_FILENAME);
            }
        }

        $this->connection = $connection;
    }
    public function getMigrations(): array
    {
        return $this->allMigrations;
    }

    public function getPendingMigrations(): array
    {
        $this->setPendingMigrations();

        return $this->pendingMigrations;
    }

    private function setPendingMigrations(): void
    {
        $data = $this->connection->query("SELECT name FROM migrations")->fetchAll();

        if (empty($data)) {
            $this->pendingMigrations = $this->allMigrations;
            return;
        }

        $completedMigrations = array_column($data, 'name');

        $this->pendingMigrations = array_diff($this->allMigrations, $completedMigrations);
    }

    public function runPendingMigration(): void
    {
        $this->getPendingMigrations();

        if (count($this->pendingMigrations) === 0) {
            return;
        }

        foreach ($this->pendingMigrations as $migrationClassName) {
            $migration = $this->getInstanceOfMigration($migrationClassName);
            $this->runMigration($migration, $migrationClassName);
        }
    }

    private function getInstanceOfMigration(string $instanceName): MigrationInterface
    {
        $migrationFactory = FACTORY_NAMESPACE . 'MigrationFactory';
        $migration = $migrationFactory::createMigration($instanceName);

        return $migration;
    }

    private function runMigration(AbstractMigration $migration, string $migrationName): void
    {
        $this->connection->query($migration->up());

        $this->writeNewMigration($migrationName);
    }

    private function writeNewMigration(string $name): void
    {
        $stmt = $this->connection->prepare("INSERT INTO migrations (name, executed_at) VALUES (?, CURRENT_TIMESTAMP())");

        $stmt->execute(array($name));
    }

    public function rollbackMigration(): void
    {
        $migrationArray = $this->getLatestMigration();

        if (count($migrationArray) === 0) {
            return;
        }

        $migration = $this->getInstanceOfMigration($migrationArray['migrationName']);

        $this->removeLatestMigration($migrationArray['migrationName']);

        $this->connection->query($migration->down());
    }

    private function getLatestMigration(): array
    {
        $latestMigrationName = $this->connection
            ->query("SELECT name FROM migrations WHERE id=(SELECT MAX(id) FROM migrations ORDER BY id DESC LIMIT 1)")
            ->fetchColumn();

        if (!$latestMigrationName) {
            return [];
        }

        return ['migrationName' => $latestMigrationName];
    }

    private function removeLatestMigration(string $name): void
    {
        $stmt = $this->connection->prepare("DELETE FROM migrations WHERE name=?");

        $stmt->execute([$name]);
    }
}
