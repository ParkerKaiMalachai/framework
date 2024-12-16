<?php

declare(strict_types=1);

require 'vendor/autoload.php';
require 'fileload.php';

use app\routes\Router;
use app\src\classes\cookies\CookieManager;
use app\src\classes\exceptions\cookies\CookieEmptyParamsException;
use app\src\classes\exceptions\FileNotFoundException;
use app\src\classes\exceptions\NotFoundRouterException;
use app\src\classes\exceptions\ParamNotFoundException;
use app\src\classes\exceptions\sessions\SessionEmptyParamException;
use app\src\classes\Response;
use app\src\classes\Request;
use app\src\classes\sessions\SessionManager;

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
