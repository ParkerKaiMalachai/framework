<?php

declare(strict_types=1);

namespace App\Interfaces\Cookies;

interface CookieManagerInterface
{
    public function get();

    public function set(string $name, string $value, int $expire, string $path);

    public function remove(string $name);
}
