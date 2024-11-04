<?php

declare(strict_types=1);

function checkAnagram(string $str, string $str1): string
{
    if (strlen($str) !== strlen($str1)) {
        return "strings are not anagram";
    } 

    $arrOfFirstStr = str_split($str);
    $arrOfSecondStr = str_split($str1);

    return !!array_diff($arrOfFirstStr, $arrOfSecondStr) ? "strings are not anagrams \n" : "strings are anagrams \n";

}

checkAnagram("state", "taste");
checkAnagram("staye", "taste");
checkAnagram("staye", "tast");

function checkPalindrome(string $str): string
{
    $convertedStr = implode(array_reverse(str_split(strtolower($str))));    

    return strtolower($str) === $convertedStr ? "string is a palindrome \n" : "string is not a palindrome \n";

}

checkPalindrome("madam");
checkPalindrome("madamm");
checkPalindrome("level");
checkPalindrome("Mom");