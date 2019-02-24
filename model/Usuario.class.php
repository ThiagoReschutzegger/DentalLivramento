<?php

class Usuario {
    
    private $id_user;
    private $nome;
    private $login;
    private $senha;
    private $email;

    function __construct($login, $senha, $nome = '', $email = '', $id_user = '') {
        $this->id_user = $id_user;
        $this->nome = $nome;
        $this->login = $login;
        $this->senha = $senha;
        $this->email = $email;
    }

    function getId_user() {
        return $this->id_user;
    }

    function getId() {
        return $this->id_user;
    }

    function getNome() {
        return $this->nome;
    }

    function getLogin() {
        return $this->login;
    }

    function getSenha() {
        return $this->senha;
    }

    function getEmail() {
        return $this->email;
    }

    function setId_user($id_user) {
        $this->id_user = $id_user;
    }

    function setId($id_user) {
        $this->id_user = $id_user;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setLogin($login) {
        $this->login = $login;
    }

    function setSenha($senha) {
        $this->senha = $senha;
    }

    function setEmail($email) {
        $this->email = $email;
    }

}
