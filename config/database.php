<?php
declare(strict_types=1);

require_once dirname(__DIR__) . '/src/Environment.php';
\AfroVerified\Environment::load(dirname(__DIR__) . '/.env');

return [
    'driver' => 'pdo_mysql',
    'host' => getenv('DB_HOST') ?: 'localhost',
    'port' => (int) (getenv('DB_PORT') ?: 3306),
    'dbname' => getenv('DB_NAME') ?: 'afrove_new',
    'user' => getenv('DB_USER') ?: 'root',
    'password' => getenv('DB_PASSWORD') ?: 'password',
    'charset' => 'utf8mb4',
];
