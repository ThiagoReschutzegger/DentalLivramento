<?php

class ProdutoAdmin extends Admin {

    protected $model;
    protected $modelcategoria;
    protected $modelgrupo;

    public function __construct() {
        parent::__construct();
        $this->model = new ProdutoModel();
    }

    public function index() {
        $this->view->load('header');
        $this->view->load('nav');
        $this->view->load('produto');
        $this->view->load('footer');
    }

    public function buscaProduto() {

        $data['msg'] = '';
        $data['resultado'] = 'inicio';

        if (filter_input(INPUT_POST, 'buscar')) {
            if ((filter_input(INPUT_POST, 'organizar', FILTER_SANITIZE_STRING)) == '1') {
                
                $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
                $codigo = filter_input(INPUT_POST, 'codigo', FILTER_SANITIZE_STRING);

                //echo '<pre>';var_dump($nome);var_dump($codigo);echo '</pre>';

                if ($nome || $codigo) {
                    $resultado = $this->model->searchProdutoUnitario($nome, $codigo);

                    //echo '<pre>';var_dump($resultado);echo '</pre>';

                    if (!empty($resultado)) {
                        $data['resultado'] = $resultado;
                    } else {
                        $data['resultado'] = 'vazio';
                    }
                } else {
                    $data['resultado'] = 'inicio';
                }
            } elseif ((filter_input(INPUT_POST, 'organizar', FILTER_SANITIZE_STRING)) == '2') {
                
                $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
                $codigo = filter_input(INPUT_POST, 'codigo', FILTER_SANITIZE_STRING);

                //echo '<pre>';var_dump($nome);var_dump($codigo);echo '</pre>';

                if ($nome || $codigo) {
                    $resultado = $this->model->searchProdutoAgrupado($nome, $codigo);

                    //echo '<pre>';var_dump($resultado);echo '</pre>';

                    if (!empty($resultado)) {
                        $data['resultado'] = $resultado;
                    } else {
                        $data['resultado'] = 'vazio';
                    }
                } else {
                    $data['resultado'] = 'inicio';
                }
            }
        } else {
            $data['resultado'] = 'inicio';
        }

        $this->view->load('header');
        $this->view->load('nav');
        $this->view->load('busca-produto', $data['resultado']);
        $this->view->load('footer');
    }

}
