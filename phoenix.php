<?php

return [
    'migration_dirs' => [
        'first' => __DIR__ . '/migrate',
    ],
    'environments' => [
        'local' => [
            'adapter' => 'mysql',
            'host' => APP['DB_HOST'] ?? 'localhost',
            'port' => APP['DB_PORT'] ?? 3306,
            'username' => APP['DB_USERNAME'] ?? 'root',
            'password' => APP['DB_PASSWORD'] ?? '',
            'db_name' => APP['DB_DATABASE'] ?? 'challengerwebdecmvc',
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_general_ci',
        ],
    ],
    'default_environment' => 'local',
    'log_table_name' => 'migrate',
];