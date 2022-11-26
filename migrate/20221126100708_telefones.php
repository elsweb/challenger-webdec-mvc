<?php

use Phoenix\Migration\AbstractMigration;

class Telefones extends AbstractMigration
{
    protected function up(): void
    {
        $this->table('telefones')
            ->addColumn('pessoas_id', 'integer', ["null" => true,])
            ->addForeignKey('pessoas_id', 'pessoas', 'id')
            ->addColumn('telefone', 'string', ["null" => true,])
            ->create();
    }

    protected function down(): void
    {
        $this->table('telefones')->drop();
    }
}
