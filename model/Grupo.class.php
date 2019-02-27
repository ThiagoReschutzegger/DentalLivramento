<?php

class Grupo {

    public $id_grupo;
    public $nome;
    public $id_categoria;

    function __construct($id_grupo, $nome, $id_categoria) {
        $this->id_grupo = $id_grupo;
        $this->nome = $nome;
        $this->$id_categoria = $id_categoria;
    }

    function getId_grupo() {
        return $this->id_grupo;
    }

    function getNome() {
        return $this->nome;
    }

    function getId_categoria() {
        return $this->id_categoria;
    }

    function setId_grupo($id_grupo) {
        $this->id_grupo = $id_grupo;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setId_categoria($id_categoria) {
        $this->id_categoria = $id_categoria;
    }

}
