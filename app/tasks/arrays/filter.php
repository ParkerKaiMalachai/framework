<?php

declare(strict_types=1);

$users = ["Harry" => 16, "Hermione" => 23, "Ron" => 30];

function filterAge(int $age): bool
{
    return $age > 18;
}

$filteredArray = array_filter($users, "filterAge");
