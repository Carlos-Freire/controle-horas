<?php

namespace Controle\Models;

use Controle\Database\Connection;
use Controle\Database\Where\StrategyBetween;
use Controle\Database\Where\StrategyOperator;

class Model
{
    protected $connection;
    private $table;
    private $exclude;
    protected $select;
    protected $limit;
    protected $start;
    protected $orderBy;
    protected $order;
    protected $where;
    protected $groupBy;

    public function __construct($table)
    {
        $this->connection = Connection::getConnection();
        $this->exclude = array(
            'table',
            'connection',
            'start',
            'select',
            'limit',
            'orderBy',
            'order',
            'where',
            'groupBy'
        );
        $this->setTable($table);
        $this->where = array();
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

    public function executeUpdate($params = array())
    {
        if (array_key_exists("table", $params))
        {
            $keys = array();
            $data = array();
            $exclude = array_merge($this->exclude);

            //faço um loop pelos objetos e descarto as chaves que eu não preciso
            foreach($params as $key => $value)
            {
                if (!in_array($key,$exclude))
                {
                    $data[':' . $key] = $value;

                    if ($key !== "id") {
                        $keys[] = $key . ' = :' . $key;
                    }
                }
            }
            $keys = implode($keys,',');

            try {
                $this->connection->beginTransaction();

                //crio a query para atualizar os dados na tabela
                $sql = "UPDATE {$this->getTable()} SET {$keys} WHERE id = :id";
                $stmt = $this->connection->prepare($sql);
                $stmt->execute($data);
                $this->connection->commit();
                return true;

            } catch (Exception $e) {
                $this->connection->rollback();
                throw $e;
            }
        }
        return false;
    }

    /**
     * @return mixed
     */
    public function getSelect()
    {
        return $this->select;
    }

    /**
     * @param mixed $select
     * @return Model
     */
    public function setSelect($select)
    {
        $this->select = $select;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLimit()
    {
        return $this->limit;
    }

    /**
     * @param mixed $limit
     * @return Model
     */
    public function setLimit($limit)
    {
        $this->limit = $limit;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getStart()
    {
        return $this->start;
    }

    /**
     * @param mixed $start
     * @return Model
     */
    public function setStart($start)
    {
        $this->start = intval($start);
        return $this;
    }

    /**
     * @return mixed
     */
    public function getGroupBy()
    {
        return $this->groupBy;
    }

    /**
     * @param mixed $groupBy
     * @return Model
     */
    public function setGroupBy($groupBy)
    {
        $this->groupBy = $groupBy;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getOrderBy()
    {
        return $this->orderBy;
    }

    /**
     * @param mixed $orderBy
     * @return Model
     */
    public function setOrderBy($orderBy)
    {
        $this->orderBy = $orderBy;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * @param mixed $order
     * @return Model
     */
    public function setOrder($order)
    {
        if(!in_array($order,array('DESC', 'ASC')))
        $order = 'DESC';

        $this->order = $order;
        return $this;
    }

    /**
     * @return array
     */
    public function getWhere(): array
    {
        return $this->where;
    }

    /**
     * @param mixed $key
     * @param mixed $operator
     * @param mixed $value
     * @return Model
     */
    public function setWhere($key,$operator,$value): Model
    {
        $this->where[] = array(
            'key' => $key,
            'operator' => $operator,
            'value' => $value,
            'between' => false
        );
        return $this;
    }

    /**
     * @param mixed $key
     * @param mixed $start
     * @param mixed $end
     * @return Model
     */
    public function setWhereBetween($key,$start,$end): Model
    {
        $this->where[] = array(
            'date' => $key,
            'start' => $start,
            'end' => $end,
            'between' => true
        );
        return $this;
    }

    public function getResult()
    {
        $result = array(
            'records' => array(),
            'total' => 0
        );

        $select = $this->getSelect();
        $table = $this->getTable();
        $where = $this->getWhere();
        $orderBy = $this->getOrderBy();
        $order = $this->getOrder();
        $start = $this->getStart();
        $limit = $this->getLimit();
        $groupBy = $this->getGroupBy();

        if (!is_null($select) && !is_null($table)) {
            $result['records'] = $this->getRecords(
                $select,
                $table,
                $where,
                $orderBy,
                $order,
                $groupBy,
                $start,
                $limit
            );

            $result['total'] = $this->getTotal(
                $table,
                $where
            );
        }

        return $result;
    }

    private function getRecords($select,$table,$where,$orderBy,$order,$groupBy,$start,$limit)
    {
        $sql = "";
        if (!is_null($select) && !is_null($table)) {
            $sql = "SELECT {$select} FROM {$table} ";
        }

        if (count($where) > 0) {
            $sql .= $this->sqlWhere($where);
        }

        if (!is_null($orderBy) && !is_null($order)) {
            $sql .= " ORDER BY {$orderBy} {$order} ";
        }

        if (!is_null($groupBy)) {
            $sql .= " GROUP BY {$groupBy} ";
        }

        if (!is_null($start) && !is_null($limit)) {
            $sql .= " LIMIT {$start},{$limit}";
        }

        $stmt = $this->connection->prepare($sql);

        if (count($where) > 0) {
            $execute = $this->setExecuteWhere($where);
            $stmt->execute($execute);
        } else {
            $stmt->execute();
        }

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    private function getTotal($table,$where)
    {
        $total = 0;
        $sql = "";
        if (!is_null($table)) {
            $sql = "SELECT count(*) as total FROM {$table} ";
        }

        if (count($where) > 0) {
            $sql .= $this->sqlWhere($where);
        }

        $stmt = $this->connection->prepare($sql);

        if (count($where) > 0) {
            $execute = $this->setExecuteWhere($where);
            $stmt->execute($execute);
        } else {
            $stmt->execute();
        }

        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        foreach($result as $value)
        {
            $total = intval($value['total']);
        }

        return $total;
    }

    /*
     * Cria o array com os campos para o execute da PDO filtrar
     */
    private function setExecuteWhere($where): array
    {
        $execute = array();

        foreach($where as $field) {
            if ($field['between'] === false) {
                $execute[$field['key']] = $field['value'];
            } else {
                $execute[$field['date'] . '_start'] = $field['start'];
                $execute[$field['date'] . '_end'] = $field['end'];
            }
        }

        return $execute;
    }

    private function sqlWhere($where)
    {
        $between = new StrategyBetween;
        $operator = new StrategyOperator;
        $sql = "";
        $x = 0;
        foreach($where as $query) {

            if ($query['between'] === false)
                $sql .= $operator->getWhere($x, $query);
            else
                $sql .= $between->getWhere($x, $query);

            $x++;
        }
        return $sql;
    }

    public function delete($field, $value)
    {
        try {
            $sql = "DELETE FROM {$this->getTable()} WHERE {$field} = :{$field}";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(":{$field}", $value, \PDO::PARAM_STR);   
            $stmt->execute();

            return true;
        } catch (Exception $e) {
            $this->connection->rollback();
            throw $e;
        }

        return false;
    }
}