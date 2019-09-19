<?php

class ProdutoAdmin extends Admin {

    protected $model;
    protected $modelCategoria;
    protected $modelGrupo;
    protected $modelSubgrupo;
    protected $modelMarca;
    protected $modelPack;
    protected $modelSlider;
    protected $modelItem;

    public function __construct() {
        parent::__construct();
        $this->model = new ProdutoModel();
        $this->modelCategoria = new CategoriaModel();
        $this->modelGrupo = new GrupoModel();
        $this->modelSubgrupo = new SubgrupoModel();
        $this->modelMarca = new MarcaModel();
        $this->modelPack = new PackprodutoModel();
        $this->modelSlider = new SliderModel();
        $this->modelItem = new ItemModel();
    }

    public function index() {
        header('location:' . $this->config->base_url . 'ProdutoAdmin/buscaProduto');
    }

    public function buscaProduto($param = null){

        $data['msg'] = '';
        $data['status'] = '0';
        $data['resultado'] = 'inicio';

        if (filter_input(INPUT_POST, 'buscar')) {

                $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
                $codigo = filter_input(INPUT_POST, 'codigo', FILTER_SANITIZE_STRING);

                //echo '<pre>';var_dump($nome);var_dump($codigo);echo '</pre>';

                if ($nome) {
                    $string = $nome;
                    while ($string){
                        if ($this->modelSubgrupo->searchSubgrupoForAdm($string)) { 
                          $resultado = $this->modelSubgrupo->searchSubgrupoForAdm($string);
                          $data['status'] = '1';
                          $string = false;
                        }else{
                            $string = substr_replace($string ,"", -1);
                            if (strlen($string) < 4) $string = false; // caso fique uma string muito pequena para comparar aos nomes dos subgrupos
                            $resultado = array();
                        }
                    }
                    
//                    echo '<pre>';var_dump($resultado[0]);echo '</pre>';
//                    die;

                    if (!empty($resultado)) {
                        $data['resultado'] = 'SearchDeSub';
                        $data['subgrupo'] = $resultado[0];
                        $data['grupo'] = $resultado[1];
                        $data['categoria'] = $resultado[2];
                    } else {
                        $data['resultado'] = 'vazio';
                    }
                } elseif($codigo) {
                    $resultado = $this->model->searchProdutoByBarcode($codigo);
                    $data['status'] = '1';
                    //echo '<pre>';var_dump($resultado);echo '</pre>';
                    //die;

                    if (!empty($resultado)) {
                        $data['resultado'] = 'SearchDeProd';
                        $id_subgrupo = $resultado[0];
                        $id_marca = $resultado[1];
                        $data['item'] = $this->modelItem->getItemByIds($id_subgrupo,$id_marca);
                        $data['subgrupo'] = $this->modelSubgrupo->getSubgrupoById($id_subgrupo);
                        $data['produto'] = $this->model->getProdutosByIds($id_subgrupo, $id_marca);
                        $data['marca'] = $this->modelMarca->getMarcaById($id_marca);
                    } else {
                        $data['resultado'] = 'vazio';
                    }
                } else {
                    $data['resultado'] = 'inicio';
                }

        } else {
            $data['resultado'] = 'inicio';
        }

        if($param == "all"){
            $data['resultado'] = "all";
            $data['categoria'] = $this->modelCategoria->getCategoria();
            $data['grupo'] = $this->modelGrupo->getGrupo();
            $data['subgrupo'] = $this->modelSubgrupo->getSubgrupo();

        }

        $this->view->load('header');
        $this->view->load('nav');
        $this->view->load('busca-produto', $data);
        $this->view->load('footer');
    }

//    public function addProdutoWhere() { //seleciona o grupo em que será adicionado o produto completo
//      $data['msg'] = '';
//      $data['categoria'] = $this->modelCategoria->getCategoria();
//      $data['grupo'] = $this->modelGrupo->getGrupo();
//
//      $this->view->load('header');
//      $this->view->load('nav');
//      $this->view->load('add-prod-select',$data);
//      $this->view->load('footer');
//  }
//
//  public function addProdutoCompleto($id_gp) { //Edu
//    $data['msg'] = '';
//    $data['marca'] = $this->modelMarca->getMarca();
//
//    if (filter_input(INPUT_POST, 'add')) {
//      $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING); //Sg
//      $descricao = filter_input(INPUT_POST, 'descricao', FILTER_SANITIZE_STRING); //Sg
//      $especificacao = filter_input(INPUT_POST, 'especificacao', FILTER_SANITIZE_STRING); //Prod
//      $barcode = filter_input(INPUT_POST, 'barcode', FILTER_SANITIZE_STRING); //Prod
//      $preco = filter_input(INPUT_POST, 'preco', FILTER_SANITIZE_STRING); //Prod
//      $estoque = filter_input(INPUT_POST, 'estoque', FILTER_SANITIZE_STRING); //Prod
//      $imagem = filter_input(INPUT_POST, 'imagem', FILTER_SANITIZE_STRING); //Sg
//      $id_marca = filter_input(INPUT_POST, 'id_marca', FILTER_SANITIZE_STRING); //Sg
//
//          if ($nome && $descricao && $especificacao && $barcode && $preco && $estoque && $imagem && $id_marca) {
//              $subgrupo = new Subgrupo(null, $nome, $descricao, $imagem, 0, $id_gp, $id_marca);
//              if ($this->modelSubgrupo->insertSubgrupo($subgrupo)) {
//                    $algo = $this->modelSubgrupo->getIdBy($nome, $descricao, $imagem);
//                    $id_subgrupo = $algo->getId_subgrupo();
//                    $produto = new Produto(null, $barcode, $preco, $estoque, $especificacao, $id_subgrupo);
//                    if($this->model->insertProduto($produto)){
//                        $data['msg'] = 'Adicionado com Sucesso!';
//                    }else {
//                        $data['msg'] = 'Erro prod!';
//                        }
//              } else {
//                  $data['msg'] = 'Erro sub!';
//                  }
//          } else {
//               $data['msg'] = 'Preencha todos os Campos!';
//          }
//      }
//
//      $this->view->load('header');
//      $this->view->load('nav');
//      $this->view->load('add-prod',$data);
//      $this->view->load('footer');
//    }
//
//    public function addCommonWhere() { //seleciona o grupo em que so sub grupo está. Edu
//      $data['msg'] = '';
//      $data['categoria'] = $this->modelCategoria->getCategoria();
//      $data['grupo'] = $this->modelGrupo->getGrupo();
//
//      $this->view->load('header');
//      $this->view->load('nav');
//      $this->view->load('add-common-select',$data);
//      $this->view->load('footer');
//  }
//
//    public function addCommonProd($id) { //seleciona o subgrupo em que será adicionada a especificacao. Edu
//      $data['msg'] = '';
//      $data['subgrupo'] = $this->modelSubgrupo->getSubgrupoByGrupo($id);
//
//      $this->view->load('header');
//      $this->view->load('nav');
//      $this->view->load('add-common-sub',$data);
//      $this->view->load('footer');
//    }

//    public function addCommon($id) { //Edu
//      $data['msg'] = '';
//      $data['id'] = $id;
//
//      if (filter_input(INPUT_POST, 'add')) {
//        $especificacao = filter_input(INPUT_POST, 'especificacao', FILTER_SANITIZE_STRING); //Prod
//        $barcode = filter_input(INPUT_POST, 'barcode', FILTER_SANITIZE_STRING); //Prod
//        $preco = filter_input(INPUT_POST, 'preco', FILTER_SANITIZE_STRING); //Prod
//        $estoque = filter_input(INPUT_POST, 'estoque', FILTER_SANITIZE_STRING); //Prod
//
//            if ($especificacao && $barcode && $preco && $estoque) {
//                    $produto = new Produto(null, $barcode, $preco, $estoque, $especificacao, $id);
//                    if($this->model->insertProduto($produto)){
//                        $data['msg'] = 'Adicionado com Sucesso!';
//                    }else {
//                        $data['msg'] = 'Erro!';
//                    }
//             }else {
//                 $data['msg'] = 'Preencha todos os Campos!';
//            }
//          }
//        $this->view->load('header');
//        $this->view->load('nav');
//        $this->view->load('add-common',$data);
//        $this->view->load('footer');
//      }

//      public function viewSubOf($id_subgrupo, $mensagem=null) { //seleciona o grupo em que será adicionado o produto completo. Edu
//        $data['sub'] = $this->modelSubgrupo->getSubgrupoById($id_subgrupo);
//        $data['prod-destaq'] = $this->modelSubgrupo->getSubgrupoDestaque();
//        $data['prod'] = $this->model->getProdutosBySubgrupoId($id_subgrupo);
//        $data['marca'] = $this->modelMarca->getMarcaBySubgrupoId($id_subgrupo)[0];
//        $data['grupo'] = $this->modelGrupo->getGrupoBySubgrupoId($id_subgrupo);
//        //echo '<pre>';var_dump($data);echo '</pre>';die;
//        $data['cat'] = $this->modelCategoria->getCategoriaByGrupoId($data['grupo'][0]->getId_grupo());
//        $data['sliderids'] = $this->modelSlider->getSliderSubgrupoIds();
//
//        $data['prod-destaqis'] = [];
//        foreach($data['prod-destaq'] as $linha){
//            $data['prod-destaqis'][] = $linha->getId_subgrupo();
//        }
//
//        $this->view->load('header');
//        $this->view->load('nav');
//        $this->view->load('produtos-in-subgrupo', $data);
//        $this->view->load('footer');
//    }

//    public function viewProduto($id) {
//
//        $data = $this->modelPack->getPackprodutoById($id);
//
//        //echo '<pre>';var_dump($data);echo '</pre>';die;
//
//        $this->view->load('header');
//        $this->view->load('nav');
//        $this->view->load('view-single-prod', $data);
//        $this->view->load('footer');
//    }

