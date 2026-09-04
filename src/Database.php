<?php
declare(strict_types=1);

namespace AfroVerified;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\DriverManager;

final class Database
{
    private static ?Connection $connection = null;

    public static function connection(): Connection
    {
        return self::$connection ??= DriverManager::getConnection(require dirname(__DIR__) . '/config/database.php');
    }
}
