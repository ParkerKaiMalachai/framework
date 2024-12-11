<?php

declare(strict_types=1);

namespace app\src\classes\factories;

use app\controllers\HomeController;
use app\src\interfaces\factories\ControllerFactoryInterface;
use app\src\interfaces\RequestInterface;
use app\src\interfaces\ResponseInterface;

final class HomeControllerFactory implements ControllerFactoryInterface
{
    public static function createController(array $logicData, ResponseInterface $response, RequestInterface $request): HomeController
    {
        return new HomeController($logicData, $response, $request);
    }
}
