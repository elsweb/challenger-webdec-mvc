<?php

use Phoenix\Migration\AbstractMigration;

class Pessoas extends AbstractMigration
{
    protected function up(): void
    {
        $this->table('pessoas')
            ->addColumn('endereco_id', 'integer')
            ->addForeignKey('endereco_id', 'enderecos', 'id')
            ->addColumn('nome', 'string')
            ->addColumn('cpf', 'string')
            ->addColumn('rg', 'string')
            ->addColumn('data_nascimento', 'date')
            ->addColumn('data_cadastro', 'datetime')
            ->addColumn('data_atualizacao', 'datetime')
            ->addColumn('data_exclusao', 'datetime')
            ->create();
    }

    protected function down(): void
    {
        $this->table('pessoas')->drop();
    }
}
