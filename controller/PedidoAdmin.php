<?php

class PedidoAdmin extends Admin {

    protected $model;
    protected $modelItemCarrinho;
    protected $modelProduto;
    protected $modelSubgrupo;

    public function __construct() {
        parent::__construct();
        $this->model = new PedidoModel();
        $this->modelItemCarrinho = new ItemcarrinhoModel();
        $this->modelProduto = new ProdutoModel();
        $this->modelSubgrupo = new SubgrupoModel();
    }

    public function index() {


      $data['pedidop'] = $this->model->getPedidoPendente2();//proprio nome ja diz
      if(count($data['pedidop']) > 1):
        foreach ($data['pedidop'] as $pedido):
            $data['itemcart-pendente'.$pedido->getId_pedido()] = $this->modelItemCarrinho->getItensById_carrinho($pedido->getId_carrinho());
            $data['prods-pendente'.$pedido->getId_pedido()] = [];
            if(count($data['itemcart-pendente'.$pedido->getId_pedido()]) > 1):
                foreach ($data['itemcart-pendente'.$pedido->getId_pedido()] as $itemcart):
                    $data['prods-pendente'.$pedido->getId_pedido()][] = $this->modelProduto->getProdutoByBarcode($itemcart->getBarcode());
                    $data['qtd-pendente'.$itemcart->getBarcode().$pedido->getId_pedido()] = $itemcart->getQuantidade();
                endforeach;
            else:
                $data['prods-pendente'.$pedido->getId_pedido()][] = $this->modelProduto->getProdutoByBarcode($data['itemcart-pendente'.$pedido->getId_pedido()][0]->getBarcode());
                $data['qtd-pendente'.$data['itemcart-pendente'.$pedido->getId_pedido()][0]->getBarcode().$pedido->getId_pedido()] = $data['itemcart-pendente'.$pedido->getId_pedido()][0]->getQuantidade();
            endif;
            if(count($data['prods-pendente'.$pedido->getId_pedido()]) > 1):
                foreach ($data['prods-pendente'.$pedido->getId_pedido()] as $produto):
                    $subgrupo = $this->modelSubgrupo->getSubgrupoById($produto->getId_subgrupo());
                    $data['sub-nome-pendente'.$produto->getId_produto().$pedido->getId_pedido()] = $subgrupo->getNome();
                endforeach;
            else:
                $subgrupo = $this->modelSubgrupo->getSubgrupoById($data['prods-pendente'.$pedido->getId_pedido()][0]->getId_subgrupo());
                $data['sub-nome-pendente'.$data['prods-pendente'.$pedido->getId_pedido()][0]->getId_produto().$pedido->getId_pedido()] = $subgrupo->getNome();
            endif;
        endforeach;
      elseif(!empty($data['pedidop'])):
            $pedido = $data['pedidop'][0];
            $data['itemcart-pendente'.$pedido->getId_pedido()] = $this->modelItemCarrinho->getItensById_carrinho($pedido->getId_carrinho());
            $data['prods-pendente'.$pedido->getId_pedido()] = [];
            if(count($data['itemcart-pendente'.$pedido->getId_pedido()]) > 1):
                foreach ($data['itemcart-pendente'.$pedido->getId_pedido()] as $itemcart):
                    $data['prods-pendente'.$pedido->getId_pedido()][] = $this->modelProduto->getProdutoByBarcode($itemcart->getBarcode());
                    $data['qtd-pendente'.$itemcart->getBarcode().$pedido->getId_pedido()] = $itemcart->getQuantidade();
                endforeach;
            else:
                $data['prods-pendente'.$pedido->getId_pedido()][] = $this->modelProduto->getProdutoByBarcode($data['itemcart-pendente'.$pedido->getId_pedido()][0]->getBarcode());
                $data['qtd-pendente'.$data['itemcart-pendente'.$pedido->getId_pedido()][0]->getBarcode().$pedido->getId_pedido()] = $data['itemcart-pendente'.$pedido->getId_pedido()][0]->getQuantidade();
            endif;
            if(count($data['prods-pendente'.$pedido->getId_pedido()]) > 1):
                foreach ($data['prods-pendente'.$pedido->getId_pedido()] as $produto):
                    $subgrupo = $this->modelSubgrupo->getSubgrupoById($produto->getId_subgrupo());
                    $data['sub-nome-pendente'.$produto->getId_produto().$pedido->getId_pedido()] = $subgrupo->getNome();
                endforeach;
            else:
                $subgrupo = $this->modelSubgrupo->getSubgrupoById($data['prods-pendente'.$pedido->getId_pedido()][0]->getId_subgrupo());
                $data['sub-nome-pendente'.$data['prods-pendente'.$pedido->getId_pedido()][0]->getId_produto().$pedido->getId_pedido()] = $subgrupo->getNome();
            endif;
      endif;
      
//      echo "até aqui tudo tranq";
//      die;
      $data['pedidoc'] = $this->model->getPedidoConcluido2(); //pega só 10
      if(count($data['pedidoc']) > 1):
        foreach ($data['pedidoc'] as $pedido):
            $data['itemcart-concluso'.$pedido->getId_pedido()] = $this->modelItemCarrinho->getItensById_carrinho($pedido->getId_carrinho());
            $data['prods-concluso'.$pedido->getId_pedido()] = [];
            if(count($data['itemcart-concluso'.$pedido->getId_pedido()]) > 1):
                foreach ($data['itemcart-concluso'.$pedido->getId_pedido()] as $itemcart):
                    $data['prods-concluso'.$pedido->getId_pedido()][] = $this->modelProduto->getProdutoByBarcode($itemcart->getBarcode());
                    $data['qtd-concluso'.$itemcart->getBarcode().$pedido->getId_pedido()] = $itemcart->getQuantidade();
                endforeach;
            else:
                $data['prods-concluso'.$pedido->getId_pedido()][] = $this->modelProduto->getProdutoByBarcode($data['itemcart-concluso'.$pedido->getId_pedido()][0]->getBarcode());
                $data['qtd-concluso'.$data['itemcart-concluso'.$pedido->getId_pedido()][0]->getBarcode().$pedido->getId_pedido()] = $data['itemcart-concluso'.$pedido->getId_pedido()][0]->getQuantidade();
            endif;
            if(count($data['prods-concluso'.$pedido->getId_pedido()]) > 1):
                foreach ($data['prods-concluso'.$pedido->getId_pedido()] as $produto):
                    $subgrupo = $this->modelSubgrupo->getSubgrupoById($produto->getId_subgrupo());
                    $data['sub-nome-concluso'.$produto->getId_produto().$pedido->getId_pedido()] = $subgrupo->getNome();
                endforeach;
            else:
                $subgrupo = $this->modelSubgrupo->getSubgrupoById($data['prods-concluso'.$pedido->getId_pedido()][0]->getId_subgrupo());
                $data['sub-nome-concluso'.$data['prods-concluso'.$pedido->getId_pedido()][0]->getId_produto().$pedido->getId_pedido()] = $subgrupo->getNome();
            endif;
        endforeach;
      elseif(!empty($data['pedidoc'])):
            $pedido = $data['pedidoc'][0];
            $data['itemcart-concluso'.$pedido->getId_pedido()] = $this->modelItemCarrinho->getItensById_carrinho($pedido->getId_carrinho());
            $data['prods-concluso'.$pedido->getId_pedido()] = [];
            if(count($data['itemcart-concluso'.$pedido->getId_pedido()]) > 1):
                foreach ($data['itemcart-concluso'.$pedido->getId_pedido()] as $itemcart):
                    $data['prods-concluso'.$pedido->getId_pedido()][] = $this->modelProduto->getProdutoByBarcode($itemcart->getBarcode());
                    $data['qtd-concluso'.$itemcart->getBarcode().$pedido->getId_pedido()] = $itemcart->getQuantidade();
                endforeach;
            else:
                $data['prods-concluso'.$pedido->getId_pedido()][] = $this->modelProduto->getProdutoByBarcode($data['itemcart-concluso'.$pedido->getId_pedido()][0]->getBarcode());
                $data['qtd-concluso'.$data['itemcart-concluso'.$pedido->getId_pedido()][0]->getBarcode().$pedido->getId_pedido()] = $data['itemcart-concluso'.$pedido->getId_pedido()][0]->getQuantidade();
            endif;
            if(count($data['prods-concluso'.$pedido->getId_pedido()]) > 1):
                foreach ($data['prods-concluso'.$pedido->getId_pedido()] as $produto):
                    $subgrupo = $this->modelSubgrupo->getSubgrupoById($produto->getId_subgrupo());
                    $data['sub-nome-concluso'.$produto->getId_produto().$pedido->getId_pedido()] = $subgrupo->getNome();
                endforeach;
            else:
                $subgrupo = $this->modelSubgrupo->getSubgrupoById($data['prods-concluso'.$pedido->getId_pedido()][0]->getId_subgrupo());
                $data['sub-nome-concluso'.$data['prods-concluso'.$pedido->getId_pedido()][0]->getId_produto().$pedido->getId_pedido()] = $subgrupo->getNome();
            endif;
      endif;
      

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
        $conteudo .= $produto['produto']->getBarcode()."|".$produto['quantidade']/*.PHP_EOL*/."\r\n";
      }

      file_put_contents($arquivo,$conteudo);

      header('Content-Type: application/octet-stream');
      header('Content-Disposition: attachment; filename='.basename($arquivo));
      header('Expires: 0');
      header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
      header('Pragma: public');
      header('Content-Length: ' . filesize($arquivo));
      readfile($arquivo);
      unlink($arquivo);
    }

}
