<?php

namespace Controle\Report;

use Controle\Models\Controle;
use Controle\Datatables\Datatables;
use Controle\Report\CalcDays;

class Report
{
    protected $request;
    protected $model;

    public function __construct($request)
    {
        $this->request = $request;
        $this->model = new Controle;
    }

    public function getReport($type = 'dev'): array
    {
        $report = array();

        //pegando todos os dados vindos do datatables e filtrando o conteudo
        $datatables = new Datatables($this->request);
        //pegando os campos criados por mim que serão usados na busca
        $datatables->setSearch(array(
            'dev2',
            'cliente2',
            'area2',
            'dia2',
            'hora_ini2',
            'hora_fim2',
            'de',
            'ate'
        ));
        //todos os campos do formulário filtrados
        $search = $datatables->getSearch();


        //criando a consulta ao banco
        $this->model->setSelect("
            SEC_TO_TIME( SUM( TIME_TO_SEC( TIMEDIFF(hora_fim, hora_ini) ) ) ) AS horas,
            {$type} AS item
        ");
        $this->model->setGroupBy($type);

        if (isset($search['dev2'])) {
            $this->model->setWhere('dev','LIKE','%' . $search['dev2'] . '%');
        }
        if (isset($search['cliente2'])) {
            $this->model->setWhere('cliente','LIKE','%' . $search['cliente2'] . '%');
        }
        if (isset($search['area2'])) {
            $this->model->setWhere('area','LIKE','%' . $search['area2'] . '%');
        }
        if (isset($search['dia2'])) {
            $this->model->setWhere('dia','=',$search['dia2']);
        }
        if (isset($search['hora_ini2'])) {
            $this->model->setWhere('hora_ini','>',$search['hora_ini2']);
        }
        if (isset($search['hora_fim2'])) {
            $this->model->setWhere('hora_fim','<',$search['hora_fim2']);
        }
        if (isset($search['de']) && isset($search['ate'])) {
            $this->model->setWhereBetween('dia',$search['de'],$search['ate']);
        }

        $result = $this->model->getResult();

        if (count($result['records']) > 0) {
            foreach($result['records'] as $r) {
                $database = $r["horas"];

                $calc = new CalcDays($database);
                $helper = $calc->getDays();

                $phrase = strip_tags($helper["days"] . ' Dias - ' . $helper["hours"] . ' Horas, ' . $helper["minutes"] . ' Minutos, ' . $helper["seconds"] . ' Segundos');

                $report[] = array(
                    'days' => $helper["days"],
                    'hours' => $helper["hours"],
                    'minutes' => $helper["minutes"],
                    'seconds' => $helper["seconds"],
                    'phrase' => $phrase,
                    'item' => $r["item"],
                    'database' => $database,
                );
            }
        }

        return $report;
    }
}