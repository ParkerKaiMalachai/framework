<?php

declare(strict_types=1);

namespace app\src\classes\factories;

use app\src\classes\abstractions\AbstractController;
use app\src\interfaces\factories\ControllerFactoryInterface;
use app\src\interfaces\RequestInterface;
use app\src\interfaces\ResponseInterface;
use InvalidArgumentException;

final class ControllerFactory implements ControllerFactoryInterface
{
    public static function createController(array $logicData, ResponseInterface $response, RequestInterface $request): AbstractController
    {
        $controllerClassName = sprintf("app\\controllers\\%s", $logicData['controllerName']);

        if (!class_exists($controllerClassName)) {
            throw new InvalidArgumentException("Class doesn't exist. Check the passed arguments.");
        }

        return new $controllerClassName($logicData, $response, $request);
    }
}
