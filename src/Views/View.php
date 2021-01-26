<?php

namespace Controle\Views;

class View
{
    protected $dir;
    protected $file;

    public function __construct($name)
    {
        $this->file = preg_replace("/[^a-zA-Z0-9]/", "", $name);
        $this->dir = __DIR__ . DIRECTORY_SEPARATOR . 'files' . DIRECTORY_SEPARATOR;
    }

    public function show(array $vars)
    {
        include($this->dir . $this->file . ".php"); // Where $vars is an expected array of possible data
    }
}