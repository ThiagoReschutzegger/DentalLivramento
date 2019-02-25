<?php

class Admin extends Controller {

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
      $this->view->load('index');
      $this->view->load('footer');
    }

    public function login() {
        $data['msg'] = '';
        if (filter_input(INPUT_POST, 'logar')) {
            $login = filter_input(INPUT_POST, 'login', FILTER_SANITIZE_STRING);
            $senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_STRING);
            if ($login && $senha) {
                if ($this->login->verifyLogin(new Usuario($login, $senha))) {
                    if (filter_input(INPUT_POST, 'lembrar')) {
                        $this->login->createCookies();
                    }
                    $this->login->createSession();

                    $_SESSION['sessao'] = $login;

                    $data['msg'] = '';
                } else {
                    $data['msg'] = 'Usuario o contraseña inválidas';
                }
            } else {
                $data['msg'] = 'Erro: informe os campos login e senha corretamente!';
            }
        }
        if ($this->login->isLogged()) {
            //Recarrega a página
            //var_dump($_SESSION);
            //die;
            $this->index();

        } else {
          $this->view->load('header');
          $this->view->load('login', $data);
        }
    }

    public function logout() {
        $this->login->logout();
        header('location:' . $this->config->base_url . 'Admin');
    }

}
