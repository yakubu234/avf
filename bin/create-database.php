<?php
declare(strict_types=1);

$config = require dirname(__DIR__) . '/config/database.php';
$pdo = new PDO(
    sprintf('mysql:host=%s;port=%d;charset=utf8mb4', $config['host'], $config['port']),
    $config['user'],
    $config['password'],
    [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
);
$database = str_replace('`', '``', $config['dbname']);
$pdo->exec("CREATE DATABASE IF NOT EXISTS `$database` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
echo "Database {$config['dbname']} is ready.\n";
