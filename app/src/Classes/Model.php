<?php

declare(strict_types=1);

namespace src\Classes;

use Exception;

abstract class Model {
    private string $data;

    private string $id;

    abstract function getAll();

    abstract function getItemByID(string $id);

}