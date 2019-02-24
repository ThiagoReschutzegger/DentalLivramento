<?php

class MarcaAdmin extends Controller {

    protected $login;

    public function __construct() {
        parent::__construct();
        $this->view->setTemplate('admin');
        $this->login = new Login();
        if (!$this->login->isLogged()) {
            $this->login();
            die;
        }
    }

    public function index() {
      $this->view->load('header');
      $this->view->load('nav');
      $this->view->load('marca');
      $this->view->load('footer');
    }

}
