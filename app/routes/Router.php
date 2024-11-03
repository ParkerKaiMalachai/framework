<?php

declare(strict_types=1);

namespace routes;

use Exception;

final class Router
{
    public array $routes = [];

    public string $uri;

    public bool $match = false;

    public function __construct()
    {
        $this->routes = [
            '/' => ['controller' => 'Home', 'action' => 'index'],
            '/about' => ['controller' => 'About', 'action' => 'index'],
            '/contact' => ['controller' => 'Contact', 'action' => 'index'],
            '/product' => ['controller' => 'Product', 'action' => 'index'],
            '/product/(?P\d+)' => ['controller' => 'Product', 'action' => 'show', 'params' => ['id' => ':id']],
        ];

        $this->uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    }

    public function route(): void
    {

        foreach ($this->routes as $url => $controller) {
            if (!!$this->match) {

                break;

            }
            if (preg_match("/(?P<id>\d+)/", $this->uri, $matches) && preg_match("/[\d+]/", $url)) {

                $id = $matches[0];

                $nameController = "controllers\\" . $controller['controller'] . "Controller";

                $controllerInstance = new $nameController;

                $methodName = $controller['action'];

                $controllerInstance->$methodName($id, $controller['controller']);

                $this->match = true;

            } else if ($url === $this->uri) {

                $nameController = "controllers\\" . $controller['controller'] . "Controller";

                $controllerInstance = new $nameController;

                $methodName = $controller['action'];

                $controllerInstance->$methodName($controller['controller']);

                $this->match = true;

            }
        }
        ;

        if (!$this->match) {

            $this->errorHandler("Not found", 404);
            
        }

    }

    public function errorHandler(string $message, int $code): never
    {
        http_response_code($code);

        throw new Exception($message, $code);
    }
}
