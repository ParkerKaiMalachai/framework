<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use PHPUnit\Framework\TestCase;
use app\src\classes\cookies\CookieManager;

final class CookieManagerTest extends TestCase
{
    public function testSetCookie(): void
    {
        $cookieManager = new CookieManager();

        $cookieManager->set('beep', 'val', 777, '/');

        $this->assertArrayHasKey('beep', $cookieManager->get());
    }

    public function testRemoveCookie(): void
    {
        $cookieManager = new CookieManager();

        $cookieManager->set('beep', 'val', 777, '/');

        $cookieManager->remove('beep');

        $this->assertArrayHasKey('beep', $cookieManager->get());
    }
}
