<?php

declare(strict_types=1);

namespace app\src\classes\factories;

use app\controllers\ProductController;
use app\src\interfaces\factories\ControllerFactoryInterface;
use app\src\interfaces\RequestInterface;
use app\src\interfaces\ResponseInterface;

final class ProductControllerFactory implements ControllerFactoryInterface
{
    public static function createController(array $logicData, ResponseInterface $response, RequestInterface $request): ProductController
    {
        return new ProductController($logicData, $response, $request);
    }
}
