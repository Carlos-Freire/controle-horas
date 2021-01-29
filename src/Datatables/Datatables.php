<?php

namespace Controle\Datatables;

class Datatables
{
    protected $order;
    protected $orderBy;
    protected $request;
    protected $start;
    protected $length;
    protected $draw;
    protected $search;


    public function __construct($request)
    {
        $this->setRequest($request);
        $this->setOrder();
        $this->setOrderBy();
        $this->setLength();
        $this->setStart();
        $this->setDraw();
        $this->search = array();
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

        $order = filter_var($order, FILTER_SANITIZE_STRING);

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


        if (isset($request['columns']) && isset($request['columns'][$column]) && isset($request['columns'][$column]['name'])) {
            $orderBy = strip_tags($request['columns'][$column]['name']);
            $orderBy = filter_var($orderBy, FILTER_SANITIZE_STRING);
        }

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

    /**
     * @return mixed
     */
    public function getStart()
    {
        return $this->start;
    }

    public function setStart()
    {
        $start = 0;
        $request = $this->getRequest();

        if (isset($request['start']))
        $start = intval($request['start']);

        $this->start = $start;
    }

    /**
     * @return mixed
     */
    public function getLength()
    {
        return $this->length;
    }

    public function setLength()
    {
        $length = 10;
        $request = $this->getRequest();

        if (isset($request['length']))
        $length = intval($request['length']);

        $this->length = $length;
    }

    /**
     * @return mixed
     */
    public function getDraw()
    {
        return $this->draw;
    }

    public function setDraw()
    {
        $draw = 0;
        $request = $this->getRequest();

        if (isset($request['draw']))
        $draw = intval($request['draw']);

        $this->draw = $draw;
    }

    /**
     * @return array
     */
    public function getSearch(): array
    {
        return $this->search;
    }

    /**
     * @param array $search
     */
    public function setSearch(array $search)
    {
        $filtered = array();
        $request = $this->getRequest();

        foreach($search as $value) {

            if (isset($request[$value]) && trim($request[$value]) !== "") {

                $key = trim(filter_var($value, FILTER_SANITIZE_STRING));
                $value = trim(filter_var($request[$value], FILTER_SANITIZE_STRING));

                $filtered[$key] = $value;
            }
        }

        $this->search = $filtered;
    }
}