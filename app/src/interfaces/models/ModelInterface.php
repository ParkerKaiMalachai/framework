<?php

declare(strict_types=1);

namespace app\src\interfaces\models;

interface ModelInterface
{
    public function getItemByID(string $id): mixed;
}
