<?php

declare(strict_types=1);

$textVar = "Base64 encoding encoding converts triples of eight-bit symbols into quadruples of six-bit symbols. 
Reading the input file in chunks chunks that are a multiple of three bytes in length results in a chunk that can be encoded independently 
independently of the rest of the input file.";

function countWordsInText(string $text): int
{
    return str_word_count($text);
}

function countWordsInTextByExplode(string $text): int
{
    return count(explode(" ", $text));
}

countWordsInText($textVar);
countWordsInTextByExplode($textVar);

function getUniqueText(string $text): string
{
    $arrFromText = explode(" ", $text);
    return implode(" ", array_unique($arrFromText));
}

getUniqueText($textVar);