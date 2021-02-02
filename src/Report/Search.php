<?php

namespace Controle\Report;

use Controle\Models\Controle;
use Controle\Datatables\Datatables;

class Search
{
    protected $request;
    protected $model;

    public function __construct($request)
    {
        $this->request = $request;
        $this->model = new Controle;
    }

    public function getSearch()
    {
        //pegando todos os dados vindos do datatables e filtrando o conteudo
        $datatables = new Datatables($this->request);
        //pegando os campos criados por mim que serão usados na busca
        $datatables->setSearch(array(
            'dev',
            'cliente',
            'area',
            'dia',
            'hora_ini',
            'hora_fim',
            'de',
            'ate'
        ));
        //todos os campos do formulário filtrados
        return $datatables->getSearch();
    }
}