<?php

namespace Controle\Database;

class Database
{
    protected $connection;

    public function __construct($host,$database,$user,$password)
    {
        $this->setConnection($host,$database,$user,$password);
    }

    /**
     * @return \PDO
     */
    public function getConnection(): \PDO
    {
        return $this->connection;
    }

    /**
     * @param $host
     * @param $database
     * @param $user
     * @param $password
     */
    public function setConnection($host,$database,$user,$password)
    {
        $this->connection = new \PDO('mysql:host=' . $host . ';dbname=' . $database,$user,$password,array(
            \PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
        ));
    }
}