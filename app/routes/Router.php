<?php

declare(strict_types=1);

namespace routes;

use Exception;

final class Router
{
    public array $routes = [];

    public string $uri;

    public bool $match = false;

    public function __construct(array $routes, string $uri)
    {
        $this->routes = $routes;

        $this->uri = $uri;

    }

    public function route(): void
    {
        foreach ($this->routes as $url => $controller) {
            if (!!$this->match) {
                break;
            }
            if (
                preg_match("/(?P<id>\d+)/", $this->uri, $matches)
                && preg_match("/[\d+]/", $url)
            ) {
                $id = $matches[0];
                $nameModel = "models\\" . $controller['controller'] . "Model";
                $modelInstance = new $nameModel;
                $allItems = $modelInstance->data;

                if (isset($allItems[$id])) {
                    $data = $modelInstance->getItemByID($id);
                    $nameController = "controllers\\" . $controller['controller'] . "Controller";
                    $controllerInstance = new $nameController($controller['controller'], $data);
                    $methodName = $controller['action'];
                    $controllerInstance->$methodName();
                    $this->match = true;
                }
            } elseif ($url === $this->uri) {
                $nameController = "controllers\\" . $controller['controller'] . "Controller";
                $nameModel = "models\\" . $controller['controller'] . "Model";
                if (class_exists($nameModel)) {
                    $modelInstance = new $nameModel;
                    $data = $modelInstance->getAll();
                } else {
                    $data = json_encode([]);
                }
                $controllerInstance = new $nameController($controller['controller'], $data);
                $methodName = $controller['action'];
                $controllerInstance->$methodName();
                $this->match = true;
            }
        }

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
