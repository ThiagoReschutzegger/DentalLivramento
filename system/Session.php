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

    public function getSessionUser() {
        return (isset($_SESSION['user'])) ? $_SESSION['user'] : false;
    }

    public function setSessionAtribute($nome, $valor) {
        $_SESSION['user'][$nome] = $value;
    }

    public function getSessionAtribute($nome) {
        return $_SESSION['user'][$nome];
    }

    public function isSessionExist() {
        return (isset($_SESSION['user'])) ? true : false;
    }

    public function destroySession() {
        session_destroy();
    }

}