    public function viewItens($id_subgrupo) {

        $data['subgrupo'] = $this->modelSubgrupo->getSubgrupoById($id_subgrupo);
        $data['item'] = $this->modelItem->getItemBySubgrupo($id_subgrupo);
        $data['produto'] = $this->model->getProdutosBySubgrupoId($id_subgrupo);

        $ids_item = [];
        foreach($data['item'] as $linha){
            $ids_item[] = $linha->getId_marca();
        }
        $data['marca'] = $this->modelMarca->getMarcaByIds($ids_item);

        //echo '<pre>';var_dump($data);echo '</pre>';die;

        $this->view->load('header');
        $this->view->load('nav');
        $this->view->load('view-itens-in-subgrupo', $data);
        $this->view->load('footer');
    }


//    public function deleteProduto($string) {//thiago
//      $pieces = explode(".", $string);
//
//      $id = $pieces[0];
//      $data['id_subgrupo'] = $pieces[1];
//      $data['nome'] = $pieces[2];
//      $data['esp'] = $pieces[3];
//
//      $data['msg'][0] = '';
//      $data['msg'][1] = 0;
//      //echo '<pre>';var_dump($pieces);echo '</pre>';die;
//
//      if (filter_input(INPUT_POST, 'del')) {
//        if($this->model->removeProduto($id)){
//          $data['msg'][0] = 'Produto deletado com sucesso!';
//          $data['msg'][1] = 1;
//          //$this->viewSubOf($id_subgrupo,$data['msg']);
//          $this->index();
//          return true;
//        }else{
//          $data['msg'][0] = 'Ocorreu algum erro ao deletar produto, Guillermo... Tente novamente mais tarde.';
//          $data['msg'][1] = 2;
//        }
//      }
//      $data['produto'] = $this->model->getProdutoById($id);
//      $this->view->load('header');
//      $this->view->load('nav');
//      $this->view->load('del-produto', $data);
//      $this->view->load('footer');
//    }

//    public function updateSub($id_subgrupo) { //Edu
//      $data['subgrupo'] = $this->modelSubgrupo->getSubgrupoById($id_subgrupo);
//      $data['grupo'] = $this->modelGrupo->getGrupo();
//      $data['marca'] = $this->modelMarca->getMarca();
//      $data['msg'] = '';
//
//      if (filter_input(INPUT_POST, 'upd')) {
//        $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
//        $descricao = filter_input(INPUT_POST, 'descricao', FILTER_SANITIZE_STRING);
//        $imagem = filter_input(INPUT_POST, 'imagem', FILTER_SANITIZE_STRING);
//        $id_grupo = filter_input(INPUT_POST, 'id_grupo', FILTER_SANITIZE_STRING);
//        $id_marca = filter_input(INPUT_POST, 'id_marca', FILTER_SANITIZE_STRING);
//
//        if ($id_subgrupo && $nome && $descricao && $imagem && $id_grupo && $id_marca) {
//            $subgrupo = new Subgrupo($id_subgrupo, $nome, $descricao, $imagem, 0, $id_grupo, $id_marca);
//            if ($this->modelSubgrupo->updateSubgrupo($subgrupo)) {
//                $this->viewSubOf($id_subgrupo);
//                return true;
//            } else {
//              $this->viewSubOf($id_subgrupo);
//              return true;
//                }
//        } else {
//             $data['msg'] = 'Preencha todos os Campos!';
//        }
//      }
//
//      $this->view->load('header');
//      $this->view->load('nav');
//      $this->view->load('upd-sub', $data);
//      $this->view->load('footer');
//  }

//  public function deleteProdutoCompleto($id_subgrupo) {//deleta o subgrupo com todos os produtos que estão relacionados a ele. Edu
//    $data['msg'] = '';
//    $data['produto'] = $this->model->getProdutosBySubgrupoId($id_subgrupo);
//    $data['subgrupo'] = $this->modelSubgrupo->getSubgrupoById($id_subgrupo);
//
//    if (filter_input(INPUT_POST, 'del')) {
//      foreach($data['produto'] as $prod){
//          if($this->model->removeProduto($prod->getId_produto())){
//            $data['msg'] = 'Produto deletado com sucesso!';
//          }else{
//            $data['msg'] = 'Ocorreu algum erro ao deletar produto, Guillermo... Tente novamente mais tarde.';
//          }
//        }
//        if($this->modelSubgrupo->removeSubgrupo($id_subgrupo)){
//          $data['msg'] = 'Produtos deletados com sucesso!';
//          $this->index();
//          return true;
//        }else{
//          $data['msg'] = 'Ocorreu algum erro ao deletar produto, Guillermo... Tente novamente mais tarde.';
//        }
//    }
//    $this->view->load('header');
//    $this->view->load('nav');
//    $this->view->load('del-produtos', $data);
//    $this->view->load('footer');
//  }

