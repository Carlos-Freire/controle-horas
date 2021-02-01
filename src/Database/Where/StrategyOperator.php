<?php

namespace Controle\Database\Where;

use Controle\Database\Where\InterfaceWhereStrategy;

class StrategyOperator implements InterfaceWhereStrategy
{
    public function getWhere(int $index, array $fields)
    {
        $sql = "";

        if ($index == 0)
            $sql .= "WHERE {$fields['key']} {$fields['operator']} :{$fields['key']} ";
        else
            $sql .= "AND {$fields['key']} {$fields['operator']} :{$fields['key']} ";

        return $sql;
    }
}