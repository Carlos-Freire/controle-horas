<?php

namespace Controle\Models;

use Controle\Database\Connection;

class Model
{
    protected $connection;
    private $table;
    private $exclude;

    public function __construct()
    {
        $this->connection = Connection::getConnection();
        $this->exclude = array(
            'table',
            'connection'
        );
    }

    /**
     * @return \PDO
     */
    protected function getConnection(): \PDO
    {
        return $this->connection;
    }

    /**
     * @return mixed
     */
    protected function getTable()
    {
        return $this->table;
    }

    /**
     * @param mixed $table
     */
    protected function setTable($table)
    {
        $this->table = $table;
    }

    protected function executeInsert($params = array())
    {
        $id = 0;
        if (array_key_exists("table", $params))
        {
            $keys = array();
            $values = array();
            $data = array();
            $this->setTable($params['table']);
            $exclude = array_merge($this->exclude, array('id'));

            //faço um loop pelos objetos e descarto as chaves que eu não preciso
            foreach($params as $key => $value)
            {
                if (!in_array($key,$exclude))
                {
                    $keys[] = $key;
                    $values[] = ':' . $key;
                    $data[$key] = $value;
                }
            }
            $keys = implode($keys,',');
            $values = implode($values,',');

            try {
                $this->connection->beginTransaction();

                //crio a query para inserir os dados na tabela
                $sql = "INSERT INTO " . $this->getTable() . "(" . $keys . ") VALUES (" . $values . ")";
                $stmt = $this->connection->prepare($sql);
                $stmt->execute($data);
                $id = $this->connection->lastInsertId();
                $this->connection->commit();

            } catch (Exception $e) {
                $this->connection->rollback();
                throw $e;
            }
        }
        return $id;
    }

}