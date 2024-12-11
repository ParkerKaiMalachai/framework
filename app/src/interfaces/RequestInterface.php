<?php

declare(strict_types=1);

namespace app\src\interfaces;

interface RequestInterface
{
    public function getModel(array $logicData): mixed;
}
