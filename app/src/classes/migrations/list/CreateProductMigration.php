<?php

declare(strict_types=1);

namespace app\src\classes\migrations\list;

use app\src\classes\abstractions\AbstractMigration;

final class CreateProductMigration extends AbstractMigration
{
    public function up(): string
    {
        return $this->createTable(
            'products',
            ['id' => 'int AUTO_INCREMENT', 'name' => 'varchar(255)'],
            ['id' => 'PRIMARY KEY']
        );
    }

    public function down(): string
    {
        return $this->dropTable('products');
    }
}
