<?php

class Carrinho {

    public $id_carrinho;

    function __construct($id_carrinho) {
        $this->id_carrinho = $id_carrinho;
    }

    function getId_carrinho() {
        return $this->id_carrinho;
    }

    function setId_carrinho($id_carrinho) {
        $this->id_carrinho = $id_carrinho;
    }

}
