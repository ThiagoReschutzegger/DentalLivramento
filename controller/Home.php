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
          if($this->Mailer('mensagem')){
            $this->MensagemEnviada();
            return true;
          }
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
      if($this->Mailer('pedido',$pedido->getEmail(),$pedido->getNome())){
        header('location:' . $this->config->base_url . 'Home/step3');
        die;
      }
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

    public function Mailer($acao,$email = null, $nome = null){ //param: acao, email, nome. Edu
      if(!$nome) $nome = '';
      $titulo = '';
      if($acao == 'mensagem') $titulo = 'Mensagens';
      if($acao == 'pedido') $titulo = 'Pedidos';
      //Falta implementar o nome que vier, ai no meio
      //view/templates/Email/index

      $base_html = '<html>
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
        </head>';

      $template_cliente = $base_html.'
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
                          <img class="logo" src="http://dentalbeta.tk/view/templates/default/img/DentalLivramentoLogoFinal.png" alt="logo" />
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
                              Estamos cientes de seu pedido '.$nome.'.<br>Estamos esperando você comparecer na nossa Loja para Finalizar sua compra!
                            </td>
                          </tr>
                        </table>
                      </td>
                      <td id="featuredImage" class="column"><img src="https://previews.dropbox.com/p/thumb/AAaZm2eg_vGwROC1IwY-rz0KDZPYhLDtgZgJkqCesxuM9WOCHQdpvGN5iJ2ClUg-nhoIc-21BRSdIscW839CDc9JQ_B1uhlTup6vTkOGo3I0Sxr0GM898puv-8xZhYmQm0iZadp2qIb_bo_X4N2I-nN_1ydy7qFrzfvP9erCF0yZHUdGdbY_tr0vdwyxmz0OqPZbJU0mKzUsD-8pqBwSb8EgSvvgJIG-SNlyMfVUgu0KwIAYOGwmLGIBfxkbLLpzVeVte1Tm9IRkj9aoACr3qZvS6eMgZPPLAWOrULEh8C0udqnP3gNZe8jxAvMehZQ-grC8IFD_f0e_8e5d_57JiZil/p.png" width="234" alt="" /></td>
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
                        <a href="https://www.instagram.com/dentallivramento/" title="Twitter"><img src="https://clipart.info/images/ccovers/1522452763logo-instagram-png-white.png" width="29" alt="Instagram" /></a>
                      </td>
                      <td align="center" width="32">
                        <a href="https://www.facebook.com/DentalLivramento/" title="Facebook"><img src="https://previews.dropbox.com/p/thumb/AAZ9L3b9jFJpYVOvxefJ1N8e5wotzU_ylLrHtWPIwhjbLVCx5BFunc1_4FxVnWn0Wo29WDLXG9ctfYJOXNdUonLoRumoZwcNabUi6Jetsb2K_oyQ6XdIsghTtz7D-0qRJ343DC_G27bx3QPzYEOHWHNLmpdP2vf9NKaxRNRA0BxOgGGJidsXGLIOKa91GmCCn977ayLRQtGHN4kg_6B_-se5sU3-FWSMTkuxx_LrVviKyy7Id1H3w4K0z7CmpHbw6jyN0xot9ksAMWJeBWUMnjSfq3W0uEl_A8OIcHvjlXrLj03x1kmbIHeM4wrxSbZE6_QlFk2nKEmKmEDm1J8utYMP/p.png" width="29" alt="Facebook" /></a>
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

      $template_guillermo = $base_html.'
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
                          <img class="logo" src="https://https://previews.dropbox.com/p/thumb/AAZejuvfxZIo9_lmvvFjzEXQM2E8PWijdbvlXDgz9a8BA3bkqI4bUKr5g9PhTpBARh_mBTp9pELvBpFs7ra83KviFzka6C75F8vOTbCEpCEBM2tB5vX_6eHUgwwNIVEJ5Qe9rzZHZ9visoKO4VI4SAFG_JGlGcVneNSEP_1qnR38phvhB3Yr2WsfDYMg3LmP1DpZfEXquiQjLv4bKXSCbbCTv4qrVQL5dZ-tdtNJJ97IUTkS6AlMgHU5cNNU8BhtjiCUbPy8P_AkoWbU8jUtNEmHgliwB1KfPKAdDieizbGcOpKApBx07I2vxijN4YRGk7pMndFrysqIo1pmYI4XGU2A/p.png" alt="logo" />
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
                              Você tem novos '.$titulo.'!
                            </td>
                          </tr>
                          <tr>
                            <td class="featuredContent">
                              Pode ser que você tenha novos '.$titulo.'.<br>Acesse o site na sessão Admin e confira!
                            </td>
                          </tr>
                        </table>
                      </td>
                      <td id="featuredImage" class="column"><img src="https://previews.dropbox.com/p/thumb/AAaZm2eg_vGwROC1IwY-rz0KDZPYhLDtgZgJkqCesxuM9WOCHQdpvGN5iJ2ClUg-nhoIc-21BRSdIscW839CDc9JQ_B1uhlTup6vTkOGo3I0Sxr0GM898puv-8xZhYmQm0iZadp2qIb_bo_X4N2I-nN_1ydy7qFrzfvP9erCF0yZHUdGdbY_tr0vdwyxmz0OqPZbJU0mKzUsD-8pqBwSb8EgSvvgJIG-SNlyMfVUgu0KwIAYOGwmLGIBfxkbLLpzVeVte1Tm9IRkj9aoACr3qZvS6eMgZPPLAWOrULEh8C0udqnP3gNZe8jxAvMehZQ-grC8IFD_f0e_8e5d_57JiZil/p.png" width="234" alt="" /></td>
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
                    <tr>
                      <td class="buttonContainer">
                        <table border="0" cellpadding="0" cellspacing="0" summary="" width="30%" align="center">
                          <tr><td class="button"><a href="http://www.dentallivramento.com.br/Admin" title="ipsum">acessar admin</a></td></tr>
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
                        <a href="https://www.instagram.com/dentallivramento/" title="Twitter"><img src="https://clipart.info/images/ccovers/1522452763logo-instagram-png-white.png" width="29" alt="Instagram" /></a>
                      </td>
                      <td align="center" width="32">
                        <a href="https://www.facebook.com/DentalLivramento/" title="Facebook"><img src="https://previews.dropbox.com/p/thumb/AAZ9L3b9jFJpYVOvxefJ1N8e5wotzU_ylLrHtWPIwhjbLVCx5BFunc1_4FxVnWn0Wo29WDLXG9ctfYJOXNdUonLoRumoZwcNabUi6Jetsb2K_oyQ6XdIsghTtz7D-0qRJ343DC_G27bx3QPzYEOHWHNLmpdP2vf9NKaxRNRA0BxOgGGJidsXGLIOKa91GmCCn977ayLRQtGHN4kg_6B_-se5sU3-FWSMTkuxx_LrVviKyy7Id1H3w4K0z7CmpHbw6jyN0xot9ksAMWJeBWUMnjSfq3W0uEl_A8OIcHvjlXrLj03x1kmbIHeM4wrxSbZE6_QlFk2nKEmKmEDm1J8utYMP/p.png" width="29" alt="Facebook" /></a>
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


      //enquanto nao vem parametros:
      // $acao = 'teste'; //pedido ou msg, PRA TESTAR COLOCA teste !!!!
       //$email = ''; //email do cliente

      //variaveis fixas
      $email_envio = 'serjaoberranteiro666@gmail.com'; //email para aparecer quem enviou, não necessariamente a conta de email que esta enviando / vai ser o email do site/hostinger
      $email_guillermo = 'dudumaciel2011@hotmail.com';

      if($acao == 'pedido'){
        //avisando o cliente
        if($email != ''){ //se o cliente nao preencheu email, envia só p guillermito
          $assunto = 'Pedido Confirmado';
          $email = new Email($email,$email_envio,$assunto,$template_cliente,null);
          $email->send();
        }

        //avisando o guillermo
        date_default_timezone_set('America/Sao_Paulo');
        $assunto = 'Novo Pedido - '.date("d/m/Y");
        $email = new Email($email_guillermo,$email_envio,$assunto,$template_guillermo,null);
        if($email->send()) return true;
      }

      if($acao == 'mensagem'){
        date_default_timezone_set('America/Sao_Paulo');
        $assunto = 'Nova Mensagem - '.date("d/m/Y");
        $email = new Email($email_guillermo,$email_envio,$assunto,$template_guillermo,null);
        if($email->send()) return true;
      }

      if($acao == 'teste'){
        $email = new Email('dudumaciel2011@hotmail.com','serjaoberranteiro666@gmail.com','Teste com foto new',$template_cliente,null);
        if($email->send()) return true;
      }
    }

}
