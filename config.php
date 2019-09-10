<?php

//Simple MVC Configuration File
//Inicialização da variável $config
unset($config);
$config = new stdClass();
$config->defaultClass = "Home";
$config->base_url = '/DentalLivramento/';
$config->url = 'http://'.$_SERVER['HTTP_HOST']. $config->base_url;
$config->asset = $config->base_url . 'view/templates/';
$config->template = 'default';
//FTP: senha nome
//Database
if ($_SERVER['HTTP_HOST'] == "localhost" || $_SERVER['HTTP_HOST'] == "127.0.0.1") {
    $config->dbuser = 'root'; //nomedoaluno
    $config->dbpassword = ''; //senha
    $config->dbname = 'dentallivramento2'; //nomedobanco
    $config->dbhost = '127.0.0.1'; //servidor (127.0.0.1)
    $config->dbdrive = 'mysql';
} else {
    $config->dbuser = '2017_gill'; //nomedoaluno
    $config->dbpassword = 'g1ll'; //senha
    $config->dbname = '2017_gill'; //nomedobanco
    $config->dbhost = '127.0.0.1'; //servidor na web
    $config->dbdrive = 'mysql';
}
