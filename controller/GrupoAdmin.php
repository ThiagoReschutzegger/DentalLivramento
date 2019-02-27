<?php

class GrupoAdmin extends Admin {

    //protected $model; -> mais alem

    public function __construct() {
        parent::__construct();
    }

    public function index() {
      $this->view->load('header');
      $this->view->load('nav');
      $this->view->load('grupo');
      $this->view->load('footer');
    }

}
