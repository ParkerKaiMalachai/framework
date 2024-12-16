<?php

declare(strict_types=1);

namespace app\src\classes\abstractions;

use app\src\interfaces\migrations\MigrationInterface;
use app\src\classes\exceptions\migrations\EmptyAttributesException;

abstract class AbstractMigration implements MigrationInterface
{
    public function createTable(string $name, array $values, array $constraints): string
    {
        $query = "";

        if (count($values) === 0) {
            throw new EmptyAttributesException('There should be at least one attribute');
        }

        foreach ($values as $key => $value) {
            $query .= sprintf('%s %s, ', $key, $value);
        }

        if (count($constraints)) {
            foreach ($constraints as $value => $constraint) {
                $query .= sprintf('%s (%s)', $constraint, $value);
            }
        }

        return "CREATE TABLE IF NOT EXISTS $name ($query)";
    }

    public function dropTable(string $name): string
    {
        return "DROP TABLE IF EXISTS $name";
    }
    abstract public function up();

    abstract public function down();
}