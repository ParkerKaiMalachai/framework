<?php

declare(strict_types=1);

function checkPassword(string $password): bool
{
    if (strlen($password) < 8 | strlen($password) > 20) {
        return false;
    }

    if (!preg_match("/(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[\W_])/", $password)) {
        return false;
    }

    return true;
}

checkPassword("loBvvvv1!*");

function checkIP(string $IP): array
{
    preg_match("/[0-9]{1,3}\.+[0-9]{1,3}\.+[0-9]{1,3}\.+[0-9]{1,3}/", $IP, $matches);
    return $matches;
}

checkIP("1.543.234.21");