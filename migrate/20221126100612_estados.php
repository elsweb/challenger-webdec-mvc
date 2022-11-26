<?php

use Phoenix\Migration\AbstractMigration;

class Estados extends AbstractMigration
{
    protected function up(): void
    {
        $this->table('estados')
            ->addColumn('uf', 'char', ["null" => true,])
            ->create();
    }

    protected function down(): void
    {
        $this->table('estados')->drop();
    }
}