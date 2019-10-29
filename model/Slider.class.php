<?php

class Slider {

    public $id_slider;
    public $imagem;
    public $status;
    public $id_item;

    function __construct($id_slider, $imagem, $status, $id_item) {
        $this->id_slider = $id_slider;
        $this->imagem = $imagem;
        $this->status = $status;
        $this->id_item = $id_item;
    }

    function getId_slider() {
        return $this->id_slider;
    }

    function setId_slider($id_slider) {
        $this->id_slider = $id_slider;
    }

    function getId_item() {
        return $this->id_item;
    }

    function setId_item($id_item) {
        $this->id_item = $id_item;
    }

    function getImagem() {
        return $this->imagem;
    }

    function setImagem($imagem) {
        $this->imagem = $imagem;
    }

    function getStatus() {
        return $this->status;
    }

    function setStatus($status) {
        $this->status = $status;
    }
}