  public function updateItem($id_item) { //Edu
      $data['item'] = $this->modelItem->getItemById($id_item);
      $data['msg'] = '';

      if (filter_input(INPUT_POST, 'upd')) {
        $descricao = filter_input(INPUT_POST, 'descricao', FILTER_SANITIZE_STRING);
        $imagem = filter_input(INPUT_POST, 'imagem', FILTER_SANITIZE_STRING);
        $destaque = filter_input(INPUT_POST, 'destaque', FILTER_SANITIZE_STRING);

        if ($descricao) { //imagem opcional
            $item = new Item($id_item, $descricao, $imagem, $destaque, $data['item']->getId_subgrupo(), $data['item']->getId_marca());
            if ($this->modelItem->updateItem($item)) {
                $this->viewItens($data['item']->getId_subgrupo());
                return true;
            } else {
              $this->viewItens($data['item']->getId_subgrupo());
              return true;
                }
        } else {
             $data['msg'] = 'Preencha todos os Campos!';
        }
      }

      $this->view->load('header');
      $this->view->load('nav');
      $this->view->load('upd-sub', $data); //so alterei o arquivo.
      $this->view->load('footer');
  }

public function uploadTxt(){// Upload do .txt para atualizar preço e estoque. Sujeito à mudanças. Thiago
  $data['arrays'] = '';
  if(filter_input(INPUT_POST, 'add')){
          $src = $_FILES['arquivo']['tmp_name'];
          $name = $_FILES['arquivo']['name'];
          if($src){

            //echo '<pre>';var_dump($src);echo '</pre>';die;

            $handle = fopen($src, 'r');
            $content = fread($handle,filesize($src));

            //echo ($content);die;

            $linhas = explode(" ",$content)[0];
            $linhas = explode("\n",$content);

            $barcode_errado = array();
            $barcode_certo = array();
            $barcode_atualizado = array();

            $barcode_array = $this->model->getAllBarcodes();
            // echo '<pre>';print_r($barcode_array);echo '</pre>';die;

            foreach ($linhas as $row){
              $divisao = explode("|",$row);

              $codigo = $divisao[0];

              if($codigo === 'P'){
                $barcode = $divisao[3];
                $preco = $divisao[4];
                $estoque = $divisao[7];

                $preco = ltrim($preco, '0');
                $preco = (int)$preco;
                $preco = number_format($preco/100,2,'.','');

                $verificacao = $this->model->updateByTxt($barcode,$preco,$estoque,$barcode_array);

                if($verificacao[0] == 1){
                  array_push($barcode_certo, $verificacao[1]);
                }elseif($verificacao[0] == 3){
                  array_push($barcode_errado, $verificacao[1]);
                }elseif($verificacao[0] == 2){
                  array_push($barcode_atualizado, $verificacao[1]);
                }
              }
              $data['arrays'] = array($barcode_certo,$barcode_errado);
            }
            //echo '<pre>';var_dump($barcode_certo);echo '</pre><br>';
            //echo '<pre>';var_dump($barcode_errado);echo '</pre>';
            //echo '<pre>';var_dump($barcode_atualizado);echo '</pre>';die;


          }else{
              $data['msg'] = 'Informe todos os campos';
          }
      }

  $this->view->load('header');
  $this->view->load('nav');
  $this->view->load('upload',$data['arrays']);
  $this->view->load('footer');
}

