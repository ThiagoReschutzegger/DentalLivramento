<?php

class Foto {
    //put your code here
   private $id_foto;
   private $src;

   public function __construct($src,$id_foto=null) {
       $this->id_foto = $id_foto;
       $this->src = $src;
    }

    function getId_foto() {
        return $this->id_foto;
    }

    function getSrc() {
        return $this->src;
    }

    function setId_foto($id_foto) {
        $this->id_foto = $id_foto;
    }

    function setSrc($src) {
        $this->src = $src;
    }

    //Getters Setters PHP
    public function __set($name,$value){
        $this->$name = $value;
    }

    public function __get($name){
        return $this->$name;
    }

}
