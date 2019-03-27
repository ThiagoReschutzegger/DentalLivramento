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
        if(isset($_SESSION['carrinho'])){
            $this->carrinho = $_SESSION['carrinho'];
        }
    }

    public function index(){
        $data['estilo'] = $this->model->getEstiloAtual();
        $data['categoria'] = $this->modelCategoria->getCategoria();
        $data['grupo'] = $this->modelGrupo->getGrupo();
        $data['destaque'] = $this->modelDestaque->getDestaque();
        $data['slider'] = $this->modelSlider->getSlider();
        $data['marca'] = $this->modelMarca->getMarca();

        // echo "<pre>";
        // var_dump($data['marca']);
        // echo "</pre>";
        // die;

        echo "<pre>";var_dump($_SESSION['carrinho']);echo "</pre>";

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

        $quantidade = [];
        $id_itens = [];
        $carrinho = [];
        $tem_algo_no_cart = false;

        if (filter_input(INPUT_POST, 'add')) {
          foreach($id_aux as $linha){
            if(filter_input(INPUT_POST, 'espec'.$linha, FILTER_SANITIZE_STRING) > 0){

              //$carrinho[] = new ItemCarrinho($id_itens[],filter_input(INPUT_POST, 'espec'.$linha, FILTER_SANITIZE_STRING),0);

              $quantidade[] = filter_input(INPUT_POST, 'espec'.$linha, FILTER_SANITIZE_STRING); //qtd das especializações que forem > 0
              $id_itens[] = $linha; //id_produto das especializações selecionadas
              $tem_algo_no_cart = true;
              echo "<pre>";var_dump($quantidade);echo "</pre>";
              echo "<pre>";var_dump($id_itens);echo "</pre>";die;
            }
          }
          if($tem_algo_no_cart){
            $this->login->createSessionCarrinho();
            $_SESSION['carrinho'] = $carrinho;
            echo "<pre>";var_dump($_SESSION['carrinho']);echo "</pre>";

            var_dump($quantidade);
            echo '<br>';
            var_dump($id_itens);
          }
        }
        $this->view->load('header',$data);
        $this->view->load('nav',$data);
        $this->view->load('single-product',$data); //single-product2
        $this->view->load('footer');
    }

}
