<?php

class Produto {

    public $id_produto;
    public $barcode;
    public $preco;
    public $estoque;
    public $especificacao;

    function __construct($id_produto, $barcode, $preco, $estoque, $especificacao){
        $this->id_produto = $id_produto;
        $this->barcode = $barcode;
        $this->preco = $preco;
        $this->estoque = $estoque;
        $this->id_grupo = $especificacao;
    }

    function getId_produto() {
        return $this->id_produto;
    }

    function getBarcode() {
        return $this->barcode;
    }

    function getPreco() {
        return $this->preco;
    }

    function getEstoque() {
        return $this->estoque;
    }

    function getEspecificacao() {
        return $this->especificacao;
    }

    function setId_produto($id_produto) {
        $this->id_produto = $id_produto;
    }

    function setBarcode($barcode) {
        $this->barcode = $barcode;
    }

    function setPreco($preco) {
        $this->preco = $preco;
    }

  function setEstoque($estoque) {
        $this->estoque = $estoque;
    }

  function setEspecificacao($especificacao) {
        $this->especificacao = $especificacao;
    }

}
