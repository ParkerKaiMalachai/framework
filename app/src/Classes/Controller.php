<?php

declare(strict_types=1);

namespace src\Classes;

abstract class Controller
{
    abstract public function index(string $path);
}