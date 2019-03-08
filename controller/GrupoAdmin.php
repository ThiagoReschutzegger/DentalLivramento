<?php

class GrupoAdmin extends Admin {

    protected $model;

    public function __construct() {
        parent::__construct();
        $this->model = new GrupoModel();
        $this->modelCategoria = new CategoriaModel();
    }

    public function index() {
      $data['grupo'] = $this->model->getGrupo();
      $data['categoria'] = $this->modelCategoria->getCategoria();
      $this->view->load('header');
      $this->view->load('nav');
      $this->view->load('grupo', $data);
      $this->view->load('footer');
    }

    public function addGrupo() {
      $data['msg'] = '';
      if (filter_input(INPUT_POST, 'add')) {
        $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
        $id_categoria = filter_input(INPUT_POST, 'id_categoria', FILTER_SANITIZE_STRING);

            if ($nome && $id_categoria) {
                $grupo = new Grupo(null,$nome, $id_categoria);
                if ($this->model->insertGrupo($grupo)) {
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
      $this->view->load('add-grupo', $data);
      $this->view->load('footer');
    }

    public function deleteGrupo($id) {
      if (filter_input(INPUT_POST, 'del')) {
        $this->model->removeGrupo($id);
        $this->index();
        return true;
      }
      $data['grupo'] = $this->model->getGrupoById($id);
      $this->view->load('header');
      $this->view->load('nav');
      $this->view->load('del-grupo', $data['grupo']);
      $this->view->load('footer');
    }

    public function updateGrupo($ident) {
      $data['msg'] = '';
      if (filter_input(INPUT_POST, 'upd')) {
        $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_STRING);
        $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
        $id_categoria = filter_input(INPUT_POST, 'id_categoria', FILTER_SANITIZE_STRING);

        if ($id && $nome && $id_categoria) {
            $grupo = new Grupo($id,$nome,$id_categoria);
            if ($this->model->updateGrupo($grupo)) {
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
      $data['grupo'] = $this->model->getGrupoById($ident);
      $data['categoria'] = $this->modelCategoria->getCategoria();
      $this->view->load('header');
      $this->view->load('nav');
      $this->view->load('upd-grupo', $data);
      $this->view->load('footer');
    }
}
