<?php

declare(strict_types=1);

namespace app\src\interfaces;

use app\src\classes\abstractions\AbstractController;
use app\src\interfaces\ResponseInterface;

interface ControllerFactoryInterface
{
    public static function CreateController(array $logicData, ResponseInterface $response, RequestInterface $request): AbstractController;
}
