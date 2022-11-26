<?php

use Phoenix\Migration\AbstractMigration;

class Pessoas extends AbstractMigration
{
    protected function up(): void
    {
        $this->table('pessoas')
            ->addColumn('enderecos_id', 'integer', ["null" => true,])
            ->addForeignKey('enderecos_id', 'enderecos', 'id')
            ->addColumn('nome', 'string', ["null" => true,])
            ->addColumn('cpf', 'string', ["null" => true,])
            ->addColumn('rg', 'string', ["null" => true,])
            ->addColumn('data_nascimento', 'date', ["null" => true,])
            ->addColumn('data_cadastro', 'datetime', ["null" => true,])
            ->addColumn('data_atualizacao', 'datetime', ["null" => true,])
            ->addColumn('data_exclusao', 'datetime', ["null" => true,])
            ->create();
    }

    protected function down(): void
    {
        $this->table('pessoas')->drop();
    }
}
