<?php

class DestaqueAdmin extends Admin {

    protected $model;

    public function __construct() {
        parent::__construct();
        $this->model = new DestaqueModel();
        $this->modelCategoria = new CategoriaModel();
    }

    public function index() {
      $data['destaque'] = $this->model->getDestaque();
      $data['categoria'] = $this->modelCategoria->getCategoria();
      $this->view->load('header');
      $this->view->load('nav');
      $this->view->load('destaque', $data);
      $this->view->load('footer');
    }

    public function addDestaque() {
      $data['msg'] = '';
      if (filter_input(INPUT_POST, 'add')) {
        $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
        $id_categoria = filter_input(INPUT_POST, 'id_categoria', FILTER_SANITIZE_STRING);

            if ($nome && $id_categoria) {
                $destaque = new Destaque(null,$nome, $id_categoria);
                if ($this->model->insertDestaque($destaque)) {
                      $data['msg'] = 'Adicionado com Sucesso!';
                } else {
                    $data['msg'] = 'Erro!';
                    }
            } else {
                 $data['msg'] = 'Preencha todos os Campos!';

            }
        }
      $data['categoria'] = $this->modelCategoria->getCategoria();
      $this->view->load('header');
      $this->view->load('nav');
      $this->view->load('add-destaque', $data);
      $this->view->load('footer');
    }

    public function deleteDestaque($id) {
      if (filter_input(INPUT_POST, 'del')) {
        $this->model->removeDestaque($id);
        $this->index();
        return true;
      }
      $data['destaque'] = $this->model->getDestaqueById($id);
      $this->view->load('header');
      $this->view->load('nav');
      $this->view->load('del-destaque', $data['destaque']);
      $this->view->load('footer');
    }

    public function updateDestaque($ident) {
      $data['msg'] = '';
      if (filter_input(INPUT_POST, 'upd')) {
        $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_STRING);
        $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
        $id_categoria = filter_input(INPUT_POST, 'id_categoria', FILTER_SANITIZE_STRING);

        if ($id && $nome && $id_categoria) {
            $destaque = new Destaque($id,$nome,$id_categoria);
            if ($this->model->updateDestaque($destaque)) {
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
      $data['destaque'] = $this->model->getDestaqueById($ident);
      $data['categoria'] = $this->modelCategoria->getCategoria();
      $this->view->load('header');
      $this->view->load('nav');
      $this->view->load('upd-destaque', $data);
      $this->view->load('footer');
    }
}
