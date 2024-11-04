<?php

declare(strict_types=1);

$firstArray = [12, 15, "hello", "color" => "white"];

$secondArray = [78, 'beep', false, "color" => "green"];

$mergedArray = array_merge($firstArray, $secondArray);

$recursiveMergedArray = array_merge_recursive($firstArray, $secondArray);