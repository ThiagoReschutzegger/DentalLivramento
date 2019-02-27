<?php
class Home extends Controller{

    protected $model;
    
    public function __construct() {
        parent::__construct();
        $this->model = new HomeAdminModel();
    }

    public function index(){
        $data['estilo'] = $this->model->getEstiloAtual();
        
        $this->view->load('header',$data['estilo']);
        $this->view->load('nav');
        $this->view->load('index');
        $this->view->load('footer');
    }

    public function viewProduto(){
        $data['estilo'] = $this->model->getEstiloAtual();
        
        $this->view->load('header',$data['estilo']);
        $this->view->load('nav');
        $this->view->load('single-product');
        $this->view->load('footer');
    }

}
