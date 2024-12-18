<?php

declare(strict_types=1);

namespace App\Interfaces\Factories;

use App\Abstractions\AbstractController;
use App\Interfaces\Response\ResponseInterface;
use App\Interfaces\Request\RequestInterface;

interface ControllerFactoryInterface
{
    public static function CreateController(array $logicData, ResponseInterface $response, RequestInterface $request): AbstractController;
}
