<?php

namespace Controle\Report;

use Controle\Report\Search;
use Controle\Report\CalcDays;

class DevReport extends Search
{

    public function __construct($request)
    {
        parent::__construct($request);
    }

    public function getReport(): array
    {
        $report = array();

        //todos os campos do formulário filtrados
        $search = $this->getSearch();

        //criando a consulta ao banco
        $this->model->setSelect("
            SEC_TO_TIME( SUM( TIME_TO_SEC( TIMEDIFF(hora_fim, hora_ini) ) ) ) AS horas,
            dev 
        ");
        $this->model->setGroupBy('dev');

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

        if (count($result['records']) > 0) {
            foreach($result['records'] as $r) {
                $database = $r["horas"];

                $calc = new CalcDays($database);
                $helper = $calc->getDays();

                $phrase = $helper["days"] . ' Dias - ' . $helper["hours"] . ' Horas, ' . $helper["minutes"] . ' Minutos, ' . $helper["seconds"] . ' Segundos';

                $report[] = array(
                    'days' => $helper["days"],
                    'hours' => $helper["hours"],
                    'minutes' => $helper["minutes"],
                    'seconds' => $helper["seconds"],
                    'phrase' => $phrase,
                    'dev' => $r["dev"],
                    'database' => $database,
                );
            }
        }

        return $report;
    }
}