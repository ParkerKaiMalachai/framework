<?php

declare(strict_types=1);

namespace app\src\classes\abstractions;

use app\src\interfaces\RequestInterface;
use app\src\interfaces\ResponseInterface;

abstract class AbstractController
{
    public string $view;

    public function __construct(
        protected array $logicData,
        protected ResponseInterface $response,
        protected RequestInterface $request
    ) {
        $toLowerPath = strtolower($this->logicData['pathName']);

        $this->view = $toLowerPath;
    }

    abstract public function index(): void;
}
