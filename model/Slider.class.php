<?php

class Slider {

    public $id_slider;
    public $id_subgrupo;
    public $imagem;
    public $fundo;
    public $status;

    function __construct($id_slider,$id_subgrupo, $imagem, $fundo, $status) {
        $this->id_slider = $id_slider;
        $this->id_subgrupo = $id_subgrupo;
        $this->imagem = $imagem;
        $this->fundo = $fundo;
        $this->status = $status;
    }

    function getId_slider() {
        return $this->id_slider;
    }

    function setId_slider($id_slider) {
        $this->id_slider = $id_slider;
    }

    function getId_subgrupo() {
        return $this->id_subgrupo;
    }

    function setId_subgrupo($id_subgrupo) {
        $this->id_subgrupo = $id_subgrupo;
    }

    function getImagem() {
        return $this->imagem;
    }

    function setImagem($imagem) {
        $this->imagem = $imagem;
    }

    function getFundo() {
        return $this->fundo;
    }

    function setFundo($fundo) {
        $this->fundo = $fundo;
    }

    function getStatus() {
        return $this->status;
    }

    function setStatus($status) {
        $this->status = $status;
    }
}
