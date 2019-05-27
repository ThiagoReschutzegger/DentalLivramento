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

    public function txtPedidoConcluido($id=1){

      error_reporting(E_ERROR | E_PARSE);
      //ignorar
      $time1=date("Y-m-d H:i:s", time());
      $time1_timezone=date_default_timezone_get();

      date_default_timezone_set('UTC');
      $time2=date("Y-m-d H:i:s", time());
      $time2_timezone=date_default_timezone_get();

      if ($time1!=$time2)
      {
        openlog('Arie',LOG_PERROR,LOG_LOCAL1);

        syslog(LOG_ERR, "Time before setting timezone: [".$time1."]");
        syslog(LOG_ERR, "Timezone is: [".$time1_timezone."]");
        syslog(LOG_ERR, "Time after  setting timezone: [".$time2."]");
        syslog(LOG_ERR, "Timezone is: [".$time2_timezone."]");
      }
      //ignorar

      $data = date("d-m-Y");
      $arquivo = $data."Pedido".$id.".txt";

      $pedido = $this->model->getPedidoPorId2($id);

      //echo "<pre>";print_r($pedido[0][1]);echo"kk";die;

      $conteudo = "";

      foreach ($pedido[0][1] as $produto) {
        $conteudo .= $produto['produto']->getBarcode()."|".$produto['quantidade'].PHP_EOL;
      }

      file_put_contents($arquivo,$conteudo);

      header('Content-Type: application/octet-stream');
      header('Content-Disposition: attachment; filename='.basename($arquivo));
      header('Expires: 0');
      header('Cache-Control: must-revalidate');
      header('Pragma: public');
      header('Content-Length: ' . filesize($arquivo));
      readfile($arquivo);

    }

}
