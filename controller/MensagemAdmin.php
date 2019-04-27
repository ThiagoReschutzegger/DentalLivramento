<?php

class MensagemAdmin extends Admin {

    protected $model;

    public function __construct() {
        parent::__construct();
        $this->model = new MensagemModel();
    }

    public function index() {
      $data['mensagem'] = $this->model->getMensagem();

      $this->view->load('header');
      $this->view->load('nav');
      $this->view->load('mensagem', $data);
      $this->view->load('footer');
    }

    public function deleteMensagem($id) {
        $this->model->removeMensagem($id);
        $this->index();
        return true;
    }
}
