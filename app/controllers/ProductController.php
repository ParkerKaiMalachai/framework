<?php

declare(strict_types=1);

namespace controllers;

use src\Classes\Controller;

final class ProductController extends Controller
{
    public function index(): void
    {
        require $this->viewFile;
    }

    public function show(): void
    {
        header('Content-Type: application/json');
        echo $this->data;
    }
}