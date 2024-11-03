<?php

declare(strict_types=1);

function checkAnagram(string $str1, string $str2): string
{

    if (strlen($str1) !== strlen($str2)) {
        return 'not anagram';
    }
    
    $strArray1 = str_split($str1);
    $strArray2 = str_split($str2);

    sort($strArray1);
    sort($strArray2);

    return implode('', $strArray1) === implode('', $strArray2) ? 'anagram' : 'not anagram';

}

checkAnagram("taste", "state");

function checkPalindrom(string $str): string
{
    $result = [];

    $strArray = str_split($str);

    for ($i = count($strArray) - 1; $i >= 0; $i--) {
        array_push($result, $strArray[$i]);
    }

    return implode("", $result) === $str ? "palindrom" : "not palindrom";
}

checkPalindrom('bupub');