<?php

class ProdutoAdmin extends Admin {

    protected $model;
    protected $modelCategoria;
    protected $modelGrupo;
    protected $modelSubgrupo;
    protected $modelMarca;

    public function __construct() {
        parent::__construct();
        $this->model = new ProdutoModel();
        $this->modelCategoria = new CategoriaModel();
        $this->modelGrupo = new GrupoModel();
        $this->modelSubgrupo = new SubgrupoModel();
        $this->modelMarca = new MarcaModel();
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
                    //die;
                    
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

    public function addProdutoWhere() { //seleciona o grupo em que será adicionado o produto completo
      $data['msg'] = '';
      $data['categoria'] = $this->modelCategoria->getCategoria();
      $data['grupo'] = $this->modelGrupo->getGrupo();

      $this->view->load('header');
      $this->view->load('nav');
      $this->view->load('add-prod-select',$data);
      $this->view->load('footer');
  }

  public function addProdutoCompleto($id_gp) {
    $data['msg'] = '';
    $data['marca'] = $this->modelMarca->getMarca();

    if (filter_input(INPUT_POST, 'add')) {
      $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING); //Sg
      $descricao = filter_input(INPUT_POST, 'descricao', FILTER_SANITIZE_STRING); //Sg
      $especificacao = filter_input(INPUT_POST, 'especificacao', FILTER_SANITIZE_STRING); //Prod
      $barcode = filter_input(INPUT_POST, 'barcode', FILTER_SANITIZE_STRING); //Prod
      $preco = filter_input(INPUT_POST, 'preco', FILTER_SANITIZE_STRING); //Prod
      $estoque = filter_input(INPUT_POST, 'estoque', FILTER_SANITIZE_STRING); //Prod
      $imagem = filter_input(INPUT_POST, 'imagem', FILTER_SANITIZE_STRING); //Sg
      $id_marca = filter_input(INPUT_POST, 'id_marca', FILTER_SANITIZE_STRING); //Sg

          if ($nome && $descricao && $especificacao && $barcode && $preco && $estoque && $imagem) {
            $subgrupo = new Subgrupo(null, $nome, $descricao, $imagem, 0, $id_gp, $id_marca);

              if ($this->modelSubgrupo->insertSubgrupo($subgrupo)) {
                    $algo = $this->modelSubgrupo->getSupreme($nome, $descricao, $imagem);
                    $id_subgrupo = $algo->getId_subgrupo();
                    $produto = new Produto(null, $barcode, $preco, $estoque, $especificacao, $id_subgrupo);
                    if($this->model->insertProduto($produto)){
                        $this->index();
                        return true;
                    }else {
                        $data['msg'] = 'Erro prod!';
                        return false;
                        }
              } else {
                  $data['msg'] = 'Erro sub!';
                  return false;
                  }
          } else {
               $data['msg'] = 'Preencha todos os Campos!';
               return false;
          }
      }

      $this->view->load('header');
      $this->view->load('nav');
      $this->view->load('add-prod',$data);
      $this->view->load('footer');
}

}
