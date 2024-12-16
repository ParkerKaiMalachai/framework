<?php

declare(strict_types=1);

namespace app\controllers;

use app\src\classes\abstractions\AbstractController;

final class ProductController extends AbstractController
{
    public function index(): void
    {
        $this->response->send($this->view);
    }

    public function show(): void
    {
        $id = $this->request->requestToModel(
            $this->logicData['params']['id'],
            $this->logicData['pathName'],
            'getItemByID'
        );

        $this->response->sendJSON($id);
    }
}
