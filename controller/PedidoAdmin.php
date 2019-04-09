<?php

class PedidoAdmin extends Admin {

    protected $model;

    public function __construct() {
        parent::__construct();
        $this->model = new PedidoModel();
    }

    public function index() {
      $data['pedidop'] = $this->model->getPedidoPendente();//proprio nome ja diz
      $data['pedidoc'] = $this->model->getPedidoConcluido(); //pega só 10
      //tem q fazer os join fudido
      $this->view->load('header');
      $this->view->load('nav');
      $this->view->load('pedido', $data);
      $this->view->load('footer');
    }

    public function pendenteParaConcluido($id){
      $bool = $this->model->changeStatus($id);
        header('location:' . $this->config->base_url . 'Admin/PedidoAdmin');
    }


}
