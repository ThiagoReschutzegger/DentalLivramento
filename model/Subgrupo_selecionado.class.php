<?php

class Subgrupo_selecionado {

    public $id_selecionado;
    public $id_subgrupo;
    public $imagem;
    
    function __construct($id_selecionado, $id_subgrupo, $imagem) {
        $this->id_selecionado = $id_selecionado;
        $this->id_subgrupo = $id_subgrupo;
        $this->imagem = $imagem;
    }

    function getId_selecionado() {
        return $this->id_selecionado;
    }

    function getId_subgrupo() {
        return $this->id_subgrupo;
    }

    function getImagem() {
        return $this->imagem;
    }

    function setId_selecionado($id_selecionado) {
        $this->id_selecionado = $id_selecionado;
    }

    function setId_subgrupo($id_subgrupo) {
        $this->id_subgrupo = $id_subgrupo;
    }

    function setImagem($imagem) {
        $this->imagem = $imagem;
    }


}
