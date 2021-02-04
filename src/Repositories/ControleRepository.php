<?php

namespace Controle\Repositories;

use Controle\Models\Controle;
use Controle\Filters\ControleFilter;
use Controle\Datatables\Datatables;
use Controle\Report\ReportFactory;
use Controle\Report\PDF\PDFReport;

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

    public function edit(int $id)
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
        $this->model->setId($id);
        //retorno true se deu tudo certo
        return $this->model->update();
    }

    public function datatables($request)
    {
        //pegando todos os dados vindos do datatables e filtrando o conteudo
        $datatables = new Datatables($request);
        $order = $datatables->getOrder();
        $orderBy = $datatables->getOrderBy();
        $start = $datatables->getStart();
        $length = $datatables->getLength();
        $draw = $datatables->getDraw();

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
        $search = $datatables->getSearch();

        //criando a consulta ao banco
        $this->model->setSelect("*")
        ->setStart($start)
        ->setLimit($length)
        ->setOrderBy($orderBy)
        ->setOrder($order);

        if (isset($search['dev'])) {
            $this->model->setWhere('dev','LIKE','%' . $search['dev'] . '%');
        }
        if (isset($search['cliente'])) {
            $this->model->setWhere('cliente','LIKE','%' . $search['cliente'] . '%');
        }
        if (isset($search['area'])) {
            $this->model->setWhere('area','LIKE','%' . $search['area'] . '%');
        }
        if (isset($search['dia'])) {
            $this->model->setWhere('dia','=',$search['dia']);
        }
        if (isset($search['hora_ini'])) {
            $this->model->setWhere('hora_ini','>',$search['hora_ini']);
        }
        if (isset($search['hora_fim'])) {
            $this->model->setWhere('hora_fim','<',$search['hora_fim']);
        }
        if (isset($search['de']) && isset($search['ate'])) {
            $this->model->setWhereBetween('dia',$search['de'],$search['ate']);
        }

        $result = $this->model->getResult();

        $json = array();
        $json['draw'] = $draw;
        $json['recordsTotal'] = $result['total']; //pega o total de registros atuais
        $json['recordsFiltered'] = $result['total']; //pega o total de registros atuais

        if (count($result['records']) > 0) {
            $json['data'] = $result['records'];
        } else {
            $json['data'] = array();
        }

        return $json;
    }

    public function delete($field, $value)
    {
        return $this->model->delete($field, $value);
    }

    public function pdf($request)
    {
        $factory = new ReportFactory($request);
        $report = $factory->getReport();

        $pdf = new PDFReport;
        $pdf->output($report);
    }

    public function chart($request)
    {
        $factory = new ReportFactory($request);
        return $factory->getReport();
    }
}