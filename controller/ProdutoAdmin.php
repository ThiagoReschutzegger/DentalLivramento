<?php

class ProdutoAdmin extends Admin {

    protected $model;
    protected $modelCategoria;
    protected $modelGrupo;
    protected $modelSubgrupo;
    protected $modelMarca;
    protected $modelPack;

    public function __construct() {
        parent::__construct();
        $this->model = new ProdutoModel();
        $this->modelCategoria = new CategoriaModel();
        $this->modelGrupo = new GrupoModel();
        $this->modelSubgrupo = new SubgrupoModel();
        $this->modelMarca = new MarcaModel();
        $this->modelPack = new PackprodutoModel();
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

          if ($nome && $descricao && $especificacao && $barcode && $preco && $estoque && $imagem && $id_marca) {
              $subgrupo = new Subgrupo(null, $nome, $descricao, $imagem, 0, $id_gp, $id_marca);
              if ($this->modelSubgrupo->insertSubgrupo($subgrupo)) {
                    $algo = $this->modelSubgrupo->getIdBy($nome, $descricao, $imagem);
                    $id_subgrupo = $algo->getId_subgrupo();
                    $produto = new Produto(null, $barcode, $preco, $estoque, $especificacao, $id_subgrupo);
                    if($this->model->insertProduto($produto)){
                        $data['msg'] = 'Adicionado com Sucesso!';
                    }else {
                        $data['msg'] = 'Erro prod!';
                        }
              } else {
                  $data['msg'] = 'Erro sub!';
                  }
          } else {
               $data['msg'] = 'Preencha todos os Campos!';
          }
      }

      $this->view->load('header');
      $this->view->load('nav');
      $this->view->load('add-prod',$data);
      $this->view->load('footer');
    }

    public function addCommonWhere() { //seleciona o grupo em que será adicionado o produto completo
      $data['msg'] = '';
      $data['categoria'] = $this->modelCategoria->getCategoria();
      $data['grupo'] = $this->modelGrupo->getGrupo();

      $this->view->load('header');
      $this->view->load('nav');
      $this->view->load('add-common-select',$data);
      $this->view->load('footer');
  }

    public function addCommonProd($id) { //seleciona o grupo em que será adicionado o produto completo
      $data['msg'] = '';
      $data['subgrupo'] = $this->modelSubgrupo->getSubgrupoByGrupo($id);

      $this->view->load('header');
      $this->view->load('nav');
      $this->view->load('add-common-sub',$data);
      $this->view->load('footer');
    }

    public function addCommon($id) {
      $data['msg'] = '';

      if (filter_input(INPUT_POST, 'add')) {
        $especificacao = filter_input(INPUT_POST, 'especificacao', FILTER_SANITIZE_STRING); //Prod
        $barcode = filter_input(INPUT_POST, 'barcode', FILTER_SANITIZE_STRING); //Prod
        $preco = filter_input(INPUT_POST, 'preco', FILTER_SANITIZE_STRING); //Prod
        $estoque = filter_input(INPUT_POST, 'estoque', FILTER_SANITIZE_STRING); //Prod

            if ($especificacao && $barcode && $preco && $estoque) {
                    $produto = new Produto(null, $barcode, $preco, $estoque, $especificacao, $id);
                    if($this->model->insertProduto($produto)){
                        $data['msg'] = 'Adicionado com Sucesso!';
                    }else {
                        $data['msg'] = 'Erro!';
                    }
             }else {
                 $data['msg'] = 'Preencha todos os Campos!';
            }
          }
        $this->view->load('header');
        $this->view->load('nav');
        $this->view->load('add-common',$data);
        $this->view->load('footer');
      }

      public function viewSubOf($id_subgrupo, $mensagem=null) { //seleciona o grupo em que será adicionado o produto completo
        $data['sub'] = $this->modelSubgrupo->getSubgrupoById($id_subgrupo);
        $data['prod'] = $this->model->getProdutosBySubgrupoId($id_subgrupo);
        $data['marca'] = $this->modelMarca->getMarcaBySubgrupoId($id_subgrupo)[0];
        $data['grupo'] = $this->modelGrupo->getGrupoBySubgrupoId($id_subgrupo);
        //echo '<pre>';var_dump($data);echo '</pre>';die;
        $data['cat'] = $this->modelCategoria->getCategoriaByGrupoId($data['grupo'][0]->getId_grupo());


        $this->view->load('header');
        $this->view->load('nav');
        $this->view->load('produtos-in-subgrupo', $data);
        $this->view->load('footer');
    }


    public function viewProduto($id) {

        $data = $this->modelPack->getPackprodutoById($id);

        //echo '<pre>';var_dump($data);echo '</pre>';die;

        $this->view->load('header');
        $this->view->load('nav');
        $this->view->load('view-single-prod', $data);
        $this->view->load('footer');
    }


    public function deleteProduto($string) {//thiago
      $pieces = explode(".", $string);

      $id = $pieces[0];
      $data['id_subgrupo'] = $pieces[1];
      $data['nome'] = $pieces[2];
      $data['esp'] = $pieces[3];

      $data['msg'][0] = '';
      $data['msg'][1] = 0;
      //echo '<pre>';var_dump($pieces);echo '</pre>';die;

      if (filter_input(INPUT_POST, 'del')) {
        if($this->model->removeProduto($id)){
          $data['msg'][0] = 'Produto deletado com sucesso!';
          $data['msg'][1] = 1;
          //$this->viewSubOf($id_subgrupo,$data['msg']);
          $this->index();
        }else{
          $data['msg'][0] = 'Ocorreu algum erro ao deletar produto, Guillermo... Tente novamente mais tarde.';
          $data['msg'][1] = 2;
          // $this->viewSubOf($id_subgrupo,$data['msg']);
          $this->index();
        }
      }
      $data['produto'] = $this->model->getProdutoById($id);
      $this->view->load('header');
      $this->view->load('nav');
      $this->view->load('del-produto', $data);
      $this->view->load('footer');
    }

}
