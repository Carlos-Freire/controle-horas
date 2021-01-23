<?php

namespace Controle\Database;

use Controle\Database\Database;

class Connection
{
    private static $connection;

    private function __construct() {}
    private function __clone() {}
    private function __wakeup() {}

    public static function getConnection()
    {
        if(self::$connection === null) {
            $database =  new Database(HOST,DATABASE,USER,PASSWORD);
            self::$connection = $database->getConnection();
        }
        return self::$connection;
    }
}