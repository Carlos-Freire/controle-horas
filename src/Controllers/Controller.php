<?php

namespace Controle\Controllers;

class Controller
{
    public function showJsonHeader()
    {
        header("Content-type: application/json; charset=utf-8");
    }
}