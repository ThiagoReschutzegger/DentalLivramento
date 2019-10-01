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
    protected $modelItem;
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
        $this->modelItem = new ItemModel();
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
        $data['prod-destaq'] = $this->modelItem->getItemDestaque();
        $data['preloader'] = '1';

        if(!empty($data['slider'])){ //se vier algo no slider
          foreach($data['slider'] as $slider){
            $data['packproduto'] = $this->modelPackproduto->getPackprodutoBySubgrupo($slider->getId_subgrupo());
            $precos = [];
            foreach($data['packproduto'] as $linha){
              $precos[] = $linha->getPreco();
            }
            $data['preco_min'.$slider->getId_slider()] = min($precos);
            $data['nome'.$slider->getId_slider()] = $data['packproduto'][0]->getNome();
            $data['descricao'.$slider->getId_slider()] = $data['packproduto'][0]->getDescricao();
            $data['id_sub'.$slider->getId_slider()] = $data['packproduto'][0]->getId_subgrupo();
          }
        }

        if(!empty($data['prod-destaq'])){ //se tiver algum item sendo destacado
            foreach($data['prod-destaq'] as $destaque){ // objeto item
                $subgrupo = $this->modelSubgrupo->getSubgrupoById($destaque->getId_subgrupo());
                $marca = $this->modelMarca->getMarcaById($destaque->getId_marca());
                $data['nome'.$destaque->getId_item()] = $subgrupo->getNome();
                $data['marca_dstq'.$destaque->getId_item()] = $marca->getNome();
            }
        }

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

    public function viewProduto($id_item){ //Edu
        $data['estilo'] = $this->model->getEstiloAtual();
        $data['item'] = $this->modelItem->getItemById($id_item);
        $data['subgrupo'] = $this->modelSubgrupo->getSubgrupoById($data['item']->getId_subgrupo());
        $data['produto'] = $this->modelproduto->getProdutosByIdsAndTipo($data['item']->getId_subgrupo(), $data['item']->getId_marca(), $data['item']->getTipo()); //funcao na model pra pegar produtos que se relacionam com o item, mesmo id_subg e id_marca
        $data['grupo-prod'] = $this->modelGrupo->getGrupoBySubgrupoId($data['item']->getId_subgrupo())[0];
        $data['categoria-prod'] = $this->modelCategoria->getCategoriaById($data['grupo-prod']->getId_categoria());
        $data['marca'] = $this->modelMarca->getMarcaById($data['item']->getId_marca());
        $data['itens'] = $this->getList();
        $data['prod-destaq'] = $this->modelItem->getItemDestaque();
        $data['categoria'] = $this->modelCategoria->getCategoria();
        $data['grupo'] = $this->modelGrupo->getGrupo();

        $estoque = [];
        $precos = [];
        $id_aux = []; // deixei por causa do cart abaixo da logica estoque
        foreach ($data['produto'] as $produtos): //pegar preço mínimo dos produtos e o estoque total
          $precos[] = (float)$produtos->getPreco();
          $estoque[] = $produtos->getEstoque();
          $id_aux[] = $produtos->getId_produto();// deixei por causa do cart abaixo da logica estoque, rt
        endforeach;
        $data['preco-ate'] = min($precos);

        $estoque_total = array_sum($estoque); //verificar qual nivel de estoque está
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


              array_push($cart,new ItemCarrinho($id_itens,$quantidade,$preco_total,$id_item));

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

        if(!empty($data['prod-destaq'])){ //se tiver algum item sendo destacado
            foreach($data['prod-destaq'] as $destaque){ // objeto item
                $subgrupo = $this->modelSubgrupo->getSubgrupoById($destaque->getId_subgrupo());
                $marca = $this->modelMarca->getMarcaById($destaque->getId_marca());
                $data['nome'.$destaque->getId_item()] = $subgrupo->getNome();
                $data['marca_dstq'.$destaque->getId_item()] = $marca->getNome();
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
            $list[] = array($this->modelPackproduto->getPackprodutoByIds($item->getId_produto(),$item->getId_subgrupo(),$item->getId_item()),$item->getQuantidade());

          }

          return $list;

      }else{
        return '';
      }
    }

    public function Mailer($acao = null,$email = null, $nome = null){ //param: acao, email, nome. Edu
      return true;
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
        <span id="body_style" style="display:block; margin: 0; padding: 0; background: #f1f1f1; color: #5b656e;">
          <!-- topHeader -->
          <table border="0" cellspacing="0" cellpadding="0" width="100%" summary="" class="topHeader" style="margin-top: 10px; margin-bottom: 10px; border-collapse: collapse;">
            <tr>
              <td style="border-collapse: collapse; font-family: arial, helvetica, sans-serif; color: #313a42;">
                <!-- Logo (branding) -->
                <table border="0" cellspacing="0" cellpadding="0" width="640" align="center" summary="" style="border-collapse: collapse;">
                  <tr>
                    <td class="logoContainer" align="center" style="border-collapse: collapse; padding: 20px 0 10px 0px; width: 320px; display: block; margin: 0 auto;">
                      <a href="http://dentallivramento.com.br" title="Lorem logo" style="color: #ffffff;">
                        <img class="logo" style="width: 300px; border: none; text-decoration: none;" src="http://dentalbeta.tk/view/templates/Email-Template-Html-Download-free/logo.png" alt="logo" />
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
          <table border="0" cellspacing="0" cellpadding="0" width="100%" summary="" class="featuredHeader" style="border-collapse: collapse; background: #00a0e3;">
            <tr>
              <td class="section" style="border-collapse: collapse; padding: 20px 0px 0px 0px;">
                <table border="0" cellspacing="0" cellpadding="0" width="640" align="center" summary="" style="border-collapse: collapse;">
                  <tr>
                    <td class="column" style="border-collapse: collapse;">
                      <table border="0" cellspacing="0" cellpadding="0" width="395" summary="" style="border-collapse: collapse;">
                        <tr>
                          <td class="featuredTitle" style="border-collapse: collapse; font-family: arial, helvetica, sans-serif; color: #ffffff; font-size: 26px; padding: 0px 0px 10px 0px; font-weight: bold;">
                            Seu pedido foi confirmado!
                          </td>
                        </tr>
                        <tr>
                          <td class="featuredContent" style="border-collapse: collapse; font-family: arial, helvetica, sans-serif; color: #ffffff;">
                            Estamos cientes de seu pedido '.$nome.'.<br>Em breve entraremos em contato para Finalizar sua compra!
                          </td>
                        </tr>
                      </table>
                    </td>
                    <td id="featuredImage" class="column" style="border-collapse: collapse; display: block; margin: 0 auto;"><img src="http://dentalbeta.tk/view/templates/Email-Template-Html-Download-free/phone.png" style="width: 234px" alt="phone" /></td>
                  </tr>
                </table>
              </td>
            </tr>
          </table>
          <!-- End featuredHeader -->
          <!-- Section -->
          <table border="0" cellpadding="0" cellspacing="0" width="100%" summary="" style="border-collapse: collapse;">
            <tr>
              <td class="sectionEven" style="border-collapse: collapse; background-color: #ffffff;padding: 30px 0px 30px 0px;">
                <table border="0" cellpadding="0" cellspacing="0" width="640" align="center" summary="" style="border-collapse: collapse;">
                  <tr><td class="sectionTitle" style="border-collapse: collapse; font-family: arial, helvetica, sans-serif; color: #313a42; font-size: 26px; padding: 0px 10px 10px 10px; text-align: center;">Mais em nosso site!</td></tr>
                  <tr><td class="sectionSubTitle" style="border-collapse: collapse; font-family: arial, helvetica, sans-serif; color: #313a42; text-align: center; padding: 0px 10px 20px 10px;">Confira nossos produtos ou entre em contato conosco pelo site:</td></tr>
                  <tr>
                    <td class="buttonContainer" style="border-collapse: collapse; padding: 10px 20px 10px 20px;">
                      <table border="0" cellpadding="0" cellspacing="0" summary="" width="30%" align="center" style="border-collapse: collapse;">
                        <tr><td class="button" style="border-collapse: collapse; font-family: arial, helvetica, sans-serif; padding: 10px 5px 10px 5px; text-align: center; background-color: #00a0e3; border-radius: 4px;">
                          <a href="http://www.dentallivramento.com.br" title="ipsum" style="color: #ffffff; text-decoration: none; display: block; text-transform: uppercase;">acessar</a></td></tr>
                      </table>
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
          </table>
          <!-- End Section -->
          <!-- Social media -->
          <table border="0" cellspacing="0" cellpadding="0" width="100%" summary="" class="socialMedia" style="border-collapse: collapse; background: #556270;">
            <tr><td class="whitespace" height="20" style="border-collapse: collapse; font-family: 0px; line-height: 0px;">&nbsp;</td></tr>
            <tr>
              <td>
                <table border="0" cellspacing="0" cellpadding="0" width="120" align="center" summary="" style="border-collapse: collapse;">
                  <tr>
                    <td align="center" width="32" style="border-collapse: collapse;">
                      <a href="https://www.instagram.com/dentallivramento/" title="Twitter"><img src="https://clipart.info/images/ccovers/1522452763logo-instagram-png-white.png" width="29" alt="Instagram" style="border: none; text-decoration: none;" /></a>
                    </td>
                    <td align="center" width="32" style="border-collapse: collapse;">
                      <a href="https://www.facebook.com/DentalLivramento/" title="Facebook"><img src="http://dentalbeta.tk/view/templates/Email-Template-Html-Download-free/faceb.png" width="29" style="border: none; text-decoration: none;" alt="Facebook" /></a>
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
            <tr><td class="whitespace" height="10" style="border-collapse: collapse; font-family: 0px; line-height: 0px;">&nbsp;</td></tr>
          </table>
          <!-- End Social media -->
          <!-- FOOTER -->
          <table border="0" cellspacing="0" cellpadding="0" width="100%" summary="" class="footer" style="border-collapse: collapse;">
            <tbody><tr><td class="whitespace" height="10" style="border-collapse: collapse; font-family: 0px; line-height: 0px;">&nbsp;</td></tr>
            <tr>
              <td>
                <table border="0" cellspacing="0" cellpadding="0" align="center" summary="" style="border-collapse: collapse;">
                  <tbody><tr>
                    <td class="footNotes" align="center" style="border-collapse: collapse; padding: 0px 20px 0px 20px;">
                      <p title="Lorem" style="color: #556270; font-size: 13px; font-family: arial, helvetica, sans-serif; margin: 0 0 1.6em 0;">Este é um email automático, não responda. Para entrar em contato utilize os meios disponíveis pelo site.</p>
                    </td>
                  </tr>
                </tbody></table>
              </td>
            </tr>
            <tr><td class="whitespace" height="10" style="border-collapse: collapse; font-family: 0px; line-height: 0px;">&nbsp;</td></tr>
          </tbody></table>
          <!-- END FOOTER -->
        </span>
      </body>
    </html>
      ';

      $template_guillermo = $base_html.'
      <body yahoofix>
        <span id="body_style" style="display:block; margin: 0; padding: 0; background: #f1f1f1; color: #5b656e;">
          <!-- topHeader -->
          <table border="0" cellspacing="0" cellpadding="0" width="100%" summary="" class="topHeader" style="margin-top: 10px; margin-bottom: 10px; border-collapse: collapse;">
            <tr>
              <td style="border-collapse: collapse; font-family: arial, helvetica, sans-serif; color: #313a42;">
                <!-- Logo (branding) -->
                <table border="0" cellspacing="0" cellpadding="0" width="640" align="center" summary="" style="border-collapse: collapse;">
                  <tr>
                    <td class="logoContainer" align="center" style="font-family: arial, helvetica, sans-serif; color: #313a42;border-collapse: collapse; padding: 20px 0 10px 0px; width: 320px;">
                      <a href="http://dentallivramento.com.br" title="Lorem logo" style="color: #ffffff;">
                        <img class="logo" style="width: 300px; border: none; text-decoration: none;" src="http://dentalbeta.tk/view/templates/Email-Template-Html-Download-free/logo.png" alt="logo" />
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
          <table border="0" cellspacing="0" cellpadding="0" width="100%" summary="" class="featuredHeader" style="border-collapse: collapse; background: #00a0e3;">
            <tr>
              <td class="section" style="border-collapse: collapse; padding: 20px 0px 0px 0px;">
                <table border="0" cellspacing="0" cellpadding="0" width="640" align="center" summary="" style="border-collapse: collapse;">
                  <tr>
                    <td class="column" style="border-collapse: collapse;">
                      <table border="0" cellspacing="0" cellpadding="0" width="395" summary="" style="border-collapse: collapse;">
                        <tr>
                          <td class="featuredTitle" style="border-collapse: collapse; font-family: arial, helvetica, sans-serif; color: #ffffff; font-size: 26px; padding: 0px 0px 10px 0px; font-weight: bold;">
                            Você tem novos '.$titulo.'!
                          </td>
                        </tr>
                        <tr>
                          <td class="featuredContent" style="border-collapse: collapse; font-family: arial, helvetica, sans-serif; color: #ffffff;">
                            Pode ser que você tenha novos '.$titulo.'.<br>Acesse o site na sessão Admin e confira!
                          </td>
                        </tr>
                      </table>
                    </td>
                    <td id="featuredImage" class="column" style="border-collapse: collapse; display: block; margin: 0 auto;"><img src="http://dentalbeta.tk/view/templates/Email-Template-Html-Download-free/phone.png" width="234" alt="phone" /></td>
                  </tr>
                </table>
              </td>
            </tr>
          </table>
          <!-- End featuredHeader -->
          <!-- Section -->
          <table border="0" cellpadding="0" cellspacing="0" width="100%" summary="" style="border-collapse: collapse;">
            <tr>
              <td class="sectionEven" style="border-collapse: collapse; background-color: #ffffff;padding: 30px 0px 30px 0px;">
                <table border="0" cellpadding="0" cellspacing="0" width="640" align="center" summary="" style="border-collapse: collapse;">
                <tr>
                    <td class="buttonContainer" style="border-collapse: collapse; padding: 10px 20px 10px 20px;">
                      <table border="0" cellpadding="0" cellspacing="0" summary="" width="30%" align="center" style="border-collapse: collapse;">
                        <tr><td class="button" style="border-collapse: collapse; font-family: arial, helvetica, sans-serif; padding: 10px 5px 10px 5px; text-align: center; background-color: #00a0e3; border-radius: 4px;">
                          <a href="http://www.dentallivramento.com.br/Admin" title="ipsum" style="color: #ffffff; text-decoration: none; display: block; text-transform: uppercase;">acessar admin</a></td></tr>
                      </table>
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
          </table>
          <!-- End Section -->
          <!-- Social media -->
          <table border="0" cellspacing="0" cellpadding="0" width="100%" summary="" class="socialMedia" style="border-collapse: collapse; background: #556270;">
            <tr><td class="whitespace" height="20" style="border-collapse: collapse; font-family: 0px; line-height: 0px;">&nbsp;</td></tr>
            <tr>
              <td>
                <table border="0" cellspacing="0" cellpadding="0" width="120" align="center" summary="" style="border-collapse: collapse;">
                  <tr>
                    <td align="center" width="32" style="border-collapse: collapse;">
                      <a href="https://www.instagram.com/dentallivramento/" title="Twitter"><img src="https://clipart.info/images/ccovers/1522452763logo-instagram-png-white.png" width="29" alt="Instagram" style="border: none; text-decoration: none;" /></a>
                    </td>
                    <td align="center" width="32" style="border-collapse: collapse;">
                      <a href="https://www.facebook.com/DentalLivramento/" title="Facebook"><img src="http://dentalbeta.tk/view/templates/Email-Template-Html-Download-free/faceb.png" width="29" style="border: none; text-decoration: none;" alt="Facebook" /></a>
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
            <tr><td class="whitespace" height="10" style="border-collapse: collapse; font-family: 0px; line-height: 0px;">&nbsp;</td></tr>
          </table>
          <!-- End Social media -->
          <!-- FOOTER -->
          <table border="0" cellspacing="0" cellpadding="0" width="100%" summary="" class="footer" style="border-collapse: collapse;">
            <tbody><tr><td class="whitespace" height="10" style="border-collapse: collapse; font-family: 0px; line-height: 0px;">&nbsp;</td></tr>
            <tr>
              <td>
                <table border="0" cellspacing="0" cellpadding="0" align="center" summary="" style="border-collapse: collapse;">
                  <tbody><tr>
                    <td class="footNotes" align="center" style="border-collapse: collapse; padding: 0px 20px 0px 20px;">
                      <p title="Lorem" style="color: #556270; font-size: 13px; font-family: arial, helvetica, sans-serif; margin: 0 0 1.6em 0;">Este é um email automático, não responda. Para entrar em contato utilize os meios disponíveis pelo site.</p>
                    </td>
                  </tr>
                </tbody></table>
              </td>
            </tr>
            <tr><td class="whitespace" height="10" style="border-collapse: collapse; font-family: 0px; line-height: 0px;">&nbsp;</td></tr>
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
        $email = new Email('serjaoberranteiro666@gmail.com','serjaoberranteiro666@gmail.com','Teste topperson 3',$template_cliente,null);
        if($email->send()) echo "foi"; return true;
      }
    }

}
