<?php

declare(strict_types=1);

namespace app\controllers;

use app\src\classes\abstractions\AbstractController;

final class AboutController extends AbstractController
{
    public function index(): void
    {
        $this->response->send($this->view);
    }
}
