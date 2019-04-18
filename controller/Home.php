<?php
class Home extends Controller{

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
        $data['itens'] = $this->getList();
        $data['prod-destaq'] = $this->modelSubgrupo->getSubgrupoDestaque();

        $this->view->load('header',$data);
        $this->view->load('nav',$data);
        $this->view->load('index', $data);
        $this->view->load('footer');

    }

    public function viewProduto($id){ //Edu
        $data['estilo'] = $this->model->getEstiloAtual();
        $data['packproduto'] = $this->modelPackproduto->getPackprodutoBySubgrupo($id);
        $pkpd = $data['packproduto'][0];
        $data['grupo-prod'] = $this->modelGrupo->getGrupoById($pkpd->getId_grupo());
        $data['categoria-prod'] = $this->modelCategoria->getCategoriaById($data['grupo-prod']->getId_categoria());
        $data['marca'] = $this->modelMarca->getMarcaById($pkpd->getId_marca());
        $data['itens'] = $this->getList();
        $data['prod-destaq'] = $this->modelSubgrupo->getSubgrupoDestaque();
        $data['categoria'] = $this->modelCategoria->getCategoria();
        $data['grupo'] = $this->modelGrupo->getGrupo();

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
        $data['itens'] = $this->getList();

        $this->view->load('header',$data);
        $this->view->load('nav',$data);
        $this->view->load('single-product',$data); //single-product2
        $this->view->load('footer');
    }

    public function viewCart($deletar = -1){ //Edu
        $data['estilo'] = $this->model->getEstiloAtual();
        $data['categoria'] = $this->modelCategoria->getCategoria();
        $data['grupo'] = $this->modelGrupo->getGrupo();
        $data['itens'] = $this->getList();

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
        if(isset($_SESSION['carrinho'])){
        $data['estilo'] = $this->model->getEstiloAtual();
        $data['categoria'] = $this->modelCategoria->getCategoria();
        $data['grupo'] = $this->modelGrupo->getGrupo();
        $data['itens'] = $this->getList();

        if (filter_input(INPUT_POST, 'add')) {
          $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
          $endereco = filter_input(INPUT_POST, 'endereco', FILTER_SANITIZE_STRING);
          $cep = filter_input(INPUT_POST, 'cep', FILTER_SANITIZE_STRING);
          $cidade = filter_input(INPUT_POST, 'cidade', FILTER_SANITIZE_STRING);
          $uf = filter_input(INPUT_POST, 'uf', FILTER_SANITIZE_STRING);
          $telefone = filter_input(INPUT_POST, 'telefone', FILTER_SANITIZE_STRING);
          $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
          $mensagem = filter_input(INPUT_POST, 'mensagem', FILTER_SANITIZE_STRING);

          if ($nome && $email && $telefone) {
            $dados = array("Nome"=>$nome,"Endereço"=>$endereco,"CEP"=>$cep,"Cidade"=>$cidade,"UF"=>$uf,"Telefone"=>$telefone,"Email"=>$email,"Mensagem"=>$mensagem);
            if($dados["UF"] == "Selecione o Estado") $dados["UF"]='';

            $this->step2($dados);
            die;
          } else {
            $data['msg'] = 'Preencha todos os Campos!';
          }
        }

        $this->view->load('header',$data);
        $this->view->load('nav',$data);
        $this->view->load('step-1', $data);
        $this->view->load('footer');
      }else{
        header('location:' . $this->config->base_url . 'Home/viewCart');
      }
    }

    public function step2($dados = NULL){ //Edu
        if($dados != NULL){
          $data['estilo'] = $this->model->getEstiloAtual();
          $data['categoria'] = $this->modelCategoria->getCategoria();
          $data['grupo'] = $this->modelGrupo->getGrupo();
          $data['itens'] = $this->getList();
          $data['dados'] = $dados;

          $this->view->load('header',$data);
          $this->view->load('nav',$data);
          $this->view->load('step-2', $data);
          $this->view->load('footer');
        }else{
          header('location:' . $this->config->base_url . 'Home/step1');
        }
    }

    public function step3(){ //Edu
        $data['estilo'] = $this->model->getEstiloAtual();
        $data['categoria'] = $this->modelCategoria->getCategoria();
        $data['grupo'] = $this->modelGrupo->getGrupo();
        $data['itens'] = $this->getList();

        $this->view->load('header',$data);
        $this->view->load('nav',$data);
        $this->view->load('step-3', $data);
        $this->view->load('footer');
    }

    public function descartar(){ //Edu
      session_destroy();
      header('location:' . $this->config->base_url . 'Home/viewCart');
    }

    public function finalProd($param){
      $data['itens'] = $this->getList();

      $array = explode(";", $param);

      for($x=0;$x<8;$x++){
        if($array[$x] == '0'){
          $array[$x] = '';
        }
      }

      $bool = $this->modelCarrinho->insertCarrinho();

      if($bool){
        $idcarrinho = $this->modelCarrinho->getLastIdInserted();

        foreach($data['itens'] as $item){
          $itemcarrinho = new ItemCarrinhoBanco(null,$item[0]->getId_produto(),$item[1],$idcarrinho);
          $test = $this->modelItemcarrinho->insertItemcarrinho($itemcarrinho);
        }

        if(isset($_SESSION['carrinho']) && $data['itens'] != ''){
          $count = 0;
          foreach ($_SESSION['carrinho'] as $item){
            $count += $item->getPrecoitem();
          }
        }



        $pedido = new Pedido(null,$array[0],$array[1],$array[2],$array[3],$array[4],$array[5],$array[6],$array[7],$count,date("Y-m-d"),"NAO ENTREGUE",$idcarrinho);


        $seila = $this->modelPedido->insertPedido($pedido);

      }


      session_destroy();
      header('location:' . $this->config->base_url . 'Home/step3');
      die;
    }

    public function getList(){
      if(isset($_SESSION['carrinho'])){
        $list = [];
          foreach($_SESSION['carrinho'] as $item){
            $list[] = array($this->modelPackproduto->getPackprodutoById($item->getId_produto()),$item->getQuantidade());

          }

          return $list;

      }else{
        return '';
      }
    }

}