  public function deleteSliderBySubId($id){ // DELETAR SLIDER ATRAVES DO ID DO SUBGRUPO

    $data['slider'] = $this->modelSlider->getSliderBySubId($id);


    if (filter_input(INPUT_POST, 'del')) {
      $this->modelSlider->removeSlider($id);
      $this->index();
      return true;
    }

    $this->view->load('header');
    $this->view->load('nav');
    $this->view->load('del-slider',$data['slider']);
    $this->view->load('footer');
  }

  public function addSlider($id){ // DELETAR SLIDER ATRAVES DO ID DO SUBGRUPO
    $data['msg'] = '';
    $data['sub'] = $this->modelSubgrupo->getSubgrupoById($id);

    if (filter_input(INPUT_POST, 'add')) {
          $nome = $data['sub']->getNome();
          $imagem = filter_input(INPUT_POST, 'imagem', FILTER_SANITIZE_STRING);
          $fundo = filter_input(INPUT_POST, 'fundo', FILTER_SANITIZE_STRING);
          $descricao = $data['sub']->getDescricao();

          if ($nome && $descricao) {
              $slider = new Slider(0,$data['sub']->getId_subgrupo(), $imagem, $fundo, 1);
              if ($this->modelSlider->insertSlider($slider)) {
                   $data['msg'] = 'Adicionado com Sucesso!';
                   $this->index();
                   die;
              } else {
                  $data['msg'] = 'Erro!';
                  }
          }
      }

    $this->view->load('header');
    $this->view->load('nav');
    $this->view->load('add-slider',$data);
    $this->view->load('footer');
  }

