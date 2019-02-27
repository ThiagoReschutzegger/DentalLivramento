<?php
class Home extends Controller{

    protected $model;
    protected $modelproduto;
    
    public function __construct() {
        parent::__construct();
        $this->model = new HomeAdminModel();
        $this->modelproduto = new ProdutoModel();
    }

    public function index(){
        $data['estilo'] = $this->model->getEstiloAtual();
        
        $this->view->load('header',$data['estilo']);
        $this->view->load('nav-home');
        $this->view->load('index');
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
