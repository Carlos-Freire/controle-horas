<?php

namespace Controle\Models;

use Controle\Models\Model;

class Controle extends Model
{
    protected $table = 'Controle';
    protected $id;
    protected $dev;
    protected $cliente;
    protected $area;
    protected $dia;
    protected $hora_ini;
    protected $hora_fim;

    public function __construct()
    {
        parent::__construct($this->table);
    }

    public function insert()
    {
        return parent::executeInsert(get_object_vars($this));
    }

    public function update()
    {
        return parent::executeUpdate(get_object_vars($this));
    }


    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = intval($id);
    }

    /**
     * @return mixed
     */
    public function getDev()
    {
        return $this->dev;
    }

    /**
     * @param mixed $dev
     */
    public function setDev($dev)
    {
        $this->dev = $dev;
    }

    /**
     * @return mixed
     */
    public function getCliente()
    {
        return $this->cliente;
    }

    /**
     * @param mixed $cliente
     */
    public function setCliente($cliente)
    {
        $this->cliente = $cliente;
    }

    /**
     * @return mixed
     */
    public function getArea()
    {
        return $this->area;
    }

    /**
     * @param mixed $area
     */
    public function setArea($area)
    {
        $this->area = $area;
    }

    /**
     * @return mixed
     */
    public function getDia()
    {
        $data = \DateTime::createFromFormat("Y-m-d", $this->dia);
        $this->dia = $data->format("d/m/Y");
        return $this->dia;
    }

    /**
     * @param mixed $dia
     */
    public function setDia($dia)
    {
        $data = \DateTime::createFromFormat("d/m/Y", $dia);
        $this->dia = $data->format("Y-m-d");
    }

    /**
     * @return mixed
     */
    public function getHoraIni()
    {
        return $this->hora_ini;
    }

    /**
     * @param mixed $hora_ini
     */
    public function setHoraIni($hora_ini)
    {
        $this->hora_ini = $hora_ini;
    }

    /**
     * @return mixed
     */
    public function getHoraFim()
    {
        return $this->hora_fim;
    }

    /**
     * @param mixed $hora_fim
     */
    public function setHoraFim($hora_fim)
    {
        $this->hora_fim = $hora_fim;
    }
}