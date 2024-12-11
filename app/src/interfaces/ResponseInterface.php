<?php

declare(strict_types=1);

namespace app\src\interfaces;

interface ResponseInterface
{
    public function send(string $file);

    public function sendJSON(array $data);
}
