<?php

namespace Controle\Datatables;

class Datatables
{
    protected $order;
    protected $orderBy;
    protected $request;


    public function __construct($request)
    {
        $this->setRequest($request);
        $this->setOrder();
        $this->setOrderBy();
    }

    /**
     * @return mixed
     */
    public function getOrder()
    {
        return $this->order;
    }

    public function setOrder()
    {
        $order = 'DESC';
        $request = $this->getRequest();

        if (isset($request['order']) && count($request['order']) > 0)
        $order = strtoupper($request['order'][0]['dir']);

        if (!in_array($order,array('DESC','ASC')))
        $order = 'DESC';

        $this->order = $order;
    }

    /**
     * @return mixed
     */
    public function getOrderBy()
    {
        return $this->orderBy;
    }

    public function setOrderBy()
    {
        $column = 0;
        $orderBy = 'id';

        $request = $this->getRequest();

        if (isset($request['order']) && count($request['order']) > 0)
        $column = intval($request['order'][0]['column']);


        if (isset($request['columns']) && isset($request['columns'][$column]) && isset($request['columns'][$column]['name']))
        $orderBy = strip_tags($request['columns'][$column]['name']);

        $this->orderBy = $orderBy;
    }

    /**
     * @return mixed
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * @param mixed $request
     */
    public function setRequest($request)
    {
        $this->request = $request;
    }
}