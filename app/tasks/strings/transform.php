<?php

declare(strict_types=1);

$str = "Hello world ! 777";

$pattern = "/(\w+) (\w+) (!) (\d+)/i";

$replace = "$1 $2$3";

$trimmed = trim($str, "777");
$replacedByRegex = preg_replace($pattern, $replace, $str);
$replaceStr = str_replace("!", "!!!", $str);
