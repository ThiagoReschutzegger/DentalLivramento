<?php

class View {
    //put your code here
    private $base_url;
    private $url;
    private $asset;
    private $template;

    public function __construct() {
        include 'config.php';
        if ($config) {
            $this->base_url = $config->base_url;
            $this->url  = $config->url;
            $this->asset = $config->asset;
            $this->template = $config->template;
            $this->asset.=$this->template . "/";
        }
    }
    
    public function index(){
        $this->location($this->url);
    }

    public function load($page, $data = null) {
       
        include_once "view/templates/" . $this->template . "/$page.php";
    
        
    }
    

    public function setTemplate($template) {
        include 'config.php';
        $this->asset = $config->asset;
        $this->template = $template;
         $this->asset.=$this->template . "/";
    }
    
    public function location($url){
         header("Location: $url");
    }

}
