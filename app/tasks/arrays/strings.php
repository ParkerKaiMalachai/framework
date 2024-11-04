<?php

declare(strict_types=1);

$arr = [
    "    Read a specific resource (by an identifier) or a collection of resources",
    "  Replace a specific resource (by an identifier) or a collection of resources",
    "  Update a specific resource (by an identifier) or a collection of resources"
];

function stringTransform(string $item): string 
{
    $item = trim($item);

    $item = strtoupper($item);

    $item = str_replace("SPECIFIC", "beep", $item);

    return $item;
}

$mappedArr = array_map("stringTransform", $arr);
