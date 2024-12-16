<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use app\models\ProductModel;
use app\src\classes\cache\RedisCache;
use PHPUnit\Framework\TestCase;

final class ModelTest extends TestCase
{
    public function testGetItemByID(): void
    {
        /**
         * @var mixed
         */
        $mockPDOStatement = Mockery::mock(PDOStatement::class);

        /**
         * @var mixed
         */
        $mockPDO = Mockery::mock(PDO::class);

        $mockPDO->shouldReceive('query')->with('SELECT * FROM products WHERE id=1')->andReturn($mockPDOStatement);

        $mockPDOStatement->shouldReceive('fetchAll')->andReturn(['1' => ['name' => 'productName']]);

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

        $redisManagerMock->shouldReceive('get')->andReturn(null);

        $redisManagerMock->shouldReceive('set')->andReturn(true);

        $productModel = new ProductModel($mockPDO, $redisManagerMock);


        $this->assertEquals(['1' => ['name' => 'productName']], $productModel->getItemByID('1'));
    }

    public function testGetItemByIDWithEmptyParam(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Empty param');

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

        $productModel = new ProductModel($mockPDO, $redisManagerMock);

        $productModel->getItemByID('');
    }
}
