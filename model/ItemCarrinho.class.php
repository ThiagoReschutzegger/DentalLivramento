<?php

class ItemCarrinho {

    //tirei o iditemcarrinho e o idcarrinho pois nao lembro q houvessem alguma serventia
    public $id_produto;
    public $quantidade;
    public $precoitem;

    function __construct($id_produto, $quantidade, $precoitem) {
        $this->id_produto = $id_produto;
        $this->quantidade = $quantidade;
        $this->precoitem = $precoitem;
    }

    function getId_produto() {
        return $this->id_produto;
    }

    function getQuantidade() {
        return $this->quantidade;
    }

    function getPrecoitem() {
        return $this->precoitem;
    }

    function setId_produto($id_produto) {
        $this->id_produto = $id_produto;
    }

    function setQuantidade($quantidade) {
        $this->quantidade = $quantidade;
    }

    function setPrecoitem($precoitem) {
        $this->precoitem = $precoitem;
    }


}
