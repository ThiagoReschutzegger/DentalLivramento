<?php

class Packproduto {

    public $id_produto;
    public $barcode;
    public $preco;
    public $estoque;
    public $especificacao;
    public $tipo;
    public $id_subgrupo;
    public $id_marca;
    public $nome; //subgrupo
    public $descricao; //item
    public $imagem; //item
    public $destaque; //item

    function __construct($id_produto, $barcode, $preco, $estoque, $especificacao, $tipo, $id_subgrupo, $id_marca, $nome, $descricao, $imagem, $destaque) {
        $this->id_produto = $id_produto;
        $this->barcode = $barcode;
        $this->preco = $preco;
        $this->estoque = $estoque;
        $this->especificacao = $especificacao;
        $this->tipo = $tipo;
        $this->id_subgrupo = $id_subgrupo;
        $this->id_marca = $id_marca;
        $this->nome = $nome;
        $this->descricao = $descricao;
        $this->imagem = $imagem;
        $this->destaque = $destaque;
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
    
    function getTipo() {
        return $this->tipo;
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

    function getDestaque() {
        return $this->destaque;
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
    
    function setTipo($tipo) {
        $this->tipo = $tipo;
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

    function setDestaque($destaque) {
        $this->destaque = $destaque;
    }

    function setId_marca($id_marca) {
        $this->id_marca = $id_marca;
    }

}
