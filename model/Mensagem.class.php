<?php

class Mensagem {

    public $id_mensagem;
    public $email;
    public $mensagem;
    public $data;

    function __construct($id_mensagem, $email, $mensagem, $data) {
        $this->id_mensagem = $id_mensagem;
        $this->email = $email;
        $this->mensagem = $mensagem;
        $this->data = $data;
    }

    function getId_mensagem() {
        return $this->id_mensagem;
    }

    function getEmail() {
        return $this->email;
    }

    function getMensagem() {
          return $this->mensagem;
    }

    function getData() {
          return $this->data;
    }

    function setId_mensagem($id_mensagem) {
        $this->id_mensagem = $id_mensagem;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setMensagem($mensagem) {
        $this->mensagem = $mensagem;
    }

    function setData($data) {
        $this->data = $data;
    }
}
