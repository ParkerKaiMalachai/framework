<?php

declare(strict_types=1);

$arr = [62, 5, "beep", true, "green", "lang" => "en"];

array_splice($arr, 1, 1);

unset($arr[2]);

array_shift($arr);

array_pop($arr);