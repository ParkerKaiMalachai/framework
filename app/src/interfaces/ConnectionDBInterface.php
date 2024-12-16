<?php

declare(strict_types=1);

namespace app\src\interfaces;

use PDO;

interface ConnectionDBInterface
{
    public static function getInstance(): self;

    public function setConnection(string $dns, string $username, string $password): void;

    public function getConnection(): bool|PDO;
}