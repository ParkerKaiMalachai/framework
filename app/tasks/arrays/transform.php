<?php

declare(strict_types=1);

$arr = ["age" => 24, "color" => "green", "movie" => "Scream"];

$keys = array_keys($arr);

$arr[$keys[0]] = 25;

$values = array_values($arr);

for ($i = 0; $i < count($keys) - 1; $i++) {
    if ($arr[$keys[$i]] === $values[1]) {
        $arr[$keys[$i]] = "white";
    }
};

$flipped = array_flip($arr);