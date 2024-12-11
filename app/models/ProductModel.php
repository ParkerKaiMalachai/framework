<?php

declare(strict_types=1);

namespace app\models;

use app\src\classes\exceptions\ParamNotFoundException;
use app\src\interfaces\ModelInterface;

class ProductModel implements ModelInterface
{
    private array $data;

    public function __construct()
    {
        $this->data = [
            "1" => [
                "name" => "first product",
                "price" => 123,
                "quantity" => 333,
            ],
            "2" => [
                "name" => "second product",
                "price" => 444,
                "quantity" => 777,
            ]
        ];
    }

    public function getItemByID(string $id): mixed
    {
        if (!isset($this->data[$id])) {

            throw new ParamNotFoundException("Param $id not found");
        }

        return $this->data[$id];
    }
}