  public function deleteDestaqueProd($id){ // DELETAR subgrupo destacado com o id do subgrupo . Edu
      $this->modelSubgrupo->removeDestaque($id);
      $this->viewSubOf($id);
  }

  public function addDestaqueProd($id){ // Adicionar Destaque ao subgrupo que veio o id. Edu
    $this->modelSubgrupo->addDestaque($id);
    $this->viewSubOf($id);
    }







    // A partir daqui é a segunda parte do projeto. Dia 31/07/2019.

    public function importaProdutosRP(){
      if(filter_input(INPUT_POST, 'add')){
              $src = $_FILES['arquivo']['tmp_name'];
              $name = $_FILES['arquivo']['name'];
              if($src){

                $handle = fopen($src, 'r'); //LEITURA DO ARQUIVO
                $content = fread($handle,filesize($src)); // NÃO SEI, MAS FUNCIONA
                $linhas = explode(" ",$content)[0];
                $linhas = explode("\n",$content); // EXPLODE AS LINHAS E COLOCA ELAS EM ARRAY $linhas

                $barcode_errado = array(); // ISSO É PRA NOTIFICAR CADASTROS QUE DERAM ERRADO
                $barcode_certo = array(); // ISSO É PRA NOTIFICAR CADASTROS QUE DERAM CERTO (NÃO MUITO ÚTIL)
                $barcode_atualizado = array();

                $barcode_array = $this->model->getAllBarcodes(); // PEGA TODOS OS BARCODES PR VER SE ALGUM DELES JA EXISTE (array normal)
                $marcas_array = $this->modelMarca->getAllMarcas(); // PEGA TODOS OS ID E NOMES DE MARCAS PRA FAZER AQUELA COMPARACAO (array de array)
                $categorias_array = $this->modelCategoria->getAllCategorias(); // PEGA TODOS OS ID E NOMES DE CATEGORIAS PRA FAZER AQUELA COMPARACAO (array de array)
                $grupos_array = $this->modelGrupo->getAllGrupos();
                $subgrupos_array = $this->modelSubgrupo->getAllSubgrupos();
                $i = 0;

                set_time_limit(0);
                foreach ($linhas as $row){
                  echo $i++;
                  $divisao = explode("\t",$row); // SEPARA TODOS OS DADOS EM UM ARRAY

                  $categoria = $this->tratamentoCategoria($divisao[7],$categorias_array); // ARRUMA E SUBSTITUI O NOME DA MARCA PELO ID DA MESMA
                  $grupo = $this->tratamentoGrupo($divisao[5],$categoria[0],$divisao[7],$grupos_array,$categorias_array); // ARRUMA E SUBSTITUI O NOME DA MARCA PELO ID DA MESMA
                  $subgrupo = $this->tratamentoSubrupo($divisao[6],$grupo[0],$subgrupos_array); // ARRUMA E SUBSTITUI O NOME DA MARCA PELO ID DA MESMA
                  $marca = $this->tratamentoMarca($divisao[4],$marcas_array); // ARRUMA E SUBSTITUI O NOME DA MARCA PELO ID DA MESMA
                  $estoque = $this->tratamentoEstoque($divisao[3]); // ARRUMA E SUBSTITUI O NOME DA MARCA PELO ID DA MESMA
                  $preco = $this->tratamentoPreco($divisao[2]); // ARRUMA E SUBSTITUI O NOME DA MARCA PELO ID DA MESMA

                  $divisao[4] = $marca[0]; // TROCANDO NOME DA MARCA PELO ID
                  $divisao[7] = $categoria[0]; // TROCANDO NOME DA CATEGORIA PELO ID
                  $divisao[2] = $preco; // FLOATANDO O preco
                  $divisao[3] = $estoque; // INTANDO O estoque
                  $divisao[5] = $grupo[0]; // TROCANDO NOME DO GRUPO PELO ID
                  $divisao[6] = $subgrupo[0]; // TROCANDO NOME DO GRUPO PELO ID

                  //echo '<pre>';print_r($marca[0][0][]);echo '</pre>';

                  echo '<pre>';print_r($divisao);echo '</pre>';

                  // ADICIONAR PRODUTO AO BANCO
                  $verificacao = $this->model->insertByTxt($divisao[0],$divisao[2],$divisao[3],$divisao[1],$divisao[6],$divisao[4],$barcode_array);

                  if($verificacao[0] == 1){
                    array_push($barcode_certo, $verificacao[1]);
                  }elseif($verificacao[0] == 3){
                    array_push($barcode_errado, $verificacao[1]);
                  }elseif($verificacao[0] == 2){
                    array_push($barcode_atualizado, $verificacao[1]);
                  }

                  // ATUALIZAR OS ARRAYS COM OS DADOS QUE VÃO ENTRANDO
                  if($marca[1]){
                    $marcas_array = $this->modelMarca->getAllMarcas();
                  }
                  if($categoria[1]){
                    $categorias_array = $this->modelCategoria->getAllCategorias();
                  }
                   if($grupo[1]){
                     $grupos_array = $this->modelGrupo->getAllGrupos();
                   }
                   if($subgrupo[1]){
                     $subgrupos_array = $this->modelSubgrupo->getAllSubgrupos();
                   }

                }
                $data['arrays'] = array($barcode_certo,$barcode_errado);
                set_time_limit(30);
                die;

              }else{
                  $data['msg'] = 'Informe todos os campos';
              }
          }

      $this->view->load('header');
      $this->view->load('nav');
      $this->view->load('importa');
      $this->view->load('footer');
    }



