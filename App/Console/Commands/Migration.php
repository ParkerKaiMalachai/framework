<?php

declare(strict_types=1);

namespace Console\Commands;

require 'vendor/autoload.php';

use App\Web\Database\Connection\ConnectionDB;
use App\Exceptions\Migrations\EmptyAttributesException;
use App\Web\Database\Migrations\MigrationManager;

define("App\Helpers\FACTORY_NAMESPACE", 'App\\Factories\\');

$migrationsFolder = sprintf('%s%s', str_replace(
    '\\',
    DIRECTORY_SEPARATOR,
    realpath(dirname(dirname(__DIR__)))
), '/Web/Database/Migrations/List/*.php');

$allFiles = glob($migrationsFolder);

$connector = ConnectionDB::getInstance();
$connector->setConnection("mysql:host=db;dbname=framework_db;charset=utf8", "framework_user", "framework_PASSWORD1");
$pdo = $connector->getConnection();

$manager = new MigrationManager($pdo, $allFiles);

$params = getopt("", ['direction:']);


try {
    switch ($params['direction']) {
        case 'up': {
                $manager->runPendingMigration();
                break;
            }
        case 'down': {
                $manager->rollbackMigration();
                break;
            }
    }
} catch (EmptyAttributesException $e) {
    echo $e->getMessage();
}
