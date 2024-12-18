<?php

declare(strict_types=1);

namespace App\Web\Database\Migrations\List;

use App\Abstractions\AbstractMigration;

final class CreateUserMigration extends AbstractMigration
{
    public function up(): string
    {
        return $this->createTable(
            'users',
            ['id' => 'int AUTO_INCREMENT', 'name' => 'varchar(255)'],
            ['id' => 'PRIMARY KEY']
        );
    }

    public function down(): string
    {
        return $this->dropTable('users');
    }
}
