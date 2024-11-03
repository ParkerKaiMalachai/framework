<?php

declare(strict_types=1);

namespace controllers;

use src\Classes\Controller;

class HomeController extends Controller
{
    public function index(string $path): void
    {
        $lowerCasePath = strtolower($path);
        require 'views/pages/' . $lowerCasePath . '.php';
    }
}