<?php
class Loja extends Controller{

    protected $model;
    protected $modelproduto;
    protected $modelCategoria;
    protected $modelGrupo;
    protected $modelDestaque;
    protected $modelSlider;
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
        $this->modelDestaque = new DestaqueModel();
        $this->modelSlider = new SliderModel();
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
    
    public function viewSub($id_grupo){
        $data['estilo'] = $this->model->getEstiloAtual();
        $data['grupo'] = $this->modelGrupo->getGrupo();
        $data['grupo-atual'] = $this->modelGrupo->getGrupoById($id_grupo);
        $data['categoria'] = $this->modelCategoria->getCategoria();
        $data['categoria-atual'] = $this->modelCategoria->getCategoriaByGrupoId($id_grupo);
        $data['subgrupo'] = $this->modelSubgrupo->getSubgrupoByGrupo($id_grupo);
        
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
        $data['grupo-atual'] = $this->modelGrupo->getGrupoById($data['subgrupo']->getId_grupo());
        $data['categoria'] = $this->modelCategoria->getCategoria();
        $data['categoria-atual'] = $this->modelCategoria->getCategoriaByGrupoId($data['subgrupo']->getId_grupo());
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
        $data['produto_precos'] = $this->modelproduto->getProdutosBySubgrupoIdComOrdem($id_subgrupo);
        foreach($data['produto_precos'] as $produto):
            if(empty($data['preco_min'.$produto->getId_marca()])){
                $data['preco_min'.$produto->getId_marca()] = $produto->getPreco();
            }
            if($data['preco_min'.$produto->getId_marca()] > $produto->getPreco()){
                $data['preco_min'.$produto->getId_marca()] = $produto->getPreco();
            }
            if(!in_array($produto->getId_marca(), $ids_marca)){
                $ids_marca[] = $produto->getId_marca();
            }
        endforeach;
        
        if($data['ordem'] == "menor"){
            $data['ordem_precos'] = $ids_marca; //para ordenar os itens em maior ou menor preço, sendo a ordem do array os ids das marcas a serem exibidas do maior ao menor, caso contrario inverter o array na exibição;
        }
        if($data['ordem'] == "maior"){
            $data['ordem_precos'] = array_reverse($ids_marca); //para ordenar os itens em maior ou menor preço, sendo a ordem do array os ids das marcas a serem exibidas do maior ao menor, caso contrario inverter o array na exibição;
        }
        
        $data['marca'] = $this->modelMarca->getMarcaByIds($ids_marca);
        
        if (filter_input(INPUT_POST, 'enviar-msg')) {
          $email = filter_input(INPUT_POST, 'email-msg', FILTER_SANITIZE_STRING);
          $msg = filter_input(INPUT_POST, 'mensagem-msg', FILTER_SANITIZE_STRING);
          $this->father->addMensagem($email, $msg);
          return true;
        }

        $this->view->load('header',$data);
        $this->view->load('nav',$data);
        $this->view->load('shopping', $data);
        $this->view->load('footer');
    }

    public function search(){ //Edu
      $data['preloader'] = '1';
      $data['estilo'] = $this->model->getEstiloAtual();
      $data['grupo'] = $this->modelGrupo->getGrupo();
      $data['categoria'] = $this->modelCategoria->getCategoria();
      $data['itens'] = $this->father->getList();
      $data['modelo'] = '';
      $data['texto'] = '';

      if (filter_input(INPUT_POST, 'pesquisar')) {
        $texto = filter_input(INPUT_POST, 'texto-psq', FILTER_SANITIZE_STRING);
        $string = $texto;
        $pass = false;
        while ($string){
            if ($this->modelSubgrupo->searchSubgrupoForDefault($string)) { // Pesquisa de subgrupo, ou seja o nome do produto
              $data['subgrupo'] = $this->modelSubgrupo->searchSubgrupoForDefault($string);
              $data['texto'] = $texto;
              $data['modelo'] = "SearchDeSubgrupo";
              $pass = true;
              $string = false;
            }else{
                $string = substr_replace($string ,"", -1);
                if (strlen($string) < 4) $string = false; // caso fique uma string muito pequena para comparar aos nomes dos subgrupos
            }
        }
        if(!$pass && $this->modelproduto->searchProdutoForDefault($texto)) { // Pesquisa de produto, ou seja as especificações e exibe item, como na this->view
            $data['produto'] = $this->modelproduto->searchProdutoForDefault($texto);
            $data['subgrupo'] = $this->modelSubgrupo->getSubgrupoById($data['produto'][0]->getId_subgrupo());
            $data['texto'] = $texto;
            $data['modelo'] = "SearchDeProduto";
            $pass = true;
            
            $ids_marca = [];
            foreach($data['produto'] as $produto):
                if($produto->getId_subgrupo() != $data['subgrupo']->getId_subgrupo()) continue;
                if(empty($data['preco_min'.$produto->getId_marca()])){
                    $data['preco_min'.$produto->getId_marca()] = $produto->getPreco();
                }
                if($data['preco_min'.$produto->getId_marca()] > $produto->getPreco()){
                    $data['preco_min'.$produto->getId_marca()] = $produto->getPreco();
                }
                if(!in_array($produto->getId_marca(), $ids_marca)){
                    $ids_marca[] = $produto->getId_marca();
                }
            endforeach;
            $data['marca'] = $this->modelMarca->getMarcaByIds($ids_marca);
            $data['item'] = $this->modelItem->getItemByIds($data['subgrupo']->getId_subgrupo(), $ids_marca);
            
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
