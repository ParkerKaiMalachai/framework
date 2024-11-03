<?php

declare(strict_types=1);

$text = "Привет.";

$HTMLVar = "<div>Hello world !!!!!</div>";

function replaceSubstr(string $str, string $search, string $replace): array|string|null
{
    return preg_replace($search, $replace, $str);
}

replaceSubstr($text, "/Привет/i", "Здравствуйте");

function removeHTMLTags(string $HTML): array|string|null 
{
    return preg_replace("/<[^>]>/", "", $HTML);
}

removeHTMLTags($HTMLVar);