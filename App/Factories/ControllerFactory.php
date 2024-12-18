<?php

declare(strict_types=1);

namespace App\Factories;

use App\Abstractions\AbstractController;
use App\Interfaces\Factories\ControllerFactoryInterface;
use App\Interfaces\Request\RequestInterface;
use App\Interfaces\Response\ResponseInterface;
use InvalidArgumentException;

final class ControllerFactory implements ControllerFactoryInterface
{
    public static function createController(array $logicData, ResponseInterface $response, RequestInterface $request): AbstractController
    {
        $controllerClassName = sprintf("App\\Web\Http\Controllers\\%s", $logicData['controllerName']);

        if (!class_exists($controllerClassName)) {
            throw new InvalidArgumentException("Class doesn't exist. Check the passed arguments.");
        }

        return new $controllerClassName($logicData, $response, $request);
    }
}
