<?php

declare(strict_types=1);

$helpers = scandir(__DIR__ . '/helpers');

for ($i = 2; $i < count($helpers); $i++) {
    $file = __DIR__ . '/helpers/' . $helpers[$i];

    if (!is_file($file)) {
        return;
    }

    require $file;
}
