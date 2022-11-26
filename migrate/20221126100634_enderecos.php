<?php

use Phoenix\Migration\AbstractMigration;

class Enderecos extends AbstractMigration
{
    protected function up(): void
    {
        $this->table('enderecos')            
            ->addColumn('estados_id', 'integer', ["null" => true,])
            ->addForeignKey('estados_id', 'estados', 'id')
            ->addColumn('cep', 'string', ["null" => true,])
            ->addColumn('endereco', 'string', ["null" => true,])
            ->addColumn('numero', 'string', ["null" => true,])            
            ->create();
    }

    protected function down(): void
    {
        $this->table('enderecos')->drop();
    }
}
