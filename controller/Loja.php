<?php
class Loja extends Controller{

    protected $model;
    protected $modelproduto;
    protected $modelCategoria;
    protected $modelGrupo;
    protected $modelMarca;
    protected $modelSubgrupo;
    protected $modelItem;
    protected $modelPackproduto;
    protected $modelCarrinho;
    protected $modelPedido;
    protected $carrinho;
    protected $login;
    protected $father;

    public function __construct() {
        parent::__construct();
        $this->model = new HomeAdminModel();
        $this->modelproduto = new ProdutoModel();
        $this->modelCategoria = new CategoriaModel();
        $this->modelGrupo = new GrupoModel();

        //$this->modelDestaque = new DestaqueModel();
        //$this->modelSlider = new SliderModel();
        $this->modelMarca = new MarcaModel();
        $this->modelSubgrupo = new SubgrupoModel();
        $this->modelItem = new ItemModel();
        $this->modelCarrinho = new CarrinhoModel();
        $this->modelPedido = new PedidoModel();
        $this->modelPackproduto = new PackprodutoModel();
        $this->modelItemcarrinho = new ItemcarrinhoModel();
        $this->login = new Login();
        $this->father = new Home();
        // session_destroy();die;
        if(isset($_SESSION['carrinho'])){
            $this->carrinho = $_SESSION['carrinho'];
        }
        //echo "<pre>";var_dump($_SESSION['carrinho']);echo "</pre>";
    }

    public function index(){
      header('location:' . $this->config->base_url);
    }

    public function viewGrupo($id_categoria){
        $data['estilo'] = $this->model->getEstiloAtual();
        $data['subgrupo-nav'] = $this->modelSubgrupo->getSubgrupo();
        $data['categoria-dstq'] = $this->modelCategoria->getCategoriaDestaque();
        $data['grupo'] = $this->modelGrupo->getGrupoByCategoriaId($id_categoria);
        $data['categoria-atual'] = $this->modelCategoria->getCategoriaById($id_categoria);
        $data['categoria'] = $this->modelCategoria->getCategoria();
        $data['itens'] = $this->father->getList();

        $this->view->load('header',$data);
        $this->view->load('nav',$data);
        $this->view->load('shopping_grupo', $data);
        $this->view->load('footer');
    }

    public function viewSub($id_grupo){
        $data['estilo'] = $this->model->getEstiloAtual();
        $data['grupo'] = $this->modelGrupo->getGrupo();
        $data['subgrupo-nav'] = $this->modelSubgrupo->getSubgrupo();
        $data['categoria-dstq'] = $this->modelCategoria->getCategoriaDestaque();
        $data['grupo-atual'] = $this->modelGrupo->getGrupoById($id_grupo);
        $data['categoria'] = $this->modelCategoria->getCategoria();
        $data['categoria-atual'] = $this->modelCategoria->getCategoriaByGrupoId($id_grupo);
        $data['subgrupo'] = $this->modelSubgrupo->getSubgrupoByGrupo($id_grupo);
        $data['itens'] = $this->father->getList();

        $data['total-sub'] = count($data['subgrupo']);


        $this->view->load('header',$data);
        $this->view->load('nav',$data);
        $this->view->load('shopping_subs', $data);
        $this->view->load('footer');
    }

    public function view($id_subgrupo){ //Edu

      if($id_subgrupo == null) header('location:' . $this->config->base_url); //contra espetinhos

        $data['estilo'] = $this->model->getEstiloAtual();
        $data['subgrupo'] = $this->modelSubgrupo->getSubgrupoById($id_subgrupo);
        $data['grupo'] = $this->modelGrupo->getGrupo();
        $data['subgrupo-nav'] = $this->modelSubgrupo->getSubgrupo();
        $data['categoria-dstq'] = $this->modelCategoria->getCategoriaDestaque();
        $data['grupo-atual'] = $this->modelGrupo->getGrupoById($data['subgrupo']->getId_grupo());
        $data['categoria'] = $this->modelCategoria->getCategoria();
        $data['categoria-atual'] = $this->modelCategoria->getCategoriaByGrupoId($data['subgrupo']->getId_grupo());
        $data['subgrupo-in-cat'] = $this->modelSubgrupo->getSubgrupoByCategoriaId($data['categoria-atual'][0]->getId_categoria());
        $data['itens'] = $this->father->getList();

        if (filter_input(INPUT_POST, 'filter')) {

            $ordem = filter_input(INPUT_POST, 'guiest_id1', FILTER_SANITIZE_STRING);

            $data['item'] = $this->modelItem->getItemBySubgrupo($id_subgrupo);
            $data['ordem'] = $ordem;

        }else {

            $data['item'] = $this->modelItem->getItemBySubgrupo($id_subgrupo);
            $data['ordem'] = "new";
        }

        $data['produto'] = $this->modelproduto->getProdutosBySubgrupoId($id_subgrupo);
        $data['total_prod'] = count($data['item']);

        $ids_marca = [];
        $array = []; //array da ordem dos produtos (id marca-tipo) de maior a menor
        $data['produto_precos'] = $this->modelproduto->getProdutosBySubgrupoIdComOrdem($id_subgrupo);
        foreach($data['produto_precos'] as $produto):
            if(empty($data['preco_min'.$produto->getId_marca()."-".$produto->getTipo()])){
                $data['preco_min'.$produto->getId_marca()."-".$produto->getTipo()] = $produto->getPreco();
                $array[] = $produto->getId_marca()."-".$produto->getTipo();
            }
            if($data['preco_min'.$produto->getId_marca()."-".$produto->getTipo()] > $produto->getPreco()){
                $data['preco_min'.$produto->getId_marca()."-".$produto->getTipo()] = $produto->getPreco();
                $del_val = $produto->getId_marca()."-".$produto->getTipo();
                $key = array_search($del_val, $array);
                unset($array[$key]);
                $array[] = $produto->getId_marca()."-".$produto->getTipo();
            }
            if(!in_array($produto->getId_marca(), $ids_marca)){
                $ids_marca[] = $produto->getId_marca();
            }



        endforeach;

        if($data['ordem'] == "menor"){
            $data['ordem_precos'] = $array; //para ordenar os itens em maior ou menor preço, sendo a ordem do array os ids das marcas a serem exibidas do maior ao menor, caso contrario inverter o array na exibição;
        }
        if($data['ordem'] == "maior"){
            $data['ordem_precos'] = array_reverse($array); //para ordenar os itens em maior ou menor preço, sendo a ordem do array os ids das marcas a serem exibidas do maior ao menor, caso contrario inverter o array na exibição;
        }

        $data['marca'] = $this->modelMarca->getMarcaByIds($ids_marca);

        if (filter_input(INPUT_POST, 'enviar-msg')) {
          $email = filter_input(INPUT_POST, 'email-msg', FILTER_SANITIZE_STRING);
          $msg = filter_input(INPUT_POST, 'mensagem-msg', FILTER_SANITIZE_STRING);
          $this->father->addMensagem($email, $msg);
          return true;
        }
        
        $data['total-prod'] = count($data['item']);

        $this->view->load('header',$data);
        $this->view->load('nav',$data);
        $this->view->load('shopping', $data);
        $this->view->load('footer');
    }

