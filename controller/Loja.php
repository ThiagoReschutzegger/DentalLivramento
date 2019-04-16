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

    public function view($id_grupo){ //Edu
        $data['estilo'] = $this->model->getEstiloAtual();
        $data['grupo'] = $this->modelGrupo->getGrupo();
        $data['grupo-atual'] = $this->modelGrupo->getGrupoById($id_grupo);
        $data['categoria'] = $this->modelCategoria->getCategoria();
        $data['categoria-atual'] = $this->modelCategoria->getCategoriaByGrupoId($id_grupo);
        $data['itens'] = $this->father->getList();
        $data['packproduto'] = $this->modelPackproduto->getPackprodutoByGrupo($id_grupo);

        if(empty($data['packproduto'])){
        $data['packproduto'] = 'password';
        }else{
          $preco_aux = [];
          foreach ($data['packproduto'] as $produtos){ //gambiarra pra pegar o menor preço de cada produto
            $preco_aux[$produtos->getId_subgrupo()] = number_format((float)$produtos->getPreco(), 2);
            if(empty($data[$produtos->getId_subgrupo()])) $data[$produtos->getId_subgrupo()] = $preco_aux[$produtos->getId_subgrupo()];
            if($preco_aux[$produtos->getId_subgrupo()] < $data[$produtos->getId_subgrupo()]){
              $data[$produtos->getId_subgrupo()] = $preco_aux[$produtos->getId_subgrupo()];
            }
          }
          }
        $data['preco_min'] = min($preco_aux);
        $data['preco_max'] = max($preco_aux);

        $data['marca'] = $this->modelMarca->getMarca(); //será? filtro por marca tb?
        $this->view->load('header',$data);
        $this->view->load('nav',$data);
        $this->view->load('shopping', $data);
        $this->view->load('footer');

    }

}
