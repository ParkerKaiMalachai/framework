<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use PHPUnit\Framework\TestCase;
use App\Web\Sessions\SessionManager;

final class SessionManagerTest extends TestCase
{

    public function testStartSession(): void
    {
        $sessionManager = new SessionManager();

        $sessionManager->set('name', 'poop');

        $this->assertArrayHasKey('name', $sessionManager->get());
    }

    public function testDestroySession(): void
    {
        $sessionManager = new SessionManager();

        $sessionManager->set('name', 'poop');

        $sessionManager->remove('name');

        $this->assertArrayNotHasKey('name', $sessionManager->get());
    }
}
