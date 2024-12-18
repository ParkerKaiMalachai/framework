<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use PHPUnit\Framework\TestCase;
use App\Web\Database\Migrations\MigrationManager;

final class MigrationManagerTest extends TestCase
{
    public function getInitParam(): array
    {
        $migrationsFolder = sprintf('%s%s', str_replace(
            '\\',
            DIRECTORY_SEPARATOR,
            realpath(dirname(__DIR__))
        ), '/App/Web/Database/Migrations/List/*.php');

        $allFiles = glob($migrationsFolder);

        define("App\Helpers\FACTORY_NAMESPACE", "App\\Factories\\");

        return $allFiles;
    }
    public function testGetMigrations(): void
    {
        $files = $this->getInitParam();
        $migrations = ["CreateProductMigration", "CreateUserMigration"];

        /**
         * @var mixed
         */
        $mockPDO = Mockery::mock(PDO::class);

        $manager = new MigrationManager($mockPDO, $files);

        $this->assertSame($migrations, $manager->getMigrations());
    }

    public function testGetPendingMigrations(): void
    {
        $files = $this->getInitParam();

        $migrations = ["CreateProductMigration", "CreateUserMigration"];

        /**
         * @var mixed
         */
        $mockPDOFetch = Mockery::mock(PDOStatement::class);

        /**
         * @var mixed
         */
        $mockPDO = Mockery::mock(PDO::class);

        $mockPDO->shouldReceive('query')->andReturn($mockPDOFetch);

        $mockPDOFetch->shouldReceive('fetchAll')->andReturn([]);


        $manager = new MigrationManager($mockPDO, $files);

        $this->assertSame($migrations, $manager->getPendingMigrations());
    }

    public function testRunPendingMigrations(): void
    {
        $files = $this->getInitParam();

        $migrations = ["CreateProductMigration", "CreateUserMigration"];

        $migrationsCompleted = [
            ['name' => "CreateProductMigration", 0 => "CreateProductMigration"],
            ['name' => "CreateUserMigration", 0 => "CreateUserMigration"]
        ];

        /**
         * @var mixed
         */
        $mockPDOFetch = Mockery::mock(PDOStatement::class);

        /**
         * @var mixed
         */
        $mockPDO = Mockery::mock(PDO::class);

        $mockPDO->shouldReceive('query')->andReturn($mockPDOFetch);

        $mockPDOFetch->shouldReceive('fetchAll')->andReturn($migrationsCompleted);

        $mockPDO->shouldReceive('prepare')->with("INSERT INTO migrations (name, executed_at) VALUES (?, CURRENT_TIMESTAMP())")
            ->andReturn($mockPDOFetch);

        foreach ($migrations as $migration) {
            $mockPDOFetch->shouldReceive('execute')->with(array($migration))->andReturn(true);
        }

        $manager = new MigrationManager($mockPDO, $files);

        $manager->runPendingMigration();

        $this->assertSame([], $manager->getPendingMigrations());
    }

    public function testRollbackMigration(): void
    {
        $files = $this->getInitParam();


        $migrationsCompleted = [
            ['name' => "CreateProductMigration", 0 => "CreateProductMigration"]
        ];

        /**
         * @var mixed
         */
        $mockPDOFetch = Mockery::mock(PDOStatement::class);

        /**
         * @var mixed
         */
        $mockPDO = Mockery::mock(PDO::class);

        $mockPDO->shouldReceive('query')
            ->with("SELECT name FROM migrations WHERE id=(SELECT MAX(id) FROM migrations ORDER BY id DESC LIMIT 1)")
            ->andReturn($mockPDOFetch);

        $deleteName = 'CreateUserMigration';

        $mockPDOFetch->shouldReceive('fetchColumn')->andReturn($deleteName);

        $mockPDO->shouldReceive('prepare')->with("DELETE FROM migrations WHERE name=?")
            ->andReturn($mockPDOFetch);

        $mockPDOFetch->shouldReceive('execute')->with(array($deleteName))->andReturn(true);

        $mockPDO->shouldReceive('query')->andReturn($mockPDOFetch);

        $mockPDOFetch->shouldReceive('fetchAll')->andReturn($migrationsCompleted);

        $manager = new MigrationManager($mockPDO, $files);

        $manager->rollbackMigration();

        $this->assertEquals('CreateUserMigration', $manager->getPendingMigrations()[1]);
    }
}
