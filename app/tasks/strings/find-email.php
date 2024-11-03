<?php

declare(strict_types=1);

$str = "Perform a regular expression search and replace te_st.beep@example.group.com 
        Perform a regular expression search and replace test@domain.org 
        Perform a regular expression search and replace boom@example.com";

function getEmails(string $string): array|bool
{
    preg_match_all("/[\w.-]+@[\w.-]+\.\w{2,}/", $string, $matches);
    return $matches[0];
}

getEmails($str);
