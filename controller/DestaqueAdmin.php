<?php

class DestaqueAdmin extends Admin {

    protected $model;

    public function __construct() {
        parent::__construct();
        $this->model = new DestaqueModel();
        $this->modelGrupo = new GrupoModel();
    }

    public function index() {
      $data['destaque'] = $this->model->getDestaque();
      $data['grupo'] = $this->modelGrupo->getGrupo();
      $this->view->load('header');
      $this->view->load('nav');
      $this->view->load('destaque', $data);
      $this->view->load('footer');
    }

    public function addDestaque() {
      $data['msg'] = '';
      if (filter_input(INPUT_POST, 'add')) {
        $imagem = filter_input(INPUT_POST, 'imagem', FILTER_SANITIZE_STRING);
        $id_grupo = filter_input(INPUT_POST, 'id_grupo', FILTER_SANITIZE_STRING);

            if ($imagem && $id_grupo) {
                $destaque = new Destaque(null,null, $imagem, $id_grupo);
                if ($this->model->insertDestaque($destaque)) {
                      $data['msg'] = 'Adicionado com Sucesso!';
                } else {
                    $data['msg'] = 'Erro!';
                    }
            } else {
                 $data['msg'] = 'Preencha todos os Campos!';

            }
        }
      $data['grupo'] = $this->modelGrupo->getGrupo();
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
        $imagem = filter_input(INPUT_POST, 'imagem', FILTER_SANITIZE_STRING);
        $id_grupo = filter_input(INPUT_POST, 'id_grupo', FILTER_SANITIZE_STRING);

        if ($id && $imagem && $id_grupo) {
            $destaque = new Destaque($id,null,$imagem,$id_grupo);
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
      $data['grupo'] = $this->modelGrupo->getGrupo();
      $this->view->load('header');
      $this->view->load('nav');
      $this->view->load('upd-destaque', $data);
      $this->view->load('footer');
    }
}
