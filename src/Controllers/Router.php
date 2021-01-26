<?php

namespace Controle\Controllers;

class Router
{
    protected $controller;
    protected $actions;
    protected $default;

    public function __construct($controller,array $actions = array('index'), $default = 'index')
    {
        $this->controller = $controller;
        $this->actions = $actions;
        $this->default = $default;
    }

    public function show()
    {
        if (isset($_GET['action']) && !empty($_GET['action']) && in_array($_GET['action'],$this->actions))
            $this->controller->{$_GET['action']}();
        else
            $this->controller->{$this->default}();
    }
}