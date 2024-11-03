<?php

declare(strict_types=1);

$array = [5, 3, 6, 7, 1, 4];

$arrayForMerge = [10, 7, 11, 5];


function mergeFunc(array $first, array $second): array
{
    $result = [];
    while (count($first) && count($second)) {
        if ($first[0] > $second[0]) {
            array_push($result, array_shift($second));
        } else {
            array_push($result, array_shift($first));
        }
    }

    return array_merge($result, $second, $first);
}

function mergeSortFunc(array $arr): array
{
    if (count($arr) < 2) {
        return $arr;
    }
    $first = array_slice($arr, 0, count($arr) / 2);
    $second = array_slice($arr, count($arr) / 2);
    return mergeFunc(mergeSortFunc($first), mergeSortFunc($second));
}

mergeSortFunc($arrayForMerge);

function bubbleSort(array $arr): array
{
    for ($i = count($arr) - 1; $i > 0; $i--) {
        for ($j = 0; $j < $i; $j++) {
            if ($arr[$j] > $arr[$j + 1]) {
                $cur = $arr[$j];
                $arr[$j] = $arr[$j + 1];
                $arr[$j + 1] = $cur;
            }
        }
    }
    return $arr;
}

bubbleSort($array);