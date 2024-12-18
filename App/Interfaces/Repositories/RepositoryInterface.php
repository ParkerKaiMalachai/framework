<?php

declare(strict_types=1);

namespace App\Interfaces\Repositories;

use App\DataWrappers\UUID;

interface RepositoryInterface
{
    public function getByID(UUID $id): mixed;
}
