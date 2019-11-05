<?php

class ItemCarrinhoBanco {

    //tirei o iditemcarrinho e o idcarrinho pois nao lembro q houvessem alguma serventia
    public $id_itemcarrinho;
    public $barcode;
    public $quantidade;
    public $id_carrinho;
    

    function __construct($id_itemcarrinho,$barcode, $quantidade, $id_carrinho) {

        $this->id_itemcarrinho = $id_itemcarrinho;
        $this->barcode = $barcode;
        $this->quantidade = $quantidade;
        $this->id_carrinho = $id_carrinho;
    }

    function getBarcode() {
        return $this->barcode;
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
