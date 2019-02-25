<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Controller
 *
 * @author Professor
 */
class Controller {

    protected $config;
    private $query;

    /**
     * @var View
     */
    protected $view;

    /**
     *
     * @var Model;
     */
    protected $model;

    public function __construct() {
        include 'config.php';
        $this->config = $config;
        $this->view = new View();
    }

    public function filter($input) {
        return filter_input(INPUT_POST, $input, FILTER_SANITIZE_STRING);
    }

    public function route($query = null) {
        $class = null;
        $this->query = $query;
        if ($this->query) {
            $this->query = explode('/', $this->query);
            $class_name = $this->query[0];
            if (count($this->query) > 1) {
                $method = $this->query[1];
            } else {
                $method = null;
            }
            $param = (count($this->query) > 2) ? $this->query[2] : null;
            if (class_exists($class_name)) {
                $class = new $class_name;
                if ($class instanceof Controller) {
                    if (method_exists($class, $method)) {
                        if ($param) {
                            $class->$method($param);
                        } else {
                            $class->$method();
                        }
                    } else {
                        if (method_exists($class, 'index')) {
                            $class->index();
                        } else {
                            $this->view->index();
                        }
                    }
                }
            }
        }

        if (!$class) {
            $class = new $this->config->defaultClass;
            $class->index();
        }
    }

    public function reload(){
        header('Location: '.$_SERVER['HTTP_REFERER']);
    }
}
