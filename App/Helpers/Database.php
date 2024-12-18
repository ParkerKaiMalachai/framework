<?php

declare(strict_types=1);

namespace App\Helpers;

use App\Web\Database\Connection\ConnectionDB;

$connector = ConnectionDB::getInstance();

$connector->setConnection("mysql:host=db;dbname=framework_db;charset=utf8", "framework_user", "framework_PASSWORD1");

$pdo = $connector->getConnection();
