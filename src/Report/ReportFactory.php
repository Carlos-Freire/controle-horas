<?php

namespace Controle\Report;

use Controle\Report\Report;

class ReportFactory
{
    protected $request;

    public function __construct($request)
    {
        $this->request = $request;
    }

    public function getReport()
    {
        //pego os 3 tipos de relatorios diferentes e retorno em um array
        
        //relatorio horas dev
        $dev = new Report($this->request);
        $dev_report = $dev->getReport('dev');

        //relatorio horas area
        $area = new Report($this->request);
        $area_report = $area->getReport('area');

        //relatorio horas cliente
        $cliente = new Report($this->request);
        $cliente_report = $area->getReport('cliente');

        return array(
            'dev' => $dev_report,
            'area' => $area_report,
            'cliente' => $cliente_report
        );

    }
}