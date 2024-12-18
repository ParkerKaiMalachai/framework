<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use App\DataWrappers\UUID;
use App\Models\Product;
use PHPUnit\Framework\TestCase;

final class ModelTest extends TestCase
{
    public function testGetFiels(): void
    {
        /**
         * @var mixed
         */
        $UUIDMock = Mockery::mock(UUID::class);

        $UUIDMock->shouldReceive('getID')->andReturn(1);

        $productModel = new Product($UUIDMock, 'name');

        $this->assertEquals(['id' => 1, 'name' => 'name'], $productModel->getFields());
    }
}
