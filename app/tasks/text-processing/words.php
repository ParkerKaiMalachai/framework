<?php

declare(strict_types=1);

$textVar = "PHP can be considered as a partial case-sensitive language. 
The variable names are completely case-sensitive but function names are not.";

function getUniqueText(string $text): string
{
    $arr = explode(" ", $text);
    return implode(" ", array_unique($arr));
}

getUniqueText($textVar);