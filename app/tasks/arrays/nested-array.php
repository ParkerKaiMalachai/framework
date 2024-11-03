<?php

declare(strict_types=1);

$nestedArray = [
    "users" => [
        "Andrew" => ["age" => 25, "city" => "Minsk"],
        "Kate" => ["age" => 27, "city" => "Grodno", "color" => ["blue", "green"]]
    ],
    "admin" => [
        "login" => "adminlogin",
        "password" => "adminpassword"
    ]
];

function loopNestedArr(array $arr): array
{
    $resultArray = [];

    foreach ($arr as $value) {
        if (is_array($value)) {
            $resultArray = array_merge($resultArray, loopNestedArr($value));
        } else {
            array_push($resultArray, $value);
        }
    }

    return $resultArray;
}

loopNestedArr($nestedArray);