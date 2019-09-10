<?php

class Subgrupo {

    public $id_subgrupo;
    public $nome;
    public $id_grupo;

    function __construct($id_subgrupo, $nome, $id_grupo) {
        $this->id_subgrupo = $id_subgrupo;
        $this->nome = $nome;
        $this->id_grupo = $id_grupo;
    }

    function getId_subgrupo() {
        return $this->id_subgrupo;
    }

    function getNome() {
        return $this->nome;
    }

    function getId_grupo() {
        return $this->id_grupo;
    }

    function setId_subgrupo($id_subgrupo) {
        $this->id_subgrupo = $id_subgrupo;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setId_grupo($id_grupo) {
        $this->id_grupo = $id_grupo;
    }

}
