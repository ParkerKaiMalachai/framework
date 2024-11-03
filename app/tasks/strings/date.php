<?php

declare(strict_types=1);

$time = strtotime("27.10.2024");

function shiftDateFormat(int $date, string $format): string
{
    return date($format, $date);
}

shiftDateFormat($time, "Y-m-d");


;