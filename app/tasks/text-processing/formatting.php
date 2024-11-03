<?php

declare(strict_types=1);

function formatPhoneNumber(string $number): string
{
    $resultNum = sprintf("+%s (%sXX) XXX-XXXX", $number[0], $number[1]);

    return $resultNum;
}

function formatDate(string $date): string
{
    return (new DateTime($date))->format("d-m-Y");
};

formatDate("2024-10-24");