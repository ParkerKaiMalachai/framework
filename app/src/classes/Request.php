<?php

declare(strict_types=1);

namespace app\src\classes;

use app\src\interfaces\RequestInterface;

class Request implements RequestInterface
{
    public function getModel(array $logicData): mixed
    {
        $factoryName = FACTORY_NAMESPACE . $logicData['pathName'] . "ModelFactory";

        $model = $factoryName::createModel($logicData);

        $id = $model->getItemByID($logicData['params']['id']);

        return $id;
    }
}
