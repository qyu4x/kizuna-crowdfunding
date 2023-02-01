<?php

namespace Hikaru\MVC\Crowdfunding\Config;

use phpDocumentor\Reflection\Types\Self_;

class Database {

    private static ?\PDO $connection = null;

    public static function getConnection(?string $env) : \PDO {
        if (self::$connection == null) {
            // crete new PDO connection
            require_once __DIR__ . '/../../config/DatabaseConfig.php';

            $config = getDatabaseConfig();

            self::$connection = new \PDO(
                dsn: $config['database'][$env]['url'],
                username: $config['database'][$env]['username'],
                password:  $config['database'][$env]['password']
            );

            return self::$connection;
        }

        return self::$connection;
    }

    // helper
    public static function startTransaction() {
        self::$connection->beginTransaction();
    }

    public static function commitTransaction() {
        self::$connection->commit();
    }

    public static function rollbackTransaction() {
        self::$connection->rollBack();
    }

}
