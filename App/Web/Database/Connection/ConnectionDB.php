<?php

declare(strict_types=1);

namespace App\Web\Database\Connection;

use App\Interfaces\Connection\ConnectionDBInterface;
use PDO;
use PDOException;

final class ConnectionDB implements ConnectionDBInterface
{
    private static $instance = null;

    private static PDO $connection;

    private function __construct() {}

    public static function getInstance(): ConnectionDB
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function setConnection(string $dsn, string $username, string $password): void
    {
        try {
            self::$connection = new PDO($dsn, $username, $password, [
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_EMULATE_PREPARES => false,
            ]);
        } catch (PDOException $e) {
            die("An error occured: $e");
        }
    }

    public function getConnection(): bool|PDO
    {
        if (!isset(self::$connection)) {
            return false;
        }

        return self::$connection;
    }

    private function __clone(): void {}

    private function __wakeup(): void {}
}
