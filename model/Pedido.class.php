<?php

class Pedido {

    public $id_pedido;
    public $nome;
    public $endereco;
    public $cep;
    public $cidade;
    public $uf;
    public $telefone;
    public $email;
    public $mensagem;
    public $precototal;
    public $data;
    public $status;
    public $id_carrinho;

    function __construct($id_pedido, $nome, $endereco, $cep, $cidade, $uf,$telefone,$email,$mensagem,$precototal,$data,$status,$id_carrinho){
        $this->id_pedido = $id_pedido;
        $this->nome = $nome;
        $this->endereco = $endereco;
        $this->cep = $cep;
        $this->cidade = $cidade;
        $this->uf = $uf;
        $this->telefone = $telefone;
        $this->email = $email;
        $this->mensagem = $mensagem;
        $this->precototal = $precototal;
        $this->data = $data;
        $this->status = $status;
        $this->id_carrinho = $id_carrinho;
    }

    function getId_pedido() {
        return $this->id_pedido;
    }

    function getId_carrinho() {
        return $this->id_carrinho;
    }

    function getNome() {
        return $this->nome;
    }

      function getEndereco() {
        return $this->endereco;
    }

    function getCep() {
        return $this->cep;
    }

    function getEmail() {
        return $this->email;
    }

    function getCidade() {
        return $this->cidade;
    }

    function getUf() {
        return $this->uf;
    }

    function getTelefone() {
        return $this->telefone;
    }

    function getMensagem() {
        return $this->mensagem;
    }

    function getPrecototal() {
        return $this->precototal;
    }

    function getData() {
        return $this->data;
    }

    function getStatus() {
        return $this->status;
    }

}
