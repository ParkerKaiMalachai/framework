<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use app\src\classes\ConnectionDB;
use app\src\classes\exceptions\migrations\EmptyAttributesException;
use app\src\classes\migrations\MigrationManager;

const FACTORY_NAMESPACE = "app\\src\\classes\\factories\\";

$migrationsFolder = sprintf('%s%s', str_replace(
    '\\',
    DIRECTORY_SEPARATOR,
    realpath(dirname(__DIR__))
), '/src/classes/migrations/list/*.php');

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
