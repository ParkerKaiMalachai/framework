<?php

declare(strict_types=1);

namespace App\Helpers;

const FACTORY_NAMESPACE = "App\\Factories\\";

$routes = [
    '/' => ['controller' => 'Home', 'action' => 'index'],
    '/about' => ['controller' => 'About', 'action' => 'index'],
    '/contact' => ['controller' => 'Contact', 'action' => 'index'],
    '/product\/(?P<id>\d+)/' => ['controller' => 'Product', 'action' => 'show', 'params' => ['id' => ':id']]
];

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
