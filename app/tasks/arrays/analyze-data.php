<?php

declare(strict_types=1);

$data = [
    "first-goods" => ["price" => 250, "quantity" => 1000, "sold_quantity" => 560, "spoiled" => true],
    "second-goods" => ["price" => 350, "quantity" => 1050, "sold_quantity" => 340, "spoiled" => false],
    "third-goods" => ["price" => 100, "quantity" => 400, "sold_quantity" => 50, "spoiled" => true],
    "fourth-goods" => ["price" => 50, "quantity" => 20, "sold_quantity" => 0, "spoiled" => true],
    "fifth-goods" => ["price" => 500, "quantity" => 460, "sold_quantity" => 450, "spoiled" => false],
    "sixth-goods" => ["price" => 200, "quantity" => 5000, "sold_quantity" => 2500, "spoiled" => false],
    "seventh-goods" => ["price" => 600, "quantity" => 60, "sold_quantity" => 30, "spoiled" => false],
];

function getSum(array $arr): array
{
    $notSpoiled = array_filter($arr, fn($item) => !$item["spoiled"]);
    $profit = array_reduce($notSpoiled, fn($acc, $cur) => $acc += $cur["price"] * $cur["sold_quantity"], 0);
    $futureProfit = array_reduce($notSpoiled, 
    fn($acc, $cur) => $acc += ($cur["quantity"] - $cur["sold_quantity"]) * $cur["price"], 0);

    return ["activeProfit" => $profit, "futureProfit" => $futureProfit];
}
;

getSum($data);