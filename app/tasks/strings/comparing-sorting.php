<?php

declare(strict_types=1);

$strArray = ["hello", "Hello", "heLLo", "hello"];

function sortStringsCaseSensitive(array $arr, string $type): array
{
    switch ($type) {
        case "desc":
            sort($arr);
            break;
        case "asc":
            asort($arr);
            break;
    }
    return $arr;
}
;

function sortStrings(array $arr, string $type): array
{
    switch ($type) {
        case "desc":
            usort($arr, fn($a, $b) => strnatcmp($a, $b));
            break;
        case "asc":
            usort($arr, fn($a, $b) => strnatcmp($b, $a));
            break;
    }
    return $arr;
}
sortStrings($strArray, "asc");
sortStringsCaseSensitive($strArray, "desc");
sortStringsCaseSensitive($strArray, "asc");

function compareStringsCaseInsensitive(string $firstStr, string $secondStr): string
{
    if (strcasecmp($firstStr, $secondStr) === 0) {
        return "these strings are equal case insensitive \n";
    } else {
        return "these string are not equal case insensitive \n";
    }
}
;

function compareStrings(string $firstStr, string $secondStr): string
{
    if (strnatcmp($firstStr, $secondStr) === 0) {
        return "these strings are equal case sensitive \n";
    } else {
        return "these strings are not equal case sensitive \n";
    }
}

compareStringsCaseInsensitive("hello", "hElLo");
compareStringsCaseInsensitive("hello", "hElLoo");

compareStrings("hello", "hello");
compareStrings("hello", "Hello");
