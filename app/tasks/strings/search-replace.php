<?php

declare(strict_types=1);

$strVar = "Perform a regular expression search and replace.
 Perform a regular expression search and replace. Perform a regular expression search and replace.";

function searchAndReplaceSubstr(string $str, string $substr, string $replace): string
{
    return str_replace($substr, $replace, $str);
}

function searchAndReplaceSubstrByPattern(string $str, string $pattern, string $replace): array|string 
{
    return preg_replace($pattern, $replace, $str);
}


searchAndReplaceSubstr($strVar, "regular", "beep");
searchAndReplaceSubstrByPattern($strVar, "/regular/", "beep");