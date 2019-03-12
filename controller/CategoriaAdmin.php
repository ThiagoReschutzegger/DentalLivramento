<?php

class CategoriaAdmin extends Admin {

    protected $model;

    public function __construct() {
        parent::__construct();
        $this->model = new CategoriaModel();
        $this->modelGrupo = new GrupoModel();
    }

    public function index() {
      $data['categoria'] = $this->model->getCategoria();
      $this->view->load('header');
      $this->view->load('nav');
      $this->view->load('categoria', $data['categoria']);
      $this->view->load('footer');
    }

    public function addCategoria() {
      $data['msg'] = '';
      if (filter_input(INPUT_POST, 'add')) {
        $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
        $descricao = filter_input(INPUT_POST, 'descricao', FILTER_SANITIZE_STRING);
        $imagem = filter_input(INPUT_POST, 'imagem', FILTER_SANITIZE_STRING);

            if ($nome && $descricao && $imagem) {
                $categoria = new Categoria(null,$nome,$descricao,$imagem);
                if ($this->model->insertCategoria($categoria)) {
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
      $this->view->load('add-categoria', $data);
      $this->view->load('footer');
    }

    public function viewCategoria($id) { //baguncinha
      $data['categoria'] = $this->model->getCategoriaById($id);
      $data['grupo'] = $this->modelGrupo->getGrupo();
      $this->view->load('header');
      $this->view->load('nav');
      $this->view->load('view-categoria', $data);
      $this->view->load('footer');
    }

    public function deleteCategoria($id) {
      if (filter_input(INPUT_POST, 'del')) {
        $this->model->removeCategoria($id);
        $this->index();
        return true;
      }
      $data['categoria'] = $this->model->getCategoriaById($id);
      $this->view->load('header');
      $this->view->load('nav');
      $this->view->load('del-categoria', $data['categoria']);
      $this->view->load('footer');
    }

    public function updateCategoria($ident) {
      $data['msg'] = '';
      if (filter_input(INPUT_POST, 'upd')) {
        $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_STRING);
        $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
        $descricao = filter_input(INPUT_POST, 'descricao', FILTER_SANITIZE_STRING);
        $imagem = filter_input(INPUT_POST, 'imagem', FILTER_SANITIZE_STRING);
        if ($id && $nome && $descricao && $imagem) {
            $categoria = new Categoria($id,$nome,$descricao,$imagem);
            if ($this->model->updateCategoria($categoria)) {
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
      $data['categoria'] = $this->model->getCategoriaById($ident);
      $this->view->load('header');
      $this->view->load('nav');
      $this->view->load('upd-categoria', $data);
      $this->view->load('footer');
    }

}
