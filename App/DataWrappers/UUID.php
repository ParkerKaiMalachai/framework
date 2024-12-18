<?php

declare(strict_types=1);

namespace App\DataWrappers;

use App\Interfaces\DataWrappers\UUIDInterface;

class UUID implements UUIDInterface
{
    public function __construct(private string $id) {}

    public function getID(): string
    {
        return $this->id;
    }
}
