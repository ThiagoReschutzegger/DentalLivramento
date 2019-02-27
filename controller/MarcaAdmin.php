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
                      $this->index();
                     return true;
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

}
