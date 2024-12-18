<?php

declare(strict_types=1);

namespace App\Web\Sessions;

use App\Exceptions\Sessions\SessionEmptyParamException;
use App\Interfaces\Sessions\SessionManagerInterface;

final class SessionManager implements SessionManagerInterface
{
    private array $sessionValues = [];

    public function get(): array
    {
        return $this->sessionValues;
    }

    public function set(string $name, string $value): void
    {
        session_start();

        if (!isset($name) || !isset($value)) {

            throw new SessionEmptyParamException('empty param');
        }

        $_SESSION[$name] = $value;

        $this->sessionValues[$name] = $value;
    }

    public function remove(string $name): void
    {
        unset($_SESSION[$name]);

        if (isset($_COOKIE['PHPSESSID'])) {

            setcookie('PHPSESSID', '', time() - 3600, '/');
        }

        session_destroy();

        unset($this->sessionValues[$name]);
    }
}
