<?php

declare(strict_types=1);

require 'autoload.php';

use routes\Router;

$routesArray = [
    '/' => ['controller' => 'Home', 'action' => 'index'],
    '/about' => ['controller' => 'About', 'action' => 'index'],
    '/contact' => ['controller' => 'Contact', 'action' => 'index'],
    '/product' => ['controller' => 'Product', 'action' => 'index'],
    '/product/(?P\d+)' => ['controller' => 'Product', 'action' => 'show', 'params' => ['id' => ':id']],
];

$uriPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$router = new Router($routesArray, $uriPath);

try {
    $router->route();
} catch (Exception $e) {
    echo $e->getMessage();
}