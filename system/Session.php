<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SessionLogin
 *
 * @author echoes
 */
class Session {

    //put your code here

    public function __construct() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function setSessionUser($user) {
        $_SESSION['user'] = $user;
    }

    public function setSessionCarrinho($carrinho) {
        $_SESSION['carrinho'] = $carrinho;
    }

    public function getSessionUser() {
        return (isset($_SESSION['user'])) ? $_SESSION['user'] : false;
    }

    public function getSessionCarrinho() {
        return (isset($_SESSION['carrinho'])) ? $_SESSION['carrinho'] : false;
    }

    public function setSessionAtribute($nome, $valor) {
        $_SESSION['user'][$nome] = $valor;
    }

    public function setSessionCarrinhoAtribute($nome, $valor) {
        $_SESSION['carrinho'][$nome] = $valor;
    }

    public function getSessionAtribute($nome) {
        return $_SESSION['user'][$nome];
    }

    public function getSessionCarrinhoAtribute($nome) {
        return $_SESSION['carrinho'][$nome];
    }

    public function isSessionExist() {
        return (isset($_SESSION['user'])) ? true : false;
    }

    public function isSessionCarrinhoExist() {
        return (isset($_SESSION['carrinho'])) ? true : false;
    }

    public function destroySession() {
        session_destroy();
    }

}

?>
