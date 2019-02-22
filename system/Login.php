<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Login
 *
 * @author echoes
 */
class Login {

    //put your code here
    /**
     *
     * @var bool
     */
    private $logged;
    /**
     *
     * @var Session
     */
    private $session;

    /**
     *
     * @var Cookie
     */
    private $cookie;

    /**
     *
     * @var Usuario
     */
    private $user;

    /**
     *
     * @var UsuarioModel
     */
    private $model;

    public function __construct() {
        $this->session = new Session();
        $this->cookie = new Cookie();
        $this->model = new UsuarioModel();
        $this->logged = false;
    }

    public function verifyLogin($user) {
        $this->user = $this->model->getUsuarioByLogin($user->getLogin());
        if($this->user){
            if ($this->user->getSenha() == md5($user->getSenha())) {
                $this->logged = true;
            }
        }
        return $this->logged;
    }

    public function createSession() {
        $this->session->setSessionUser($this->user);
    }

    public function createCookies() {
        $this->cookie->setCookieUser($this->user);
    }

    public function getSession() {
        $this->session->getSessionUser();
    }

    public function getCookie() {
        $this->cookie->getCookieUser();
    }
    
    public function getLoggedUser(){
        if($this->session->isSessionExist()){
            return $this->getSession();
        }elseif($this->cookie->isCookieExist()){
            return $this->getCookie();
        }
    }

    public function isLogged() {
        if($this->session->isSessionExist() || $this->cookie->isCookieExist()){
            $this->logged = true;
        }else{
            $this->logged = false;
        }
        return $this->logged;
    }
    
    public function logout(){
        $this->session->destroySession();
        $this->cookie->destroyCookie();
    }
}
