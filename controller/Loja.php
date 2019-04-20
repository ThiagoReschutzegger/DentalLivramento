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

    public function view($id_grupo = null){ //Edu
      // $string = explode(".",$id_grupo);
      // $id_grupo = $string[0];
      // $paginador = $string[1];
      if($id_grupo == null) header('location:' . $this->config->base_url); //contra espetinhos

        $data['estilo'] = $this->model->getEstiloAtual();
        $data['grupo'] = $this->modelGrupo->getGrupo();
        $data['grupo-atual'] = $this->modelGrupo->getGrupoById($id_grupo);
        $data['categoria'] = $this->modelCategoria->getCategoria();
        $data['categoria-atual'] = $this->modelCategoria->getCategoriaByGrupoId($id_grupo);
        $data['itens'] = $this->father->getList();

        if (filter_input(INPUT_POST, 'filter1') || filter_input(INPUT_POST, 'filter2')) {

          $preco_min = preg_replace("/[^0-9]/", "", filter_input(INPUT_POST, 'preco-min', FILTER_SANITIZE_STRING));
          $preco_max = preg_replace("/[^0-9]/", "", filter_input(INPUT_POST, 'preco-max', FILTER_SANITIZE_STRING));
          $marca_id = filter_input(INPUT_POST, 'marca', FILTER_SANITIZE_STRING);
          $ordem = filter_input(INPUT_POST, 'ordem', FILTER_SANITIZE_STRING);
          $categoria_id = $this->modelCategoria->getCategoriaByGrupoId($id_grupo);

          $data['packproduto'] = $this->modelPackproduto->filtroPackproduto($preco_min,$preco_max,$marca_id,$ordem,$id_grupo,$categoria_id);
        }else{
          $data['packproduto'] = $this->modelPackproduto->getPackprodutoByGrupo($id_grupo);
        }

        if(empty($data['packproduto'])){ //caso não tenha nenhum prod no grupo, gambiarra.com
        $data['packproduto'] = 'password';
        $ids[] = 0;
        $data['marca'] = null;
        }else{
          $preco_aux = []; //array onde tem todos os preços dos produtos que estão sendo exibidos
          $ids = [];
          foreach ($data['packproduto'] as $produtos){ //gambiarra pra pegar o menor preço de cada produto
            $preco_aux[$produtos->getId_subgrupo()] = number_format($produtos->getPreco(), 2);
            $preco_aux[$produtos->getId_subgrupo()] = str_replace(',', '', $preco_aux[$produtos->getId_subgrupo()]);
            $ids[] = $produtos->getId_subgrupo();
            if(empty($data[$produtos->getId_subgrupo()])) $data[$produtos->getId_subgrupo()] = $preco_aux[$produtos->getId_subgrupo()];
            if($preco_aux[$produtos->getId_subgrupo()] < $data[$produtos->getId_subgrupo()]){
              $data[$produtos->getId_subgrupo()] = $preco_aux[$produtos->getId_subgrupo()];
            }
          }
          $data['marca'] = $this->modelMarca->getMarcaByProduto($ids);
          }
          if(empty($preco_aux)){ //caso não tenha nenhum prod no grupo, gambiarra.com
          $preco_aux[] = 0;
          }

        $data['preco_min'] = (int)min($preco_aux);

        $data['preco_max'] = (int)max($preco_aux);

        $ids = array_unique($ids);

        // if (filter_input(INPUT_POST, 'filtrar')) {
        //   $min = filter_input(INPUT_POST, 'preco-min', FILTER_SANITIZE_STRING);
        //   $max = filter_input(INPUT_POST, 'preco-max', FILTER_SANITIZE_STRING);
        //   echo $min."<br>".$max;
        //   die;
        // }



        $this->view->load('header',$data);
        $this->view->load('nav',$data);
        $this->view->load('shopping', $data);
        $this->view->load('footer');
    }

}
