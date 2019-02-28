<?php
class Home extends Controller{

    protected $model;
    protected $modelproduto;
    protected $modelCategoria;
    protected $modelGrupo;

    public function __construct() {
        parent::__construct();
        $this->model = new HomeAdminModel();
        $this->modelproduto = new ProdutoModel();
        $this->modelCategoria = new CategoriaModel();
        $this->modelGrupo = new GrupoModel();
    }

    public function index(){
        $data['estilo'] = $this->model->getEstiloAtual();
        $data['categoria'] = $this->modelCategoria->getCategoria();
        $data['grupo'] = $this->modelGrupo->getGrupo();
        $this->view->load('header',$data);
        $this->view->load('nav-home',$data);
        $this->view->load('index', $data);
        $this->view->load('footer');
    }

    public function viewProduto($id){
        $data['estilo'] = $this->model->getEstiloAtual();

        $data['produto'] = $this->modelproduto->getProdutoById($id);

        //echo "<pre>";
        //var_dump($data['produto']);
        //echo "</pre>";
        //die;

        $this->view->load('header',$data['estilo']);
        $this->view->load('nav');
        $this->view->load('single-product',$data['produto']);
        $this->view->load('footer');
    }

}
