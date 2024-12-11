<?php

declare(strict_types=1);

namespace app\src\classes\factories;

use app\controllers\AboutController;
use app\src\interfaces\factories\ControllerFactoryInterface;
use app\src\interfaces\RequestInterface;
use app\src\interfaces\ResponseInterface;

final class AboutControllerFactory implements ControllerFactoryInterface
{

    public static function createController(array $logicData, ResponseInterface $response, RequestInterface $request): AboutController
    {
        return new AboutController($logicData, $response, $request);
    }
}
