<?php

class Produto {

    public $id_produto;
    public $barcode;
    public $preco;
    public $estoque;
    public $especificacao;
    public $id_subgrupo;
    public $id_marca;

    function __construct($id_produto, $barcode, $preco, $estoque, $especificacao, $id_subgrupo, $id_marca){
        $this->id_produto = $id_produto;
        $this->barcode = $barcode;
        $this->preco = $preco;
        $this->estoque = $estoque;
        $this->especificacao = $especificacao;
        $this->id_subgrupo = $id_subgrupo;
        $this->id_marca = $id_marca;
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

    function getId_subgrupo() {
        return $this->id_subgrupo;
    }
    
    function getId_marca() {
        return $this->id_marca;
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

    function setId_subgrupo($id_subgrupo) {
          $this->id_subgrupo = $id_subgrupo;
      }

    function setId_marca($id_marca) {
          $this->id_marca = $id_marca;
      }

}
