<?php

namespace Controle\Filters;

use Controle\Traits\DateTrait;
use Controle\Traits\HourTrait;

class ControleFilter
{
    protected $id;
    protected $dev;
    protected $cliente;
    protected $area;
    protected $dia;
    protected $hora_ini;
    protected $hora_fim;



    public function __construct()
    {
        $this->setId();
        $this->setDev();
        $this->setCliente();
        $this->setArea();
        $this->setDia();
        $this->setHoraIni();
        $this->setHoraFim();
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    protected function setId()
    {
        if (isset($_POST['id']))
        $this->id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
        else
        $this->id = NULL;
    }

    /**
     * @return mixed
     */
    public function getDev()
    {
        return $this->dev;
    }

    protected function setDev()
    {
        $this->dev = filter_input(INPUT_POST, 'dev', FILTER_DEFAULT);
    }

    /**
     * @return mixed
     */
    public function getCliente()
    {
        return $this->cliente;
    }

    protected function setCliente()
    {
        $this->cliente = filter_input(INPUT_POST, 'dev', FILTER_DEFAULT);
    }

    /**
     * @return mixed
     */
    public function getArea()
    {
        return $this->area;
    }

    protected function setArea()
    {
        $this->area = filter_input(INPUT_POST, 'area', FILTER_DEFAULT);
    }

    /**
     * @return mixed
     */
    public function getDia()
    {
        return $this->dia;
    }

    protected function setDia()
    {
        $dia = filter_input(INPUT_POST, 'dia', FILTER_DEFAULT);
        $this->dia = DateTrait::correctDate($dia);
    }

    /**
     * @return mixed
     */
    public function getHoraIni()
    {
        return $this->hora_ini;
    }

    protected function setHoraIni()
    {
        $hora = filter_input(INPUT_POST, 'hora_ini', FILTER_DEFAULT);
        $this->hora_ini = HourTrait::correctHour($hora);
    }

    /**
     * @return mixed
     */
    public function getHoraFim()
    {
        return $this->hora_fim;
    }

    protected function setHoraFim()
    {
        $hora = filter_input(INPUT_POST, 'hora_fim', FILTER_DEFAULT);
        $this->hora_fim = HourTrait::correctHour($hora);
    }
}
