<?php

class HomeAdmin extends Admin {

    protected $model;

    public function __construct() {
        parent::__construct();
        $this->model = new HomeAdminModel();
        $this->father = new Admin();
    }

    public function index() {
      $data['estilo'] = $this->model->getEstilo();
      $this->view->load('header');
      $this->view->load('nav');
      $this->view->load('homecustom',$data['estilo']);
      $this->view->load('footer');
    }

    public function confirma_upd($ident){ //  $ident = estilo do escolhido
      if (filter_input(INPUT_POST, 'confirma')) {
        $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_STRING);
        $hexadecimal = filter_input(INPUT_POST, 'hexadecimal', FILTER_SANITIZE_STRING);
        $local = filter_input(INPUT_POST, 'local', FILTER_SANITIZE_STRING);
        $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
        $status = filter_input(INPUT_POST, 'status', FILTER_SANITIZE_STRING);
        if($id){
                $estilo = new Estilo($id,$hexadecimal,$local,$nome,$status);
                if ($this->model->updateEstilo($estilo)) {//tentar fazer um de cada vez
                    $this->father->index();
                } else {
                    $data['msg'] = 'Erro no cadastro';
                }
        }
      }
      $data['confirma'] = $this->model->getEstiloById($ident);
      var_dump($data['confirma']);
      $this->view->load('header');
      $this->view->load('nav');
      $this->view->load('confirma-upd',$data['confirma']);
      $this->view->load('footer');
    }

}
