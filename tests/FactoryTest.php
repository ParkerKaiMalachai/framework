<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use App\Abstractions\AbstractController;
use App\Factories\ControllerFactory;
use App\Factories\MigrationFactory;
use App\Factories\ModelFactory;
use App\Web\Http\Request\Request;
use App\Web\Http\Response\Response;
use App\Interfaces\Migrations\MigrationInterface;
use App\Interfaces\Models\ModelInterface;
use PHPUnit\Framework\TestCase;

final class FactoryTest extends TestCase
{
    public function testControllerFactory(): void
    {
        /**
         * @var mixed
         */
        $requestMock = Mockery::mock(Request::class);

        /**
         * @var mixed
         */
        $responseMock = Mockery::mock(Response::class);

        $logicData = ['pathName' => 'Home', 'controllerName' => 'HomeController', 'action' => 'index'];

        $homeController = ControllerFactory::createController(
            $logicData,
            $responseMock,
            $requestMock
        );

        $this->assertInstanceOf(AbstractController::class, $homeController);
    }

    public function testMigrationFactory(): void
    {
        $migrationInstance = MigrationFactory::createMigration('CreateProductMigration');

        $this->assertInstanceOf(MigrationInterface::class, $migrationInstance);
    }

    public function testModelFactory(): void
    {
        $productModel = ModelFactory::createModel('Product', ['id' => 1, 'name' => 'productName']);

        $this->assertInstanceOf(ModelInterface::class, $productModel);
    }
}
