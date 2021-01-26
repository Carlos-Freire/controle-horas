<?php

namespace Controle\Repositories;

use Controle\Models\Controle;
use Controle\Filters\ControleFilter;

class ControleRepository
{
    protected $model;

    public function __construct()
    {
        $this->model = new Controle;
    }

    public function add()
    {
        //pego os dados vindos do $_POST todos filtrados
        $form = new ControleFilter;
        //passo para o model gravar no banco
        $this->model->setDev($form->getDev());
        $this->model->setCliente($form->getCliente());
        $this->model->setArea($form->getArea());
        $this->model->setDia($form->getDia());
        $this->model->setHoraIni($form->getHoraIni());
        $this->model->setHoraFim($form->getHoraFim());
        //retorno o ultimo id inserido
        return $this->model->insert();
    }


}