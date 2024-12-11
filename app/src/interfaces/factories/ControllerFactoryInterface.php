<?php

declare(strict_types=1);

namespace app\src\interfaces\factories;

use app\src\classes\abstractions\AbstractController;
use app\src\interfaces\ResponseInterface;
use app\src\interfaces\RequestInterface;

interface ControllerFactoryInterface
{
    public static function CreateController(array $logicData, ResponseInterface $response, RequestInterface $request): AbstractController;
}
