<?php

declare(strict_types=1);

$strArray = ["handling handling", "handling handling handling"];

function getStringWithASpecificCount(array $array, int $count): string
{
    foreach ($array as $value) {
        if (preg_match("/^\s*(\w+\s+){" . ($count - 1) . "}\w+$/", $value) && is_string($value)) {
            return $value;
        }
    }
    return "no matched strings";
}

getStringWithASpecificCount($strArray, 2);

function getHTMLLink(string $link): string
{
    $HTML = "<a href=" . $link . ">link</a>";
    return $HTML;
}

getHTMLLink("https://skillbox.ru/");