    private function tratamentoMarca($marca,$array){

      $marca = iconv(mb_detect_encoding($marca, mb_detect_order(), true), "UTF-8//IGNORE", ucfirst(strtolower(($marca)))); // Como no .txt a marca é toda maiúscula, eu fiz isso pra q a primeira fosse maiuscula e as outras nao.

      foreach ($array as $pica) {
        if(trim($marca) == trim(iconv(mb_detect_encoding($pica[1], mb_detect_order(), true), "UTF-8//IGNORE", ucfirst(strtolower(($pica[1])))))) { // EU NAO SEI PRA Q CARALHO SERVE ESSE TRIM MAS O IF NAO FUNCIONA SEM ELE
          $id_marca = $pica[0]; //PEGA O ID DA MARCA Q ELE ENCONTROU
          $bool = true;
          break;
        }else{
          $bool = false;
        }
      }

      //RETORNA VALOR CORRIGIDO DO ID DA MARCA
      if($bool){
        return [$id_marca,false];

      }else{
        $this->modelMarca->insertMarcaTxt($marca);
        return [$this->modelMarca->getIdByNome($marca),true]; //ESSES TRUE OU FALSE SERVEM PRA ATUALIZAR O ARRAY, SENAO DA UM DESENCONTRO DE DADOS ATUALIZADOS/ANTIGOS
      }
    }

