<?php

namespace Controle\Database\Where;

interface InterfaceWhereStrategy
{
    public function getWhere(int $index, array $fields);
}