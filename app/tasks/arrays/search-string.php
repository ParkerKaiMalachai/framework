<?php

declare(strict_types=1);

$textParts = [
    "Read a specific resource (by an identifier) or a collection of resources",
    "Replace a specific resource (by an identifier) or a collection of resources",
    "Update a specific resource (by an identifier) or a collection of resources"
];

function findStringInArray(string $pattern, array $arr): string
{
    if (in_array($pattern, $arr)) {
        return "this line was found \n";
    } else {
        return "this line was not found \n";
    }
}

findStringInArray("Read a specific resource (by an identifier) or a collection of resources", $textParts);

function findStringByArraySearch(string $pattern, array $arr): string
{
    if (array_search($pattern, $arr)) {
        return "this line was found \n";
    } else {
        return "this line was not found \n";
    }
}

findStringByArraySearch('String', $textParts);
