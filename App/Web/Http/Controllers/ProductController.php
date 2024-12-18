<?php

declare(strict_types=1);

namespace App\Web\Http\Controllers;

use App\Abstractions\AbstractController;

final class ProductController extends AbstractController
{
    public function index(): void
    {
        $this->response->send($this->view);
    }

    public function show(): void
    {
        $repository = $this->request->getRepository(
            $this->logicData['pathName']
        );

        $UUID = $this->request->getUUID($this->logicData['params']['id']);

        $result = $repository->getByID($UUID);

        $this->response->sendJSON($result);
    }
}