    public function search(){ //Edu
      $data['preloader'] = '1';
      $data['estilo'] = $this->model->getEstiloAtual();
      $data['grupo'] = $this->modelGrupo->getGrupo();
    $data['subgrupo-nav'] = $this->modelSubgrupo->getSubgrupo();
    $data['categoria-dstq'] = $this->modelCategoria->getCategoriaDestaque();
      $data['categoria'] = $this->modelCategoria->getCategoria();
      $data['itens'] = $this->father->getList();
      $data['modelo'] = '';
      $data['texto'] = '';

      if (filter_input(INPUT_POST, 'go')) {
        $texto = filter_input(INPUT_POST, 'pesquisa', FILTER_SANITIZE_STRING);
        $string = $texto;
        $pass = false;
        while ($string){
            if ($this->modelSubgrupo->searchSubgrupoForDefault($string)) { // Pesquisa de subgrupo, ou seja o nome do produto
              $data['subgrupo'] = $this->modelSubgrupo->searchSubgrupoForDefault($string);
              $data['texto'] = $texto;
              $data['modelo'] = "SearchDeSubgrupo";
              
              foreach($data['subgrupo'] as $subgrupo):
                $grupo = $this->modelGrupo->getGrupoById($subgrupo->getId_grupo());
                $data['nome-grupo'.$subgrupo->getId_subgrupo()] = $grupo->getNome();
              endforeach;
              
              $pass = true;
              $string = false;
            }else{
                $string = substr_replace($string ,"", -1);
                if (strlen($string) < 4) $string = false; // caso fique uma string muito pequena para comparar aos nomes dos subgrupos
            }
        }
        if($this->modelproduto->searchProduto2($texto) && !$pass) { // Pesquisa de produto, ou seja as especificações e exibe item, como na this->view
            
            $data['produto'] = $this->modelproduto->searchProduto2($texto);
            $data['texto'] = $texto;
            $data['modelo'] = "SearchDeProduto";
            $pass = true;
            
            $ids_marca = [];
            $data['item'] = [];
            foreach($data['produto'] as $produto):
                $item = $this->modelItem->getItemBy($produto->getId_subgrupo(),$produto->getId_marca(),$produto->getTipo());
                $data['item'][] = $item;
                if(empty($data['preco_min'.$item->getId_item()])){
                    $data['preco_min'.$item->getId_item()] = $produto->getPreco();
                }
                if($data['preco_min'.$item->getId_item()] > $produto->getPreco()){
                    $data['preco_min'.$item->getId_item()] = $produto->getPreco();
                }
                if(empty($data['nome-sub'.$item->getId_item()])){
                    $subgrupo = $this->modelSubgrupo->getSubgrupoById($item->getId_subgrupo());
                    $data['nome-sub'.$item->getId_item()] = $subgrupo->getNome();
                }
                if(!in_array($produto->getId_marca(), $ids_marca)){
                     $ids_marca[] = $produto->getId_marca();
                } 
            endforeach;
            $data['marca'] = $this->modelMarca->getMarcaByIds($ids_marca);
            

//            echo "<pre>";
//            var_dump($data['produto']);
//            echo "</pre>";
//            die;

        }elseif(!$pass){ // se nao achar nada
          $data['modelo'] = '';
          $data['texto'] = $texto;
        }
      }


      //echo '<pre>'; var_dump($data); echo '</pre>'; die;

      $this->view->load('header',$data);
      $this->view->load('nav',$data);
      $this->view->load('pesquisa', $data);
      $this->view->load('footer');
      $data['preloader'] = null;
    }

}
