<?php

declare(strict_types=1);

namespace app\routes;

use app\src\classes\exceptions\NotFoundRouterException;
use app\src\interfaces\RequestInterface;
use app\src\interfaces\ResponseInterface;
use app\src\interfaces\RouterInterface;


final class Router implements RouterInterface
{
    public function __construct(
        private array $routes,
        private string $uri,
        private ResponseInterface $response,
        private RequestInterface $request
    ) {}

    public function route(): void
    {
        if (!isset($this->routes[$this->uri])) {

            $params = $this->getControlDataWithParam();

            if (count($params) === 0) {

                $this->errorHandler("Path $this->uri not found", 404);
            }
        }

        if (isset($params) && count($params) !== 0) {

            $controllerLogicParams = $this->getInitData($params['controlData']);
        } else {

            $controllerLogicParams = $this->getInitData($this->routes[$this->uri]);
        }

        $action = $controllerLogicParams['action'];

        $nameOfControllerFactory = FACTORY_NAMESPACE . $controllerLogicParams['controllerName'] . 'Factory';

        $controller = $nameOfControllerFactory::createController($controllerLogicParams, $this->response, $this->request);

        $controller->$action();
    }

    private function getInitData(array $data): array
    {
        if (array_key_exists('params', $data)) {

            $initData['params'] = $data['params'];
        }

        $controller = $data['controller'];

        $controllerName = $controller . 'Controller';

        $action = $data['action'];

        $initData['pathName'] = $controller;
        $initData['controllerName'] = $controllerName;
        $initData['action'] = $action;

        return $initData;
    }

    private function getControlDataWithParam(): array
    {
        foreach ($this->routes as $key => $data) {
            if (array_key_exists('params', $data)) {
                $regexs[] = $key;
            }
        }

        if (!isset($regexs)) {
            return [];
        }

        foreach ($regexs as $regex) {

            if (!preg_match($regex, $this->uri, $match)) {
                $id = null;
                continue;
            }

            $id = $match['id'];

            $this->routes[$regex]['params']['id'] = $id;

            $controlData = $this->routes[$regex];

            break;
        }

        if (!isset($id) || !isset($controlData['params'])) {
            return [];
        }

        return ['controlData' => $controlData];
    }

    private function errorHandler(string $message, int $code): never
    {
        http_response_code($code);

        throw new NotFoundRouterException($message, $code);
    }
}
