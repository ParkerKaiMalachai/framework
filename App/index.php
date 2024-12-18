<?php

declare(strict_types=1);

require 'vendor/autoload.php';
require 'Helpers/Database.php';
require 'Helpers/Redis.php';
require 'Helpers/Router.php';

use App\Web\Http\Routes\Router;
use App\Web\Cookies\CookieManager;
use App\Exceptions\Cookies\CookieEmptyParamsException;
use App\Exceptions\Routes\FileNotFoundException;
use App\Exceptions\Routes\NotFoundRouterException;
use App\Exceptions\Routes\ParamNotFoundException;
use App\Exceptions\Sessions\SessionEmptyParamException;
use App\Web\Http\Response\Response;
use App\Web\Http\Request\Request;
use App\Web\Sessions\SessionManager;

$cookieManager = new CookieManager();

$sessionManager = new SessionManager();

$response = new Response();

$request = new Request($pdo, $redisManager);

$router = new Router($routes, $uri, $response, $request);

try {
    $cookieManager->set('lang', 'ru', 86400, '/');
    $sessionManager->set('entry_time', date("Y-m-d H:i:s"));
    $router->route();
} catch (CookieEmptyParamsException $e) {
    echo $e->getMessage();
} catch (SessionEmptyParamException $e) {
    echo $e->getMessage();
} catch (NotFoundRouterException $e) {
    echo $e->getMessage();
} catch (FileNotFoundException $e) {
    echo $e->getMessage();
} catch (ParamNotFoundException $e) {
    echo $e->getMessage();
} catch (Exception $e) {
    echo $e->getMessage();
}

session_write_close();
