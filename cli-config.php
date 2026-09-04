<?php
declare(strict_types=1);

use Doctrine\DBAL\DriverManager;
use Doctrine\Migrations\Configuration\Migration\PhpFile;
use Doctrine\Migrations\DependencyFactory;
use Doctrine\Migrations\Configuration\Connection\ExistingConnection;

require_once __DIR__ . '/vendor/autoload.php';
$connection = DriverManager::getConnection(require __DIR__ . '/config/database.php');
return DependencyFactory::fromConnection(new PhpFile(__DIR__ . '/migrations.php'), new ExistingConnection($connection));
