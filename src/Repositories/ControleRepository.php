<?php

namespace Controle\Repositories;

use Controle\Models\Controle;
use Controle\Filters\ControleFilter;
use Controle\Datatables\Datatables;

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

    public function datatables($request)
    {
        $datatables = new Datatables($request);
        $order = $datatables->getOrder();
        $orderBy = $datatables->getOrderBy();


        $json = array();
        $json['draw'] = intval($request['draw']);
        $json['recordsTotal'] = 100;
        $json['recordsFiltered'] = 10;
        //var_dump($request);

        $result = $this->model->select(
            '*',
            'where',
            10,
            $orderBy,
            $order
        );

        if (count($result) > 0) {
            $json['data'] = $result;
        }

        return $json;
    }


}