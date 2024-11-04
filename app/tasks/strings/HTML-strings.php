<?php

declare(strict_types=1);

$HTML = "<h1>Hello world!</h1><p>Beep</p>";

$HTMLWithURL = "First link https://github.com/ParkerKaiMalachai/php-task-1/tree/master/app/src. Second link: https://www.php.net.";

function extractTextFromHTML(string $HTML): array|string
{
    return preg_replace("/<[^>]+>/", "", $HTML);
}

function extractURLFromHTML(string $HTML): array|bool
{
    preg_match_all(
        "/https?:\/\/(?:www\.)?\S+\.\S+(?:\/[^\s]*)?/i",
        $HTML,
        $matches
    );
    return $matches[0];
}

extractTextFromHTML($HTML);

extractURLFromHTML($HTMLWithURL);