<?php

declare(strict_types=1);

namespace app\src\interfaces\sessions;

interface SessionManagerInterface
{
    public function get();

    public function set(string $name, string $value);

    public function remove(string $name);
}
