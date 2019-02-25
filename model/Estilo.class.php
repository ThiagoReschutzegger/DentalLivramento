<?php

class Estilo {

    public $id_estilo;
    public $hexadecimal;
    public $local;
    public $nome;
    public $status;
    
    function __construct($id_estilo, $hexadecimal, $local, $nome, $status) {
        $this->id_estilo = $id_estilo;
        $this->hexadecimal = $hexadecimal;
        $this->local = $local;
        $this->nome = $nome;
        $this->status = $status;
    }

    function getId_estilo() {
        return $this->id_estilo;
    }

    function getHexadecimal() {
        return $this->hexadecimal;
    }

    function getLocal() {
        return $this->local;
    }

    function getNome() {
        return $this->nome;
    }

    function getStatus() {
        return $this->status;
    }

    function setId_estilo($id_estilo) {
        $this->id_estilo = $id_estilo;
    }

    function setHexadecimal($hexadecimal) {
        $this->hexadecimal = $hexadecimal;
    }

    function setLocal($local) {
        $this->local = $local;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setStatus($status) {
        $this->status = $status;
    }


}
