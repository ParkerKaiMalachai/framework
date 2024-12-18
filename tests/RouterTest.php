<?php

declare(strict_types=1);

require 'vendor/autoload.php';
require 'autoload.php';

use App\Web\Http\Routes\Router;
use App\Exceptions\Routes\NotFoundRouterException;
use App\Web\Http\Request\Request;
use App\Web\Http\Response\Response;
use PHPUnit\Framework\TestCase;

final class RouterTest extends TestCase
{
    public function testExceptionRoute(): void
    {
        $this->expectException(NotFoundRouterException::class);
        $this->expectExceptionMessage('Path /unknown not found');

        $routes = [
            '/home' => ['controller' => 'Home', 'action' => 'index']
        ];

        define('app\routes\FACTORY_NAMESPACE', "app\\src\\classes\\factories\\");

        $uri = '/unknown';

        /**
         * @var mixed
         */
        $requestMock = Mockery::mock(Request::class);

        /**
         * @var mixed
         */
        $responseMock = Mockery::mock(Response::class);

        $responseMock->shouldReceive('send')->with('unknown')->andReturn('');

        $router = new Router($routes, $uri, $responseMock, $requestMock);

        $router->route();
    }
}
