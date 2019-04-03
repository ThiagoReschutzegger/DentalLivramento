<?php
class Home extends Controller{

    protected $model;
    protected $modelproduto;
    protected $modelCategoria;
    protected $modelGrupo;
    protected $modelDestaque;
    protected $modelSlider;
    protected $modelMarca;
    protected $modelPackproduto;
    protected $carrinho;
    protected $login;

    public function __construct() {
        parent::__construct();
        $this->model = new HomeAdminModel();
        $this->modelproduto = new ProdutoModel();
        $this->modelCategoria = new CategoriaModel();
        $this->modelGrupo = new GrupoModel();
        $this->modelDestaque = new DestaqueModel();
        $this->modelSlider = new SliderModel();
        $this->modelMarca = new MarcaModel();
        $this->modelPackproduto = new PackprodutoModel();
        $this->login = new Login();
        // session_destroy();die;
        if(isset($_SESSION['carrinho'])){
            $this->carrinho = $_SESSION['carrinho'];
        }
        //echo "<pre>";var_dump($_SESSION['carrinho']);echo "</pre>";
    }

    public function index(){
        $data['estilo'] = $this->model->getEstiloAtual();
        $data['categoria'] = $this->modelCategoria->getCategoria();
        $data['grupo'] = $this->modelGrupo->getGrupo();
        $data['destaque'] = $this->modelDestaque->getDestaque();
        $data['slider'] = $this->modelSlider->getSlider();
        $data['marca'] = $this->modelMarca->getMarca();
        $data['itens'] = '';

        if(isset($_SESSION['carrinho'])){
          $list = [];
            foreach($_SESSION['carrinho'] as $item){
              $list[] = array($this->modelPackproduto->getPackprodutoById($item->getId_produto()),$item->getQuantidade());

            }

            $data['itens'] = $list;

        }

        $this->view->load('header',$data);
        $this->view->load('nav-home',$data);
        $this->view->load('index', $data);
        $this->view->load('footer');

    }

    public function viewProduto($id){ //Edu
        $data['estilo'] = $this->model->getEstiloAtual();
        $data['packproduto'] = $this->modelPackproduto->getPackprodutoBySubgrupo($id);
        $pkpd = $data['packproduto'][0];
        $data['grupo'] = $this->modelGrupo->getGrupoById($pkpd->getId_grupo());
        $data['categoria'] = $this->modelCategoria->getCategoriaById($data['grupo']->getId_categoria());
        $data['marca'] = $this->modelMarca->getMarcaById($pkpd->getId_marca());

        $preco_aux = [];
        $estoque_aux = [];
        $id_aux = [];
        foreach ($data['packproduto'] as $produtos){
          $preco_aux[] = number_format((float)$produtos->getPreco(), 2);
          $estoque_aux[] = $produtos->getEstoque();
          $id_aux[] = $produtos->getId_produto();
        }
        $data['preco-ate'] = min($preco_aux);
        $estoque_total = array_sum($estoque_aux);
        if($estoque_total > 50){
          $data['estoque-msg'] = 'color: #49c32c; border: 1px solid #49c32c;">Em estoque';
        }else if($estoque_total < 51 && $estoque_total > 25){
          $data['estoque-msg'] = 'color: #eabf38; border: 1px solid #eabf38;">Poucas unidades';
        }else if($estoque_total < 26){
          $data['estoque-msg'] = 'color: #f55c5d; border: 1px solid #f55c5d;">Últimas unidades';
        }
        $cart = [];
        $valor_carrinho = 0;
        if (filter_input(INPUT_POST, 'add')) {
          foreach($id_aux as $linha){
            if(filter_input(INPUT_POST, 'espec'.$linha, FILTER_SANITIZE_STRING) > 0){

              $quantidade = filter_input(INPUT_POST, 'espec'.$linha, FILTER_SANITIZE_STRING); //qtd das especializações que forem > 0
              $id_itens = $linha; //id_produto das especializações selecionadas
              $preco_unitario = $this->modelproduto->getPrecoByProdutoId($id_itens);
              // echo $preco_unitario;
              $preco_total = $quantidade * $preco_unitario;

              array_push($cart,new ItemCarrinho($id_itens,$quantidade,$preco_total));

            }
          }
          //echo "<pre>";var_dump($_SESSION['carrinho']);echo "</pre>";
          if(isset($_SESSION['carrinho'])){
            foreach($cart as $seila){
              array_push($_SESSION['carrinho'],$seila);
            }
          }else{
            $this->login->createSessionCarrinho();
            $_SESSION['carrinho'] = [];
            foreach($cart as $seila){
              array_push($_SESSION['carrinho'],$seila);
            }
          }
        }

        $this->view->load('header',$data);
        $this->view->load('nav',$data);
        $this->view->load('single-product',$data); //single-product2
        $this->view->load('footer');
    }

