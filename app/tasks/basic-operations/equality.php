<?php

declare(strict_types=1);

function checkEmail(string $email): string
{
    preg_match("/[\w+-.]+@[\w.-]+[\w]{2,}/", $email, $matches);

    return count($matches) ? $matches[0] === $email ? "email is correct: $email \n"
        : "email is not correct: $email \n"
        : "email is not correct: $email \n";
}

checkEmail("example@example.beep.com");
checkEmail("example@example.c");
checkEmail("exampleexample.com");

function findStrWithCapitalLetter(string $str): array|string
{
    if (preg_match_all("/[A-Z]+[\w]{1,}/", $str, $matches)) {
        return $matches[0];
    }
    return "no matches string";
}

findStrWithCapitalLetter("Expressions are the most important building blocks of PHP. 
In PHP, almost anything you write is an expression.");