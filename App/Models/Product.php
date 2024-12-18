<?php

declare(strict_types=1);

namespace App\Models;

use App\DataWrappers\UUID;
use App\Interfaces\Models\ModelInterface;
use InvalidArgumentException;

final class Product implements ModelInterface
{
    public function __construct(private UUID $id, private string $name) {}

    public function getFields(): array
    {
        if (!isset($this->id) || !isset($this->name)) {

            throw new InvalidArgumentException('Empty data fields.');
        }

        return ['id' => $this->id->getID(), 'name' => $this->name];
    }
}
