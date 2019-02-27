<?php

class Marca {

    public $id_marca;
    public $nome;
    public $imagem;

    function __construct($id_marca, $nome, $imagem) {
        $this->id_marca = $id_marca;
        $this->nome = $nome;
        $this->imagem = $imagem;
    }

    function getId_marca() {
        return $this->id_marca;
    }

    function getNome() {
        return $this->nome;
    }

    function getImagem() {
        return $this->imagem;
    }

    function setId_marca($id_marca) {
        $this->id_marca = $id_marca;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setImagem($imagem) {
        $this->imagem = $imagem;
    }


}
