<?php

declare(strict_types=1);

require 'autoload.php';

use routes\Router;

$router = new Router();

try {
    $router->route();
} catch (Exception $e) {
    echo $e->getMessage();
}