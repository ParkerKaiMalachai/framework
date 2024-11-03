<?php

declare(strict_types=1);

$HTMLText = "First link https://github.com/ParkerKaiMalachai/php-task-1/tree/master/app/src. Second link: https://www.php.net.";

$textVar = "blue, green, white, black, dark red";

function getURLFromHTML(string $HTML): array|string
{
    if (preg_match_all("/https?:\/\/(?:www\.)?\S+.\S+(?:\/[^\s*])?/i", $HTML, $matches)) {
        return $matches[0];
    }

    return 'no matched strings';
}

getURLFromHTML($HTMLText);

function getTextSeparatedByComma(string $text): array|bool
{
    return explode(",", $text);
}

getTextSeparatedByComma($textVar);
