<?php

declare(strict_types=1);

namespace App\Abstractions;

use App\Interfaces\Request\RequestInterface;
use App\Interfaces\Response\ResponseInterface;

abstract class AbstractController
{
    public string $view;

    public function __construct(
        protected array $logicData,
        protected ResponseInterface $response,
        protected RequestInterface $request
    ) {
        $this->view = $this->logicData['pathName'];
    }

    abstract public function index(): void;
}
