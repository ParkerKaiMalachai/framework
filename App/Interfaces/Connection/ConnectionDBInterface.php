<?php

declare(strict_types=1);

namespace App\Interfaces\Connection;

use PDO;

interface ConnectionDBInterface
{
    public static function getInstance(): self;

    public function setConnection(string $dns, string $username, string $password): void;

    public function getConnection(): bool|PDO;
}
