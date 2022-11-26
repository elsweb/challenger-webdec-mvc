<?php

use Phoenix\Migration\AbstractMigration;

class Usuarios extends AbstractMigration
{
    protected function up(): void
    {
        $this->table('usuarios')
            ->addColumn('username', 'string')
            ->addColumn('password', 'string')
            ->create();
    }

    protected function down(): void
    {
        $this->table('usuarios')->drop();
    }
}