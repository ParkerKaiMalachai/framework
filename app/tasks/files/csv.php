<?php

declare(strict_types=1);

function getCSV(string $file): array
{
    $result = [];

    $fileOpened = fopen($file, 'r');

    $CSVarr = [];

    while (($line = fgets($fileOpened)) !== false) {
        array_push($CSVarr, $line);
    }

    $headers = explode(",", $CSVarr[0]);

    for ($i = 1; $i < count($CSVarr); $i++) {

        $userData = explode(",", $CSVarr[$i]);

        for ($j = 0; $j < count($headers); $j++) {
            $values[$headers[$j]] = $userData[$j];
        }

        $result[] = $values;
    }

    return $result;
}

getCSV("src/assets/data.csv");