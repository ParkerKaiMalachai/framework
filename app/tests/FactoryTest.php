<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use app\src\classes\abstractions\AbstractController;
use app\src\classes\cache\RedisCache;
use app\src\classes\factories\ControllerFactory;
use app\src\classes\factories\MigrationFactory;
use app\src\classes\factories\ModelFactory;
use app\src\classes\Request;
use app\src\classes\Response;
use app\src\interfaces\migrations\MigrationInterface;
use app\src\interfaces\models\ModelInterface;
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
        /**
         * @var mixed
         */
        $mockPDO = Mockery::mock(PDO::class);

        /**
         * @var mixed
         */
        $mockRedis = Mockery::mock(Redis::class);

        $mockRedis->shouldReceive('connect')->with('redis', 6379);

        /**
         * @var mixed
         */
        $redisManagerMock = Mockery::mock(RedisCache::class);

        $redisManagerMock->shouldReceive('setHelper')->with($mockRedis);

        $productModel = ModelFactory::createModel($mockPDO, $redisManagerMock, 'Product');

        $this->assertInstanceOf(ModelInterface::class, $productModel);
    }
}
