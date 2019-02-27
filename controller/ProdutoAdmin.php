<?php

class ProdutoAdmin extends Admin {

    protected $model;

    public function __construct() {
        parent::__construct();
    }

    public function index() {
      $this->view->load('header');
      $this->view->load('nav');
      $this->view->load('produto');
      $this->view->load('footer');
    }

}
