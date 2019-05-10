<?php

class PedidoAdmin extends Admin {

    protected $model;

    public function __construct() {
        parent::__construct();
        $this->model = new PedidoModel();
    }

    public function index() {

      //$teste = $this->model->getPedido();
      //echo "<pre>";print_r($teste);echo"kk";die;

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
        $this->index();die;
    }

    public function deletePedido($id) {
      $pedido = $this->model->getPedidoById($id);
      $id_cart = $pedido->getId_carrinho();

      $this->model->removePedido($id);
      $this->model->removePedido_2($id_cart);
      $this->model->removePedido_3($id_cart);

      $this->index();
      return true;
    }


}
