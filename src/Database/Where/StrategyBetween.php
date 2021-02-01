<?php

namespace Controle\Database\Where;

use Controle\Database\Where\InterfaceWhereStrategy;

class StrategyBetween implements InterfaceWhereStrategy
{
    public function getWhere(int $index, array $fields)
    {
        $sql = "";

        if ($index == 0)
            $sql .= "WHERE {$fields['date']} BETWEEN :{$fields['date']}_start AND :{$fields['date']}_end ";
        else
            $sql .= "AND {$fields['date']} BETWEEN :{$fields['date']}_start AND :{$fields['date']}_end ";

        return $sql;
    }
}