    private function tratamentoCategoria($categoria,$array){

      $categoria = iconv(mb_detect_encoding($categoria, mb_detect_order(), true), "UTF-8//IGNORE", ucfirst(strtolower(($categoria)))); // Como no .txt a marca é toda maiúscula, eu fiz isso pra q a primeira fosse maiuscula e as outras nao.

      foreach ($array as $pica) {
        if(trim(($categoria)) == trim(iconv(mb_detect_encoding($pica[1], mb_detect_order(), true), "UTF-8//IGNORE", ucfirst(strtolower(($pica[1])))))) { // EU NAO SEI PRA Q CARALHO SERVE ESSE TRIM MAS O IF NAO FUNCIONA SEM ELE
          $id_categoria = $pica[0]; //PEGA O ID DA categoria Q ELE ENCONTROU
          $bool = true;
          break;
        }else{
          $bool = false;
        }
      }

      //RETORNA VALOR CORRIGIDO DO ID DA categoria
      if($bool){

        return [$id_categoria,false];

      }else{
        $this->modelCategoria->insertCategoriaTxt($categoria);
        return [$this->modelCategoria->getIdByNome($categoria),true];//ESSES TRUE OU FALSE SERVEM PRA ATUALIZAR O ARRAY, SENAO DA UM DESENCONTRO DE DADOS ATUALIZADOS/ANTIGOS
      }
    }

