<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use app\routes\Router;
use app\src\classes\exceptions\FileNotFoundException;
use app\src\classes\exceptions\NotFoundRouterException;
use app\src\classes\exceptions\ParamNotFoundException;
use app\src\classes\Response;
use app\src\classes\Request;

const FACTORY_NAMESPACE = "app\\src\\classes\\factories\\";

$response = new Response();

$request = new Request();

$routes = [
    '/' => ['controller' => 'Home', 'action' => 'index'],
    '/about' => ['controller' => 'About', 'action' => 'index'],
    '/contact' => ['controller' => 'Contact', 'action' => 'index'],
    '/product\/(?P<id>\d+)/' => ['controller' => 'Product', 'action' => 'show', 'params' => ['id' => ':id']]
];

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$router = new Router($routes, $uri, $response, $request);

try {
    $router->route();
} catch (NotFoundRouterException $e) {

    echo $e->getMessage();
} catch (FileNotFoundException $e) {

    echo $e->getMessage();
} catch (ParamNotFoundException $e) {

    echo $e->getMessage();
} catch (Exception $e) {

    echo $e->getMessage();
}
