<?php

declare(strict_types=1);

namespace App\Interfaces\Response;

interface ResponseInterface
{
    public function send(string $file): void;

    public function sendJSON(array $data): void;
}
