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

    public function view($param = null){ //Edu

      $string = explode(".",$param);
      $id_grupo = $string[0];
      if(!isset($string[1]) || $string[1] == 0){
          $paginador = 1;
      }else{
        $paginador = $string[1];
      }
      if(!isset($string[2])){
          $marca_id = 0;
      }else{
        $marca_id = $string[2];
      }
      if(!isset($string[3])){
          $ordem = '';
      }else{
        $ordem = $string[3];
      }

      if($id_grupo == null) header('location:' . $this->config->base_url); //contra espetinhos

        $data['estilo'] = $this->model->getEstiloAtual();
        $data['grupo'] = $this->modelGrupo->getGrupo();
        $data['grupo-atual'] = $this->modelGrupo->getGrupoById($id_grupo);
        $data['categoria'] = $this->modelCategoria->getCategoria();
        $data['categoria-atual'] = $this->modelCategoria->getCategoriaByGrupoId($id_grupo);
        $data['itens'] = $this->father->getList();

        if (filter_input(INPUT_POST, 'filter') || $marca_id > 0 || $ordem != '') {

          if(filter_input(INPUT_POST, 'guiest_id1', FILTER_SANITIZE_STRING)){
            $ordem = filter_input(INPUT_POST, 'guiest_id1', FILTER_SANITIZE_STRING);
          }

          $data['packproduto'] = $this->modelPackproduto->filtroPackproduto($marca_id,$ordem,$id_grupo,$paginador)[1];

          $data['paginador_max'] = $this->modelPackproduto->filtroPackproduto($marca_id,$ordem,$id_grupo,$paginador)[0];
          $data['paginador_atual'] = $paginador;

          $data['total_prod'] = $this->modelPackproduto->filtroPackproduto($marca_id,$ordem,$id_grupo,$paginador)[2];
          $ids_prod = [];
          foreach ($data['packproduto'] as $produtos){
            if(in_array($produtos->getId_subgrupo(), $ids_prod)) continue; else $ids_prod[] = $produtos->getId_subgrupo();
          }

          $data['total_prod_atual'] = count($ids_prod);

          $data['ordem'] = $this->modelPackproduto->filtroPackproduto($marca_id,$ordem,$id_grupo,$paginador)[3];

        }else {
          $data['packproduto'] = $this->modelPackproduto->getPackprodutoByGrupo($id_grupo,$paginador)[1];

          $data['paginador_max'] = $this->modelPackproduto->getPackprodutoByGrupo($id_grupo,$paginador)[0];
          $data['paginador_atual'] = $paginador;

          $data['total_prod'] = $this->modelPackproduto->getPackprodutoByGrupo($id_grupo,$paginador)[2];
          $ids_prod = [];
          foreach ($data['packproduto'] as $produtos){
            if(in_array($produtos->getId_subgrupo(), $ids_prod)) continue; else $ids_prod[] = $produtos->getId_subgrupo();
          }

          $data['total_prod_atual'] = count($ids_prod);

          $data['ordem'] = "new";

          //echo "<pre>";var_dump($data['packproduto']);die;
        }

        $data['link'] = $marca_id.".".$ordem;
        $data['ordem_atual'] = $ordem;

        if(empty($data['packproduto'])){ //caso não tenha nenhum prod no grupo, gambiarra.com
        $data['packproduto'] = 'password';
        $ids[] = 0;
        $data['marca'] = null;
        $data['total'] = 0;
        $todos_precos = [];
        $todos_precos[] = 0;
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
      $data['preloader'] = null;
    }

}
