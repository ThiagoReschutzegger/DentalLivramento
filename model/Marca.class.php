<?php

class Marca {

    public $id_marca;
    public $nome;
    public $imagem;
    public $catalogo;
    public $slider;
    public $single_prod;

    function __construct($id_marca, $nome, $imagem, $catalogo, $slider, $single_prod) {
        $this->id_marca = $id_marca;
        $this->nome = $nome;
        $this->imagem = $imagem;
        $this->catalogo = $catalogo;
        $this->slider = $slider;
        $this->single_prod = $single_prod;
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
    
    function getSingle_prod() {
        return $this->single_prod;
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
    
    function setSingle_prod($single_prod) {
        $this->single_prod = $single_prod;
    }
}
