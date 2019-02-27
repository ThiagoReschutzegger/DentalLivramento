<?php

class Categoria {

    public $id_categoria;
    public $nome;
    public $descricao;
    public $imagem;

    function __construct($id_categoria, $nome, $descricao, $imagem) {
        $this->id_categoria = $id_categoria;
        $this->nome = $nome;
        $this->descricao = $descricao;
        $this->imagem = $imagem;
    }

    function getId_categoria() {
        return $this->id_categoria;
    }

    function getNome() {
        return $this->nome;
    }

    function getDescricao() {
          return $this->descricao;
      }

    function getImagem() {
        return $this->imagem;
    }

    function setId_categoria($id_categoria) {
        $this->id_categoria = $id_categoria;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    function setImagem($imagem) {
        $this->imagem = $imagem;
    }


}
