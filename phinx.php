<?php

$dotenv = \Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

return
[
    'paths' => [
        'migrations' => '%%PHINX_CONFIG_DIR%%/migrations/migrations',
        'seeds' => '%%PHINX_CONFIG_DIR%%/migrations/seeds'
    ],
    'environments' => [
        'default_migration_table' => 'migrate',
        'default_environment' => 'development',
        'development' => [
            'adapter' => $_ENV['DB_CONNECTION'],
            'host' => $_ENV['DB_HOST'],
            'name' => $_ENV['DB_DATABASE'],
            'user' => $_ENV['DB_USERNAME'],
            'pass' => $_ENV['DB_PASSWORD'],
            'port' => $_ENV['DB_PORT'],
            'charset' => $_ENV['DB_CHARSET'],
        ],
    //    'production' => [
    //        'adapter' => 'mysql',
    //        'host' => 'mysql-db',
    //        'name' => 'library',
    //        'user' => 'user',
    //        'pass' => 'root',
    //        'port' => '3306',
    //        'charset' => 'utf8',
    //    ],
    //    'testing' => [
    //        'adapter' => 'mysql',
    //        'host' => 'localhost',
    //        'name' => 'testing_db',
    //        'user' => 'root',
    //        'pass' => '',
    //        'port' => '3306',
    //        'charset' => 'utf8',
    //    ]
    ],
    'version_order' => 'creation'
];
