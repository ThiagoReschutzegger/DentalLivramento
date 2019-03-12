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
        $data['status'] = '0';
        $data['resultado'] = 'inicio';

        if (filter_input(INPUT_POST, 'buscar')) {
            if ((filter_input(INPUT_POST, 'organizar', FILTER_SANITIZE_STRING)) == '1') {

                $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
                $codigo = filter_input(INPUT_POST, 'codigo', FILTER_SANITIZE_STRING);

                //echo '<pre>';var_dump($nome);var_dump($codigo);echo '</pre>';

                if ($nome || $codigo) {
                    $resultado = $this->model->searchProdutoUnitario($nome, $codigo);
                    $data['status'] = '1';
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
                    $data['status'] = '2';
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
        $this->view->load('busca-produto', $data);
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

  public function addProdutoCompleto($id_gp) { //Edu
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

    public function addCommonWhere() { //seleciona o grupo em que so sub grupo está. Edu
      $data['msg'] = '';
      $data['categoria'] = $this->modelCategoria->getCategoria();
      $data['grupo'] = $this->modelGrupo->getGrupo();

      $this->view->load('header');
      $this->view->load('nav');
      $this->view->load('add-common-select',$data);
      $this->view->load('footer');
  }

    public function addCommonProd($id) { //seleciona o subgrupo em que será adicionada a especificacao. Edu
      $data['msg'] = '';
      $data['subgrupo'] = $this->modelSubgrupo->getSubgrupoByGrupo($id);

      $this->view->load('header');
      $this->view->load('nav');
      $this->view->load('add-common-sub',$data);
      $this->view->load('footer');
    }

    public function addCommon($id) { //Edu
      $data['msg'] = '';
      $data['id'] = $id;

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

      public function viewSubOf($id_subgrupo, $mensagem=null) { //seleciona o grupo em que será adicionado o produto completo. Edu
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
          return true;
        }else{
          $data['msg'][0] = 'Ocorreu algum erro ao deletar produto, Guillermo... Tente novamente mais tarde.';
          $data['msg'][1] = 2;
        }
      }
      $data['produto'] = $this->model->getProdutoById($id);
      $this->view->load('header');
      $this->view->load('nav');
      $this->view->load('del-produto', $data);
      $this->view->load('footer');
    }

    public function updateSub($id_subgrupo) { //Edu
      $data['subgrupo'] = $this->modelSubgrupo->getSubgrupoById($id_subgrupo);
      $data['grupo'] = $this->modelGrupo->getGrupo();
      $data['marca'] = $this->modelMarca->getMarca();
      $data['msg'] = '';

      if (filter_input(INPUT_POST, 'upd')) {
        $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
        $descricao = filter_input(INPUT_POST, 'descricao', FILTER_SANITIZE_STRING);
        $imagem = filter_input(INPUT_POST, 'imagem', FILTER_SANITIZE_STRING);
        $id_grupo = filter_input(INPUT_POST, 'id_grupo', FILTER_SANITIZE_STRING);
        $id_marca = filter_input(INPUT_POST, 'id_marca', FILTER_SANITIZE_STRING);

        if ($id_subgrupo && $nome && $descricao && $imagem && $id_grupo && $id_marca) {
            $subgrupo = new Subgrupo($id_subgrupo, $nome, $descricao, $imagem, 0, $id_grupo, $id_marca);
            if ($this->modelSubgrupo->updateSubgrupo($subgrupo)) {
                $this->viewSubOf($id_subgrupo);
                return true;
            } else {
              $this->viewSubOf($id_subgrupo);
              return true;
                }
        } else {
             $data['msg'] = 'Preencha todos os Campos!';
        }
      }

      $this->view->load('header');
      $this->view->load('nav');
      $this->view->load('upd-sub', $data);
      $this->view->load('footer');
  }

  public function deleteProdutoCompleto($id_subgrupo) {//deleta o subgrupo com todos os produtos que estão relacionados a ele. Edu
    $data['msg'] = '';
    $data['produto'] = $this->model->getProdutosBySubgrupoId($id_subgrupo);
    $data['subgrupo'] = $this->modelSubgrupo->getSubgrupoById($id_subgrupo);

    if (filter_input(INPUT_POST, 'del')) {
      foreach($data['produto'] as $prod){
          if($this->model->removeProduto($prod->getId_produto())){
            $data['msg'] = 'Produto deletado com sucesso!';
          }else{
            $data['msg'] = 'Ocorreu algum erro ao deletar produto, Guillermo... Tente novamente mais tarde.';
          }
        }
        if($this->modelSubgrupo->removeSubgrupo($id_subgrupo)){
          $data['msg'] = 'Produtos deletados com sucesso!';
          $this->index();
          return true;
        }else{
          $data['msg'] = 'Ocorreu algum erro ao deletar produto, Guillermo... Tente novamente mais tarde.';
        }
    }
    $this->view->load('header');
    $this->view->load('nav');
    $this->view->load('del-produtos', $data);
    $this->view->load('footer');
  }

  public function updateProduto($id_produto) { //Edu
    $data['produto'] = $this->model->getProdutoById($id_produto);
    $data['msg'] = '';

    if (filter_input(INPUT_POST, 'upd')) {
      $barcode = filter_input(INPUT_POST, 'barcode', FILTER_SANITIZE_STRING);
      $preco = filter_input(INPUT_POST, 'preco', FILTER_SANITIZE_STRING);
      $estoque = filter_input(INPUT_POST, 'estoque', FILTER_SANITIZE_STRING);
      $especificacao = filter_input(INPUT_POST, 'especificacao', FILTER_SANITIZE_STRING);
      $id_subgrupo = $data['produto']->getId_subgrupo();

      if ($barcode && $preco && $estoque && $especificacao && $id_subgrupo) {
          $produto = new Produto($id_produto, $barcode, $preco, $estoque, $especificacao, $id_subgrupo);
          if ($this->model->updateProduto($produto)) {
              $this->viewSubOf($id_subgrupo);
              return true;
          } else {
            $this->viewSubOf($id_subgrupo);
            return true;
              }
      } else {
           $data['msg'] = 'Preencha todos os Campos!';
      }
    }

    $this->view->load('header');
    $this->view->load('nav');
    $this->view->load('upd-prod', $data);
    $this->view->load('footer');
}

public function uploadTxt(){

  if(filter_input(INPUT_POST, 'add')){
          $src = $_FILES['arquivo']['tmp_name'];
          $name = $_FILES['arquivo']['name'];
          if($src){
              if(move_uploaded_file($src, "view/imagens/".$name)){
                  if($this->model->addImagem(new Imagem(null,$name,$tam))){
                      $this->index();
                      return true;
                  }else{
                      $data['msg'] = 'Erro no cadastro';
                  }
              }else{
                  $data['msg'] = 'Erro no cadastro';
              }
          }else{
              $data['msg'] = 'Informe todos os campos';
          }
      }

  $this->view->load('header');
  $this->view->load('nav');
  $this->view->load('upload');
  $this->view->load('footer');
}



}
