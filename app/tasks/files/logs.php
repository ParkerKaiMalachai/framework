<?php

declare(strict_types=1);

function extractErrorFromLogs(string $file): array
{
    $fileOpened = fopen($file, "r");

    $errors = [];

    while (($line = fgets($fileOpened)) !== false) {
        if (preg_match("/ERROR/", $line)) {
            array_push($errors, $line);
        }
    }

    return $errors;
}

extractErrorFromLogs("src/assets/log.logs");

function getNumsOfGetRequest(string $file): int
{
    $fileOpened = fopen($file, "r");

    $requests = [];

    while(($line = fgets($fileOpened)) !== false) {
        if (preg_match("/GET/", $line)) {
            array_push($requests, $line);
        }
    }

    return count($requests);
}

getNumsOfGetRequest("src/assets/log.logs");