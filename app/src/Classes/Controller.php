<?php

declare(strict_types=1);

namespace src\Classes;

abstract class Controller
{
    public string $path;

    public $data;

    public string $viewFile;

    public function __construct(string $path, $data)
    {
        $this->path = $path;

        $this->data = $data;

        $lowerCasePath = strtolower($path);

        $this->viewFile = 'views/pages/' . $lowerCasePath . '.php';

        if (
            (count(json_decode($this->data, true)) < 1)
            | !preg_match('/(?=.+\d)/', $path)
        ) {
            $this->data = json_decode($this->data, true);
        }

    }

}