    public function viewCart($deletar = -1){ //Edu
        $data['estilo'] = $this->model->getEstiloAtual();
        $data['categoria'] = $this->modelCategoria->getCategoria();
        $data['grupo'] = $this->modelGrupo->getGrupo();
        $data['destaque'] = $this->modelDestaque->getDestaque();
        $data['slider'] = $this->modelSlider->getSlider();
        $data['marca'] = $this->modelMarca->getMarca();
        $data['itens'] = '';

        if(isset($_SESSION['carrinho'])){
          $list = [];
            foreach($_SESSION['carrinho'] as $item){
              $list[] = array($this->modelPackproduto->getPackprodutoById($item->getId_produto()),$item->getQuantidade());
            }

            $data['itens'] = $list;
            //echo "<pre>";var_dump($data['itens']);echo "</pre>";die;
        }

        if($deletar != -1){
          $string = explode(".",$deletar);
          $index = $string[1];
          if(count($_SESSION['carrinho'])==1){
            session_destroy();
          }
          array_splice($_SESSION['carrinho'], $index, 1);
          //echo "<pre>";var_dump($_SESSION['carrinho']);echo "</pre>";die;
          header('location:' . $this->config->base_url . 'Home/viewCart');
        }

        $this->view->load('header',$data);
        $this->view->load('nav',$data);
        $this->view->load('cart', $data);
        $this->view->load('footer');
    }

    public function step1(){ //Edu
        $data['estilo'] = $this->model->getEstiloAtual();
        $data['categoria'] = $this->modelCategoria->getCategoria();
        $data['grupo'] = $this->modelGrupo->getGrupo();
        $data['destaque'] = $this->modelDestaque->getDestaque();
        $data['slider'] = $this->modelSlider->getSlider();
        $data['marca'] = $this->modelMarca->getMarca();
        $data['itens'] = '';

        if(isset($_SESSION['carrinho'])){
          $list = [];
            foreach($_SESSION['carrinho'] as $item){
              $list[] = array($this->modelPackproduto->getPackprodutoById($item->getId_produto()),$item->getQuantidade());
            }

            $data['itens'] = $list;
            //echo "<pre>";var_dump($data['itens']);echo "</pre>";die;
        }

        if (filter_input(INPUT_POST, 'add')) {
          header('location:' . $this->config->base_url . 'Home/step2');
        }

        $this->view->load('header',$data);
        $this->view->load('nav',$data);
        $this->view->load('step-1', $data);
        $this->view->load('footer');
    }

    public function step2(){ //Edu
        $data['estilo'] = $this->model->getEstiloAtual();
        $data['categoria'] = $this->modelCategoria->getCategoria();
        $data['grupo'] = $this->modelGrupo->getGrupo();
        $data['destaque'] = $this->modelDestaque->getDestaque();
        $data['slider'] = $this->modelSlider->getSlider();
        $data['marca'] = $this->modelMarca->getMarca();
        $data['itens'] = '';

        if(isset($_SESSION['carrinho'])){
          $list = [];
            foreach($_SESSION['carrinho'] as $item){
              $list[] = array($this->modelPackproduto->getPackprodutoById($item->getId_produto()),$item->getQuantidade());
            }

            $data['itens'] = $list;
            //echo "<pre>";var_dump($data['itens']);echo "</pre>";die;
        }

        $this->view->load('header',$data);
        $this->view->load('nav',$data);
        $this->view->load('step-2', $data);
        $this->view->load('footer');
    }

    public function step3(){ //Edu
        $data['estilo'] = $this->model->getEstiloAtual();

        $this->view->load('header',$data);
        $this->view->load('nav',$data);
        $this->view->load('step-3', $data);
        $this->view->load('footer');
    }

}
