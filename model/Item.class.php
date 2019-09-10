<?php

class Item {

    public $id_item;
    public $descricao;
    public $imagem;
    public $destaque;
    public $id_subgrupo;
    public $id_marca;

    function __construct($id_item, $descricao, $imagem, $destaque, $id_subgrupo, $id_marca) {
        $this->id_item = $id_item;
        $this->descricao = $descricao;
        $this->imagem = $imagem;
        $this->destaque = $destaque;
        $this->id_subgrupo = $id_subgrupo;
        $this->id_marca = $id_marca;
    }

    function getId_item() {
        return $this->id_item;
    }

    function getImagem() {
        return $this->imagem;
    }

    function getDestaque() {
        return $this->destaque;
    }

    function getDescricao() {
        return $this->descricao;
    }

    function getId_subgrupo() {
        return $this->id_subgrupo;
    }

    function getId_marca() {
        return $this->id_marca;
    }

    function setId_item($id_item) {
        $this->id_item = $id_item;
    }

    function setImagem($imagem) {
        $this->imagem = $imagem;
    }

    function setDestaque($destaque) {
        $this->destaque = $destaque;
    }

    function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    function setId_subgrupo($id_subgrupo) {
        $this->id_subgrupo = $id_subgrupo;
    }

    function setId_marca($id_marca) {
        $this->id_marca = $id_marca;
    }

}
