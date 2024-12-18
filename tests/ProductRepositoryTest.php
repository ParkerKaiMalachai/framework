<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use App\DataWrappers\UUID;
use App\Repositories\ProductRepository;
use App\Web\Cache\RedisCache;
use PHPUnit\Framework\TestCase;

final class ProductRepositoryTest extends TestCase
{
    public function testGetByID(): void
    {
        /**
         * @var mixed
         */
        $mockPDOStatement = Mockery::mock(PDOStatement::class);

        /**
         * @var mixed
         */
        $mockPDO = Mockery::mock(PDO::class);

        $mockPDO->shouldReceive('query')->with('SELECT * FROM products WHERE id = 1')->andReturn($mockPDOStatement);

        $mockPDOStatement->shouldReceive('fetch')->andReturn(serialize(['id' => 1, 'name' => 'productName']));

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

        /**
         * @var mixed
         */
        $UUIDMock = Mockery::mock(UUID::class);

        $UUIDMock->shouldReceive('getID')->andReturn(1);

        $productRepository = new ProductRepository($mockPDO, $redisManagerMock);

        $this->assertEquals(['id' => 1, 'name' => 'productName'], $productRepository->getByID($UUIDMock));
    }
}
