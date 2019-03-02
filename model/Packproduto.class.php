<?php

class Packproduto {

  public $id_packproduto;

  public $id_produto;
  public $barcode;
  public $preco;
  public $estoque;
  public $especificacao;

  public $id_subgrupo;
  public $nome;
  public $imagem;
  public $descricao;
  public $id_grupo;
  public $id_marca;

    function __construct($id_packproduto, $id_produto, $barcode, $preco, $estoque, $especificacao, $id_subgrupo, $nome, $imagem, $descricao, $id_grupo, $id_marca){
        $this->id_packproduto = $id_packproduto;
        $this->id_produto = $id_produto;
        $this->barcode = $barcode;
        $this->preco = $preco;
        $this->estoque = $estoque;
        $this->id_grupo = $especificacao;
        $this->id_subgrupo = $id_subgrupo;
        $this->nome = $nome;
        $this->imagem = $imagem;
        $this->descricao = $descricao;
        $this->id_grupo = $id_grupo;
        $this->id_marca = $id_marca;
    }

    function getId_packproduto() {
        return $this->id_packproduto;
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

    function getNome() {
        return $this->nome;
    }

    function getImagem() {
        return $this->imagem;
    }

    function getDescricao() {
        return $this->descricao;
    }

    function getId_grupo() {
        return $this->id_grupo;
    }

    function getId_marca() {
        return $this->id_marca;
    }



    function setId_packproduto($id_packproduto) {
        $this->id_packproduto = $id_packproduto;
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

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setImagem($imagem) {
        $this->imagem = $imagem;
    }

    function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    function setId_grupo($id_grupo) {
        $this->id_grupo = $id_grupo;
    }

    function setId_marca($id_marca) {
        $this->id_marca = $id_marca;
    }

}
