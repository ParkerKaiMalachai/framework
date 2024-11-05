<?php

declare(strict_types=1);

namespace controllers;

use src\Classes\Controller;

final class AboutController extends Controller
{
    public function index(): void
    {
        require $this->viewFile;
    }
}