    private function tratamentoGrupo($grupo,$id_categoria,$array){

      $grupo = iconv(mb_detect_encoding($grupo, mb_detect_order(), true), "UTF-8//IGNORE", ucfirst(strtolower(($grupo)))); // Como no .txt a marca é toda maiúscula, eu fiz isso pra q a primeira fosse maiuscula e as outras nao.

        $bool = 0;
        foreach ($array as $pica) {

          if(trim(($grupo)) == trim(iconv(mb_detect_encoding($pica[1], mb_detect_order(), true), "UTF-8//IGNORE", ucfirst(strtolower(($pica[1])))))) { // EU NAO SEI PRA Q CARALHO SERVE ESSE TRIM MAS O IF NAO FUNCIONA SEM ELE
            $id_grupo = $pica[0]; //PEGA O ID DA categoria Q ELE ENCONTROU
            $bool = true;
            break;
          }else{
            $bool = false;
          }
        }
        
        if($bool){
          return [$id_grupo,false];

        }else{
          $this->modelGrupo->insertGrupoTxt($grupo,$id_categoria);
          return [$this->modelGrupo->getIdByNome($grupo),true];//ESSES TRUE OU FALSE SERVEM PRA ATUALIZAR O ARRAY, SENAO DA UM DESENCONTRO DE DADOS ATUALIZADOS/ANTIGOS
        }


    }

    private function tratamentoSubrupo($subgrupo,$id_grupo,$array){

      $subgrupo = iconv(mb_detect_encoding($subgrupo, mb_detect_order(), true), "UTF-8//IGNORE", ucfirst(strtolower(($subgrupo)))); // Como no .txt a marca é toda maiúscula, eu fiz isso pra q a primeira fosse maiuscula e as outras nao.

      $bool = 0;
      foreach ($array as $pica) {
        if(trim(($subgrupo)) == trim(iconv(mb_detect_encoding($pica[1], mb_detect_order(), true), "UTF-8//IGNORE", ucfirst(strtolower(($pica[1])))))) { // EU NAO SEI PRA Q CARALHO SERVE ESSE TRIM MAS O IF NAO FUNCIONA SEM ELE
          $id_subgrupo = $pica[0]; //PEGA O ID DA categoria Q ELE ENCONTROU
          $bool = true;
          break;
        }else{
          $bool = false;
        }
      }

      //RETORNA VALOR CORRIGIDO DO ID DA categoria
      if($bool){
        return [$id_subgrupo,false];

      }else{
        $this->modelSubgrupo->insertSubgrupoTxt($subgrupo,$id_grupo);
        return [$this->modelSubgrupo->getIdByNome($subgrupo),true];//ESSES TRUE OU FALSE SERVEM PRA ATUALIZAR O ARRAY, SENAO DA UM DESENCONTRO DE DADOS ATUALIZADOS/ANTIGOS
      }
    }

    private function tratamentoPreco($preco){
      $preco = str_replace(',', '.', $preco);
      $preco = floatval ($preco);
      return $preco;
    }

    private function tratamentoEstoque($estoque){
      $estoque = intval ($estoque);
      return $estoque;
    }


}
