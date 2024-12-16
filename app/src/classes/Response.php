<?php

declare(strict_types=1);

namespace app\src\classes;

use app\src\classes\exceptions\FileNotFoundException;
use app\src\interfaces\ResponseInterface;
use InvalidArgumentException;

class Response implements ResponseInterface
{
    public function send(string $file): void
    {
        $name = $file;

        $file = 'views/pages/' . $file . '.php';

        if (!$this->validViewFile($file)) {

            throw new FileNotFoundException('File not found');
        }

        require $file;
    }

    public function sendJSON(array $data): void
    {
        if (empty($data)) {
            throw new InvalidArgumentException('Wrong type of passed param');
        }

        header('Content-Type: application/json');

        $data = json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

        echo $data;
    }

    protected function validViewFile(string $file): bool
    {
        if (!file_exists($file)) {

            return false;
        }

        return true;
    }
}
