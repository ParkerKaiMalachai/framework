<?php

declare(strict_types=1);

namespace app\src\interfaces;

interface RequestInterface
{
    public function requestToModel(string $param, string $name, string $method): mixed;
}
