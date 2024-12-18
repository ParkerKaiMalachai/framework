<?php

declare(strict_types=1);

namespace App\Interfaces\Sessions;

interface SessionManagerInterface
{
    public function get();

    public function set(string $name, string $value);

    public function remove(string $name);
}
