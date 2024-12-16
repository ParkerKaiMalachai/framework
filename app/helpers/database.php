<?php

declare(strict_types=1);

use app\src\classes\ConnectionDB;

$connector = ConnectionDB::getInstance();

$connector->setConnection("mysql:host=db;dbname=framework_db;charset=utf8", "framework_user", "framework_PASSWORD1");

$pdo = $connector->getConnection();
