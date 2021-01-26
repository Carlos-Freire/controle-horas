<?php
if (!defined('CONTROLE')) return;

//carrego os arquivos do projeto que estão no autoload psr-4
require __DIR__ . '/vendor/autoload.php';

//carrego os arquivos do banco
require __DIR__ . '/config.php';

//carrego os helpers
require __DIR__ . '/helpers.php';
