<?php

declare(strict_types=1);

namespace controllers;

use src\Classes\Controller;

class ProductController extends Controller
{
    public function index(string $path): void
    {
        $modelPath = "models\\" . $path . "Model";
        $model = new $modelPath();
        $item = $model->getAll();
        $data = json_decode($item, true);
        $lowerCasePath = strtolower($path);
        require 'views/pages/' . $lowerCasePath . '.php';
    }

    public function show(string $id, string $path): void
    {
        $modelPath = "models\\" . $path . "Model";
        $model = new $modelPath();
        $item = $model->getItemByID($id);
        header('Content-Type: application/json');
        echo $item;
    }
}