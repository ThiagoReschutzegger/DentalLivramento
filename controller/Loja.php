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
      $string = explode(".",$id_grupo);
      $id_grupo = $string[0];
      if(!isset($string[1])){
          $paginador = 1;
      }else{
        $paginador = $string[1];
      }


      //
      // $total = $this->model->totalImagens();
      //   $data['total'] = ceil($total/12);
      //   $data['pag'] = $paginador;
      //
      //   $data['galeria'] = $this->model->getImagemPaginador($paginador);




      if($id_grupo == null) header('location:' . $this->config->base_url); //contra espetinhos

        $data['estilo'] = $this->model->getEstiloAtual();
        $data['grupo'] = $this->modelGrupo->getGrupo();
        $data['grupo-atual'] = $this->modelGrupo->getGrupoById($id_grupo);
        $data['categoria'] = $this->modelCategoria->getCategoria();
        $data['categoria-atual'] = $this->modelCategoria->getCategoriaByGrupoId($id_grupo);
        $data['itens'] = $this->father->getList();

        if (filter_input(INPUT_POST, 'filter1')) {

          $preco_min = preg_replace("/[^0-9]/", "", filter_input(INPUT_POST, 'preco-min', FILTER_SANITIZE_STRING));
          $preco_max = preg_replace("/[^0-9]/", "", filter_input(INPUT_POST, 'preco-max', FILTER_SANITIZE_STRING));
          if($preco_min == $preco_max) $preco_min = $preco_min -1; $preco_max = $preco_max +1;
          $marca_id = filter_input(INPUT_POST, 'marca', FILTER_SANITIZE_STRING);
          $ordem = filter_input(INPUT_POST, 'guiest_id1', FILTER_SANITIZE_STRING);
          $categoria_id = $this->modelCategoria->getCategoriaByGrupoId($id_grupo);

          $data['packproduto'] = $this->modelPackproduto->filtroPackproduto($preco_min,$preco_max,$marca_id,$ordem,$id_grupo,$categoria_id,$paginador);
        }else{
          $data['packproduto'] = $this->modelPackproduto->getPackprodutoByGrupo($id_grupo,$paginador);
          //echo "<pre>";var_dump($data['packproduto']);die;
        }

        if (filter_input(INPUT_POST, 'filter2')) {
          if(!empty($data['packproduto'])){
            $ordem = filter_input(INPUT_POST, 'guiest_id1', FILTER_SANITIZE_STRING);

            if($ordem == "alfa"){
              // $ordem_str = "ORDER BY subgrupo.nome asc";
              echo "<pre>";var_dump($data['packproduto']);die;
            }else if ($ordem == "maior"){
              $ordem_str = "ORDER BY produto.preco desc";
            }else if ($ordem == "menor"){
              $ordem_str = "ORDER BY produto.preco asc";
            }else if ($ordem == "new"){
              $ordem_str = "ORDER BY subgrupo.id_subgrupo desc";
            }
          }
        }

        if(empty($data['packproduto'])){ //caso não tenha nenhum prod no grupo, gambiarra.com
        $data['packproduto'] = 'password';
        $ids[] = 0;
        $data['marca'] = null;
        $data['total'] = 0;
        }else{
          $preco_aux = []; //array onde tem todos os preços dos produtos que estão sendo exibidos
          $todos_precos = [];
          $ids = [];
          foreach ($data['packproduto'] as $produtos){ //gambiarra pra pegar o menor preço de cada produto
            $preco_aux[$produtos->getId_subgrupo()] = number_format($produtos->getPreco(), 2);
            $preco_aux[$produtos->getId_subgrupo()] = str_replace(',', '', $preco_aux[$produtos->getId_subgrupo()]);
            $ids[] = $produtos->getId_subgrupo();
            if(!isset($data[$produtos->getId_subgrupo()])) $data[$produtos->getId_subgrupo()] = $preco_aux[$produtos->getId_subgrupo()];
            if($preco_aux[$produtos->getId_subgrupo()] < $data[$produtos->getId_subgrupo()]){
              $data[$produtos->getId_subgrupo()] = $preco_aux[$produtos->getId_subgrupo()];
            }
            $todos_precos[] = (int)$data[$produtos->getId_subgrupo()];
          }
          $data['marca'] = $this->modelMarca->getMarcaByProduto($ids);

          $count = 0;
          $ids_aux = [];
          foreach($data['packproduto'] as $produtos){
            // echo "s";

            if(in_array($produtos->getId_subgrupo(), $ids_aux)){
              // echo "k";
              $count=$count+1;
                continue;
            } else {
              // echo "r";

              $ids_aux[] = $produtos->getId_subgrupo();
            }
          }
          $total = count($data['packproduto'])-$count;
          $data['total'] = ceil($total/12);

          }
          if(empty($preco_aux)){ //caso não tenha nenhum prod no grupo, gambiarra.com
          $preco_aux[] = 0;
          }

        $data['preco_min'] = (int)min($todos_precos);

        $data['preco_max'] = (int)max($todos_precos);

        $ids = array_unique($ids);

        // if (filter_input(INPUT_POST, 'filtrar')) {
        //   $min = filter_input(INPUT_POST, 'preco-min', FILTER_SANITIZE_STRING);
        //   $max = filter_input(INPUT_POST, 'preco-max', FILTER_SANITIZE_STRING);
        //   echo $min."<br>".$max;
        //   die;
        // }
        

        $data['pag'] = $paginador;



        $this->view->load('header',$data);
        $this->view->load('nav',$data);
        $this->view->load('shopping', $data);
        $this->view->load('footer');
    }

    public function search(){ //Edu
      $data['estilo'] = $this->model->getEstiloAtual();
      $data['grupo'] = $this->modelGrupo->getGrupo();
      $data['categoria'] = $this->modelCategoria->getCategoria();
      $data['itens'] = $this->father->getList();
      $data['packproduto'] = '';
      $data['texto'] = '';

      if (filter_input(INPUT_POST, 'pesquisar')) {
        $texto = filter_input(INPUT_POST, 'texto-psq', FILTER_SANITIZE_STRING);
        if ($this->modelPackproduto->searchPackprodutoForDefault($texto)) {
          $data['packproduto'] = $this->modelPackproduto->searchPackprodutoForDefault($texto);
          $data['texto'] = $texto;

          if(empty($data['packproduto'])){ //caso não tenha nenhum prod no grupo, gambiarra.com
          $data['packproduto'] = 'password';
          }else{
            $preco_aux = []; //array onde tem todos os preços dos produtos que estão sendo exibidos
            foreach ($data['packproduto'] as $produtos){ //gambiarra pra pegar o menor preço de cada produto
              $preco_aux[$produtos->getId_subgrupo()] = number_format($produtos->getPreco(), 2);
              $preco_aux[$produtos->getId_subgrupo()] = str_replace(',', '', $preco_aux[$produtos->getId_subgrupo()]);
              if(!isset($data[$produtos->getId_subgrupo()])){
                $data[$produtos->getId_subgrupo()] = $preco_aux[$produtos->getId_subgrupo()];
              }
              if($preco_aux[$produtos->getId_subgrupo()] < $data[$produtos->getId_subgrupo()]){
                $data[$produtos->getId_subgrupo()] = $preco_aux[$produtos->getId_subgrupo()];
              }
            }
            }
            if(empty($preco_aux)){ //caso não tenha nenhum prod no grupo, gambiarra.com
            $preco_aux[] = 0;
            }

        }else{
          $data['packproduto'] = 'password';
          $data['texto'] = $texto;
        }
      }


      //echo '<pre>'; var_dump($data); echo '</pre>'; die;

      $this->view->load('header',$data);
      $this->view->load('nav',$data);
      $this->view->load('pesquisa', $data);
      $this->view->load('footer');
    }

}
