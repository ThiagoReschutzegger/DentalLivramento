<?php

class Subgrupo {

    public $id_subgrupo;
    public $nome;
    public $descricao;
    public $imagem;
    public $destaque;
    public $id_grupo;
    public $id_marca;

    function __construct($id_subgrupo, $nome, $descricao, $imagem, $destaque, $id_grupo, $id_marca) {
        $this->id_subgrupo = $id_subgrupo;
        $this->nome = $nome;
        $this->descricao = $descricao;
        $this->imagem = $imagem;
        $this->destaque = $destaque;
        $this->id_grupo = $id_grupo;
        $this->id_marca = $id_marca;
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

    function getDestaque() {
        return $this->destaque;
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

    function setId_subgrupo($id_subgrupo) {
        $this->id_subgrupo = $id_subgrupo;
    }

    function setNome($nome) {
        $this->nome = $nome;
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

    function setId_grupo($id_grupo) {
        $this->id_grupo = $id_grupo;
    }

    function setId_marca($id_marca) {
        $this->id_marca = $id_marca;
    }

}
