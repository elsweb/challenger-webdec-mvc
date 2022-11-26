<?php

use Phoenix\Migration\AbstractMigration;

class Enderecos extends AbstractMigration
{
    protected function up(): void
    {
        $this->table('enderecos')            
            ->addColumn('estado_id', 'integer')
            ->addColumn('cep', 'string')
            ->addColumn('endereco', 'string')
            ->addColumn('numero', 'string')
            ->addForeignKey('estado_id', 'estados', 'id')
            ->create();
    }

    protected function down(): void
    {
        $this->table('enderecos')->drop();
    }
}
