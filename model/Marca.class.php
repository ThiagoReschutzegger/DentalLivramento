<?php

class Marca {

    public $id_marca;
    public $nome;
    public $imagem;
    public $catalogo;
    public $slider;

    function __construct($id_marca, $nome, $imagem, $catalogo, $slider) {
        $this->id_marca = $id_marca;
        $this->nome = $nome;
        $this->imagem = $imagem;
        $this->catalogo = $catalogo;
        $this->slider = $slider;
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

    function getCatalogo() {
        return $this->catalogo;
    }

    function getSlider() {
        return $this->slider;
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

    function setCatalogo($catalogo) {
        $this->catalogo = $catalogo;
    }

    function setSlider($slider) {
        $this->slider = $slider;
    }
}
