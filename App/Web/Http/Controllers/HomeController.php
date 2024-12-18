<?php

declare(strict_types=1);

namespace App\Web\Http\Controllers;

use App\Abstractions\AbstractController;

final class HomeController extends AbstractController
{
    public function index(): void
    {
        $this->response->send($this->view);
    }
}
