<?php

class Destaque {

    public $id_destaque;
    public $nome;
    public $imagem;
    public $id_grupo;

    function __construct($id_destaque, $nome, $imagem, $id_grupo) {
        $this->id_destaque = $id_destaque;
        $this->nome = $nome;
        $this->imagem = $imagem;
        $this->id_grupo = $id_grupo;
    }

    function getId_destaque() {
        return $this->id_destaque;
    }

    function getNome() {
        return $this->nome;
    }

    function getImagem() {
        return $this->imagem;
    }

    function getId_grupo() {
        return $this->id_grupo;
    }

    function setId_destaque($id_destaque) {
        $this->id_destaque = $id_destaque;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setImagem($imagem) {
        $this->imagem = $imagem;
    }

    function setId_grupo($id_grupo) {
        $this->id_grupo = $id_grupo;
    }

}
