<?php

class MarcaAdmin extends Admin {

    protected $model;

    public function __construct() {
        parent::__construct();
        $this->model = new MarcaModel();
    }

    public function index() {
      $data['marca'] = $this->model->getMarca();
      $this->view->load('header');
      $this->view->load('nav');
      $this->view->load('marca', $data['marca']);
      $this->view->load('footer');
    }

    public function addMarca() {
      $data['msg'] = '';
      if (filter_input(INPUT_POST, 'add')) {
            $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
            $imagem = filter_input(INPUT_POST, 'imagem', FILTER_SANITIZE_STRING);

            if ($nome && $imagem) {
                $marca = new Marca(null,$nome,$imagem);
                if ($this->model->insertMarca($marca)) {
                     $data['msg'] = 'Adicionado com Sucesso!';
                } else {
                    $data['msg'] = 'Erro!';
                    }
            } else {
                 $data['msg'] = 'Preencha todos os Campos!';

            }
        }
      $this->view->load('header');
      $this->view->load('nav');
      $this->view->load('add-marca', $data);
      $this->view->load('footer');
    }

    public function viewMarca($id) {
      $data['marca'] = $this->model->getMarcaById($id);
      $this->view->load('header');
      $this->view->load('nav');
      $this->view->load('view-marca', $data['marca']);
      $this->view->load('footer');
    }

    public function deleteMarca($id) {
      if (filter_input(INPUT_POST, 'del')) {
        $this->model->removeMarca($id);
        $this->index();
        return true;
      }
      $data['marca'] = $this->model->getMarcaById($id);
      $this->view->load('header');
      $this->view->load('nav');
      $this->view->load('del-marca', $data['marca']);
      $this->view->load('footer');
    }

    public function updateMarca($ident) {
      $data['msg'] = '';
      if (filter_input(INPUT_POST, 'upd')) {
        $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_STRING);
        $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
        $imagem = filter_input(INPUT_POST, 'imagem', FILTER_SANITIZE_STRING);
        if ($id && $nome && $imagem) {
            $marca = new Marca($id,$nome,$imagem);
            if ($this->model->updateMarca($marca)) {
                $this->index();
                return true;
            } else {
              $this->index();
              return true;
                }
        } else {
             $data['msg'] = 'Preencha todos os Campos!';
        }
      }
      $data['marca'] = $this->model->getMarcaById($ident);
      $this->view->load('header');
      $this->view->load('nav');
      $this->view->load('upd-marca', $data);
      $this->view->load('footer');
    }

}
