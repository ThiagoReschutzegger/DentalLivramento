<?php

class Produto {
    
    public $id_produto;
    public $barcode;
    public $preco;
    public $nome;
    public $estoque;
    public $imagem;
    public $descricao;
    public $destaque;
    public $tipo;
    public $id_grupo;
    public $id_marca;
    
    function __construct($id_produto, $barcode, $preco, $nome, $estoque, $imagem, $descricao, $destaque, $tipo, $id_grupo, $id_marca) {
        $this->id_produto = $id_produto;
        $this->barcode = $barcode;
        $this->preco = $preco;
        $this->nome = $nome;
        $this->estoque = $estoque;
        $this->imagem = $imagem;
        $this->descricao = $descricao;
        $this->destaque = $destaque;
        $this->tipo = $tipo;
        $this->id_grupo = $id_grupo;
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

    function getNome() {
        return $this->nome;
    }

    function getEstoque() {
        return $this->estoque;
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

    function getTipo() {
        return $this->tipo;
    }

    function getId_grupo() {
        return $this->id_grupo;
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

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setEstoque($estoque) {
        $this->estoque = $estoque;
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

    function setTipo($tipo) {
        $this->tipo = $tipo;
    }

    function setId_grupo($id_grupo) {
        $this->id_grupo = $id_grupo;
    }

    function setId_marca($id_marca) {
        $this->id_marca = $id_marca;
    }


    
}