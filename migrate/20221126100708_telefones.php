<?php

use Phoenix\Migration\AbstractMigration;

class Telefones extends AbstractMigration
{
    protected function up(): void
    {
        $this->table('telefones')
            ->addColumn('pessoa_id', 'integer')
            ->addForeignKey('pessoa_id', 'pessoas', 'id')
            ->addColumn('telefone', 'string')
            ->create();
    }

    protected function down(): void
    {
        $this->table('telefones')->drop();
    }
}
