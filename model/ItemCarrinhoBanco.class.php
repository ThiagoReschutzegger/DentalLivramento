<?php

class ItemCarrinhoBanco {

    //tirei o iditemcarrinho e o idcarrinho pois nao lembro q houvessem alguma serventia
    public $id_itemcarrinho;
    public $id_produto;
    public $quantidade;
    public $id_carrinho;
    

    function __construct($id_itemcarrinho,$id_produto, $quantidade, $id_carrinho) {

        $this->id_itemcarrinho = $id_itemcarrinho;
        $this->id_produto = $id_produto;
        $this->quantidade = $quantidade;
        $this->id_carrinho = $id_carrinho;
    }

    function getId_produto() {
        return $this->id_produto;
    }

    function getQuantidade() {
        return $this->quantidade;
    }

    function getId_itemcarrinho() {
      return $this->id_itemcarrinho;
    }

    function getId_carrinho() {
      return $this->id_carrinho;
    }



}
