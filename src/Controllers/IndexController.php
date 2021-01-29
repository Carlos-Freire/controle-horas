<?php

namespace Controle\Controllers;

use Controle\Repositories\ControleRepository;
use Controle\Controllers\Controller;
use Controle\Views\View;

class IndexController extends Controller
{
    protected $repository;

    public function __construct()
    {
        $this->repository = new ControleRepository;
    }

    public function index()
    {
        $view = new View("index");
        $view->show(array(
            "dia" => date("Y-m-d"),
            "hora_ini" => date("H:i:s"),
            "hora_fim" => date("H:i:s")
        ));

    }

    public function show()
    {

    }

    public function add()
    {
        $this->showJsonHeader();

        if ($_SERVER["REQUEST_METHOD"] == "POST" && count($_POST) > 0) {
            $id = $this->repository->add();
            if (is_numeric($id) && $id > 0) {
                echo json_encode(array(
                    'result' => 'success',
                    'message' => 'O cadastro foi realizado com sucesso!',
                    'id' => $id
                ));
            } else {
                echo json_encode(array(
                    'result' => 'error',
                    'message' => 'Ocorreu um erro durante o cadastro do item!'
                ));
            }
        } else {
            echo json_encode(array(
                'result' => 'error',
                'message' => 'Método não aceito!'
            ));
        }
    }

    public function edit()
    {
        echo 'edit';
    }

    public function delete()
    {
        $this->showJsonHeader();

        if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
            $delete = $this->repository->delete('id', intval($_GET['id']));
            
            if ($delete) {
                echo json_encode(array(
                    'result' => 'success',
                    'message' => 'O cadastro foi deletado com sucesso!'
                ));
            } else {
                echo json_encode(array(
                    'result' => 'error',
                    'message' => 'Ocorreu um erro durante o processo de deletar o item!'
                ));
            }
        } else {
            echo json_encode(array(
                'result' => 'error',
                'message' => 'Método não aceito!'
            ));
        }

    }

    public function datatables()
    {
        $this->showJsonHeader();
        $json = $this->repository->datatables($_REQUEST);
        echo json_encode($json);
    }
}