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
    protected $modelMensagem;
    protected $carrinho;
    protected $login;
    protected $mailer;

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
        $this->modelMensagem = new MensagemModel();
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
        $data['preloader'] = '1';

        $this->view->load('header',$data);
        $this->view->load('nav',$data);
        $this->view->load('index', $data);
        $this->view->load('footer');
        $data['preloader'] = false;

    }

    public function error404(){
        $data['estilo'] = $this->model->getEstiloAtual();
        $data['categoria'] = $this->modelCategoria->getCategoria();
        $data['grupo'] = $this->modelGrupo->getGrupo();
        $data['itens'] = $this->getList();

        $this->view->load('header',$data);
        $this->view->load('nav',$data);
        $this->view->load('404', $data);
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
          $preco_aux[] = (float)$produtos->getPreco();
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
        }else if($estoque_total == 0){
          $data['estoque-msg'] = 'color: #f55c5d; border: 1px solid #f55c5d;">Sem estoque';
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

          if ($nome && $telefone) {
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
        $data['preloader'] = '1';
        $this->view->load('header',$data);
        $this->view->load('nav',$data);
        $this->view->load('step-3', $data);
        $this->view->load('footer');
        $data['preloader'] = null;
    }

    public function addMensagem($email=null,$msg=null) { //Edu

      if (filter_input(INPUT_POST, 'enviar-msg') || isset($email) || isset($msg)) {
        if(!isset($email) || !isset($msg)){
          $email = filter_input(INPUT_POST, 'email-msg', FILTER_SANITIZE_STRING);
          $msg = filter_input(INPUT_POST, 'mensagem-msg', FILTER_SANITIZE_STRING);
        }
        if ($email && $msg) {
          date_default_timezone_set('America/Sao_Paulo');
          $mensagem = new Mensagem(null,$email,$msg,date("Y-m-d"));
          $this->modelMensagem->insertMensagem($mensagem);
          $this->MensagemEnviada();
          return true;
        }else{
          $this->MensagemErro();
          return true;
        }
      }else{
        $this->MensagemErro();
        return true;
      }
    }
    public function MensagemEnviada(){ //Edu
        $data['estilo'] = $this->model->getEstiloAtual();
        $data['categoria'] = $this->modelCategoria->getCategoria();
        $data['grupo'] = $this->modelGrupo->getGrupo();
        $data['itens'] = $this->getList();

        $this->view->load('header',$data);
        $this->view->load('nav',$data);
        $this->view->load('mensagem-ok', $data);
        $this->view->load('footer');
    }
    public function MensagemErro(){ //Edu
        $data['estilo'] = $this->model->getEstiloAtual();
        $data['categoria'] = $this->modelCategoria->getCategoria();
        $data['grupo'] = $this->modelGrupo->getGrupo();
        $data['itens'] = $this->getList();

        $this->view->load('header',$data);
        $this->view->load('nav',$data);
        $this->view->load('mensagem-erro', $data);
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


        date_default_timezone_set('America/Sao_Paulo');
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

    public function Mailer(){ //param: acao, email, nome. Edu

      //Falta implementar o nome que vier, ai no meio
      //view/templates/Email/index
      $template_cliente = '<html>
        <head>
          <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
          <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
          <style type="text/css">

            /* Default CSS */
            body,#body_style {margin: 0; padding: 0; background: #f1f1f1; color: #5b656e;}
            a {color: #09c;}
            a img {border: none; text-decoration: none;}
            table, table td {border-collapse: collapse;}
            td, h1, h2, h3, p {font-family: arial, helvetica, sans-serif; color: #313a42;}
            h1, h2, h3, h4 {color: #313a42 !important; font-weight: normal; line-height: 1.2;}
            h1 {font-size: 24px;}
            h2 {font-size: 18px;}
            h3 {font-size: 16px;}
            p {margin: 0 0 1.6em 0;}

            /* Force Outlook to provide a "view in browser" menu link. */
            #outlook a {padding:0;}

            .topHeader{margin-top: 10px; margin-bottom: 10px;}

            /* Logo (branding) */
            .logoContainer {padding: 20px 0 10px 0px; width: 320px;}
            .logoContainer a {color: #ffffff;}
            .logo{width: 300px;}

            /* Whitespace (imageless spacer) */
            .whitespace {font-family: 0px; line-height: 0px;}

            /* Button */
            .buttonContainer {padding: 10px 20px 10px 20px;}
            .button {padding: 10px 5px 10px 5px; text-align: center; background-color: #00a0e3; border-radius: 4px;}
            .button a {color: #ffffff; text-decoration: none; display: block; text-transform: uppercase;}

            /* Featured content */
            .featuredHeader {background: #00a0e3;}
            #featuredImage img {display: block; margin: 0 auto;}
            .featuredTitle {color: #ffffff; font-size: 26px; padding: 0px 0px 10px 0px; font-weight: bold;}
            .featuredContent {color: #ffffff;}

            /* One horizontal section of content: e.g. */
            .section {padding: 20px 0px 0px 0px;}
            .sectionEven {background-color: #ffffff;padding: 30px 0px 30px 0px;}

            .sectionTitle, .sectionSubTitle{text-align: center;}
            .sectionTitle {font-size: 26px; padding: 0px 10px 10px 10px}
            .sectionSubTitle {padding: 0px 10px 20px 10px;}

            /* Footer and social media */
            .footNotes {padding: 0px 20px 0px 20px;}
            .footNotes a {color: #556270; font-size: 13px;}
            .socialMedia {background: #556270;}


            /* CSS for specific screen width(s) */
            @media only screen and (max-width: 480px) {
              body,table,td,p,a,li,blockquote {-webkit-text-size-adjust:none !important;}
                body[yahoofix] table {width: 100% !important;}
                body[yahoofix] .logoContainer, body[yahoofix] .featuredTitle , body[yahoofix] .featuredContent {text-align: center;}
                body[yahoofix] .preheaderContent{text-align: center;}
                body[yahoofix] .buttonContainer {padding: 0px 20px 0px 20px;}
                body[yahoofix] .column {float: left; width: 100%;}
                body[yahoofix] #featuredImage {text-align: center;}
                body[yahoofix] .featuredTitle {line-height: 24px; font-weight: normal !important; padding: 0px 10px 25px 10px;}
                body[yahoofix] .featuredContent {padding: 0px 10px 20px 10px;}
              }
          </style>
        </head>
        <body yahoofix>
          <span id="body_style" style="display:block">

            <!-- topHeader -->
            <table border="0" cellspacing="0" cellpadding="0" width="100%" summary="" class="topHeader">
              <tr>
                <td>
                  <!-- Logo (branding) -->
                  <table border="0" cellspacing="0" cellpadding="0" width="640" align="center" summary="">
                    <tr>
                      <td class="logoContainer" align="center">
                        <a href="/" title="Lorem logo">
                          <img class="logo" src="https://lh3.googleusercontent.com/ngHU-7pNdMyMbI4AAX3lYWKDz_PHqx64oA0MF1IGyEXSPOXDAfjXbJtu48H7uvYfICJhKD2hmLALov0qQbxcpDOtzsJCgTsfzeUBij9mWJ2-5zo8Hj0JE6XSTGZq5AnSD4IKKxn5pVaC1MbmUX5nJSkSPaXy7wLhFUI1Q9Fd_B-mE_HiWk8FzbdsAbnNmsE7K3zitoAJC8Z-OH8tn4KiJe3hWReqBqQ3DNQWaXXch57GeTqb3bvRPQ1B9YMNJBe58TuBbJmZ20h8_PEc_CUZhFvdsYmS7ga5LSFlO9fnDCo2OuaOMuwJKhjbKQWsyE26dX699JAc3R8Tu2y_P7_xGHNGUM1cSK9myP9ri46LHzGjFXnwfP9AQeMAXqc4U1aBse7KRM2tHJmfulxeRpT3DL-XyOnzNgQaf9owlJ1HQU3WxLPBn4zNxQfSQqRVz0OuLspEKeJFvdGDvK7k__2UjqgOoFepnL17hRRaFCGuJlJ7X_7oexc6UUEd8r12lU6EkXZUC-hDusL3YRvYk2Jk5SMY2NJqrSigFslK8ZRwYmcWd9ACogMj5i9K7dglla9l7Pi1_aey-ZooPEmxv-_HdZTUTapJ4Q8Z3ZsbLiU8TkyqE1ir6a8TCrvvUdBKRDBcCDKOVCrKeB_GtjXFoRsCYEbu=w1326-h205-no" alt="logo" />
                        </a>
                      </td>
                    </tr>
                  </table>
                  <!-- End Logo (branding) -->
                </td>
              </tr>
            </table>
            <!-- End topHeader -->

            <!-- featuredHeader -->
            <table border="0" cellspacing="0" cellpadding="0" width="100%" summary="" class="featuredHeader">
              <tr>
                <td class="section">
                  <table border="0" cellspacing="0" cellpadding="0" width="640" align="center" summary="">
                    <tr>
                      <td class="column">
                        <table border="0" cellspacing="0" cellpadding="0" width="395" summary="">
                          <tr>
                            <td class="featuredTitle">
                              Seu pedido foi confirmado!
                            </td>
                          </tr>
                          <tr>
                            <td class="featuredContent">
                              Estamos cientes de seu pedido Cliente Sobrenome.<br>Estamos esperando você comparecer na nossa Loja para Finalizar sua compra!
                            </td>
                          </tr>
                        </table>
                      </td>
                      <td id="featuredImage" class="column"><img src="https://lh3.googleusercontent.com/S-4XGyCtjdxf1sCXkRqNwaMh2wNxjXkVDa-1tt6QtDivFIpUzzTf2GRY4o2EwpWIz7LogKCqN1SFcE5KDBLWcOrlnTZ4Fl7WOON_Nv9cue21RgdbBlsKMki8RWWYQmYTOUbJ9EJEGLCXwmhU8FLgVTwsDnNjrEUINAFu83KKUd5BOBR7Kgyb7DVE4Xxe88QO2HMwz8HZNVYc6FObPwehrrYgNAr6azFpk2iUJSbzr1I96rr3OrLcVjwmeZxAWQ0JQb4F9Y7QO_FKVd9yaUe9ty0pe8fG0rkXHky3dlZ17dUvZB4_SjgX_ul3OwTamHcml2fTSDHZ-9SeuuDfS-AuJfi2qXqcnaQ1rbsCsCHn6O0ElAXAKPepWhYKips_QH3vj8lK4GQTAvBTIxyVhbzWzxFCEupikJ6j3Ft75_sT8GlsMEiHLr2LFqbIb-1l5h9lrXYkAEAmoPmBJD-C51A9D6ot87qW-eB6EWF_2BpH2p5k_2OLANdP5upEMTcIIopctmlkNI0mo48W-KILHBJuMJ7XbUPs2BLfjiWTJrcJjjgtOIVCpwqK6cSy9KFlKabeDrDWwZKm8cRLwcvgNTeGp_RzDwSPSeOKFPx5GqR91RCx8m7Q_AKMz0Pmmd-V95a2ME-rzCgpz2cZa3WtMGOlEs-j=w234-h203-no" width="234" alt="" /></td>
                    </tr>
                  </table>
                </td>
              </tr>
            </table>
            <!-- End featuredHeader -->

            <!-- Section -->
            <table border="0" cellpadding="0" cellspacing="0" width="100%" summary="">
              <tr>
                <td class="sectionEven">
                  <table border="0" cellpadding="0" cellspacing="0" width="640" align="center" summary="">
                    <tr><td class="sectionTitle">Mais em nosso site!</td></tr>
                    <tr><td class="sectionSubTitle">Confira nossos produtos ou entre em contato conosco pelo site:</td></tr>
                    <tr>
                      <td class="buttonContainer">
                        <table border="0" cellpadding="0" cellspacing="0" summary="" width="30%" align="center">
                          <tr><td class="button"><a href="http://www.dentallivramento.com.br" title="ipsum">acessar</a></td></tr>
                        </table>
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>
            </table>

            <!-- End Section -->

            <!-- Social media -->
            <table border="0" cellspacing="0" cellpadding="0" width="100%" summary="" class="socialMedia">
              <tr><td class="whitespace" height="20">&nbsp;</td></tr>
              <tr>
                <td>
                  <table border="0" cellspacing="0" cellpadding="0" width="120" align="center" summary="">
                    <tr>
                      <td align="center" width="32">
                        <a href="https://www.twitter.com" title="Twitter"><img src="https://clipart.info/images/ccovers/1522452763logo-instagram-png-white.png" width="29" alt="Instagram" /></a>
                      </td>
                      <td align="center" width="32">
                        <a href="https://www.facebook.com" title="Facebook"><img src="https://lh3.googleusercontent.com/6vqCobn6AVRGBetzgmRfvJNQaEUpcARck-Xvt7em_5elsgq1FPlJgl_5LncBKL6B16v9wcrKEIeOBjCoHXuJjQlSAPjq0RBp4oAtuWhUBQMDWrb6apHRId26x4KnhqRcqidHDnNvfYHQXRwWe38TuNly9rbnIgEOxsneWfAZ6ZIR9gw6wZqqZcSM_j5wqDKsOTSSkxvHh4_8iu0PLD0Anw2OXCmHWGYqbPB9DKCJvWyO6J0IZRlcCPY7qQxSW5LWqMXhiSVy6Ycd49aelpTROoHzHz5lSupuoDicyMnQfW9Rb3b6ujUqfenE4SbCF59dTV_HCzkCntA5HaYhSLeSyfRcd6yiWhIV-cVB-DlmWayTwLm7Nhkgk-83C0VkTH-bE0zogBFJc-aCZWKJLA8_R2ZXbOnzuNVWesAwX6aPOXtjKHtlxFc7kPYKb0n7G26UE6q8MBXNcAZARnUE2vOc6b79mZvGu5x2x3LeSMTrbTzKRuNHGkL1y_Lol0mdyx0khc_thNEVamRu893k2ebrKjz3fZqQMRWxtshB57tH0dgJZpW_uhRbiha4gTNwhADnu-Ot9RgVMFdSOgK3z7zKm6yT2xNCW4Oke8lUiAMS0KT0V8CCDYElRMxkA3KVVsaPOtYIdFoJoCl_gzxVr-3-fz6z=s49-no" width="29" alt="Facebook" /></a>
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>
              <tr><td class="whitespace" height="10">&nbsp;</td></tr>
            </table>
            <!-- End Social media -->

            <!-- FOOTER -->
            <table border="0" cellspacing="0" cellpadding="0" width="100%" summary="" class="footer">
              <tbody><tr><td class="whitespace" height="10">&nbsp;</td></tr>
              <tr>
                <td>
                  <table border="0" cellspacing="0" cellpadding="0" align="center" summary="">
                    <tbody><tr>
                      <td class="footNotes" align="center">
                        <p title="Lorem" style="color: #556270; font-size: 13px;">Este é um email automático, não responda. Para entrar em contato utilize os meios disponíveis pelo site.</p>
                      </td>
                    </tr>
                  </tbody></table>
                </td>
              </tr>
              <tr><td class="whitespace" height="10">&nbsp;</td></tr>
            </tbody></table>
            <!-- END FOOTER -->
          </span>
        </body>
      </html>
      ';

      $template_guillermo_pedidonew = '';

      $template_guillermo_msgnew = '';

      //enquanto nao vem parametros:
      $acao = 'teste'; //pedido ou msg, PRA TESTAR COLOCA teste !!!!
      $email = ''; //email do cliente

      //variaveis fixas
      $email_envio = ''; //email para aparecer quem enviou, não necessariamente a conta de email que esta enviando / vai ser o email do site/hostinger
      $email_guillermo = '';

      if($acao == 'pedido'){
        //avisando o cliente
        if($email != ''){ //se o cliente nao preencheu email, envia só p guillermito
          echo "rsrs";
          die;
          $assunto = 'Pedido Confirmado';
          $email = new Email($email,$email_envio,$assunto,$template_cliente,null);
          $email->send();
        }

        //avisando o guillermo
        echo "kk"; die;
        date_default_timezone_set('America/Sao_Paulo');
        $assunto = 'Novo Pedido - '.date("d/m/Y");
        $email = new Email($email_guillermo,$email_envio,$assunto,$template_guillermo_pedidonew,null);
        $email->send();
      }

      if($acao == 'mensagem'){

      }

      if($acao == 'teste'){
        $email = new Email('dudumaciel2011@hotmail.com','serjaoberranteiro666@gmail.com','Teste php mailer html 2',$template_cliente,null);
        $email->send();
      }
    }

}
