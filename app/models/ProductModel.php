<?php

declare(strict_types=1);

namespace models;

use src\Classes\Model;

class ProductModel extends Model
{
    public array $data;

    public string $id;

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

    public function getAll(): bool|string
    {
        return json_encode($this->data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    }

    public function getItemByID(string $id): bool|string
    {
        return json_encode($this->data[$id], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    }

}