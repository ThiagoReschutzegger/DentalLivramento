<?php

class HomeAdmin extends Admin {

    protected $model;

    public function __construct() {
        parent::__construct();
        $this->model = new HomeAdminModel();
    }

    public function index() {
      $data['msg'] = '';
      $data['estilo'] = $this->model->getEstilo();
      if (filter_input(INPUT_POST, 'cor')) {
            $id = filter_input(INPUT_POST, 'a', FILTER_SANITIZE_STRING);
            if ($id) {
                if ($this->model->updateEstilo($id)) {
                    $this->index();
                    return true;
                } else {
                    $data['msg'] = 'Erro no cadastro';
                }
            } else {
                $data['msg'] = 'Informe todos os campos';
            }
        }
      $this->view->load('header');
      $this->view->load('nav');
      $this->view->load('homecustom',$data['estilo']);
      $this->view->load('footer');
    }

}
