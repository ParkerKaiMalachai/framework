<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use App\Exceptions\Routes\FileNotFoundException;
use App\Web\Http\Response\Response;
use PHPUnit\Framework\TestCase;

final class ResponseTest extends TestCase
{
    public function testExceptionSend(): void
    {
        $this->expectException(FileNotFoundException::class);
        $this->expectExceptionMessage('File not found');

        $response = new Response();
        $response->send('unknown');
    }

    public function testExceptionSendJSON(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Wrong type of passed param');

        $response = new Response();
        $response->sendJSON([]);
    }
}
