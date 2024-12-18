<?php

declare(strict_types=1);

namespace App\Interfaces\Request;

use App\DataWrappers\UUID;
use App\Interfaces\Repositories\RepositoryInterface;

interface RequestInterface
{
    public function getRepository(string $name): ?RepositoryInterface;

    public function getUUID(string $id): ?UUID;
}
