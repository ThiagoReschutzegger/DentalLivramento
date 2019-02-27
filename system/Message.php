<?php

class Message{

    public static function setMsg($msg, $tipo='sucesso'){
        $_SESSION['msg'][$tipo] = $msg;

    }

    public static function getMsg(){
        $msg="";

        if(isset($_SESSION['msg']['sucesso']) && $_SESSION['msg']['sucesso']!=null){
             $msg="<div class=\"alert alert-succes\">";
             $msg.= $_SESSION['msg']['sucesso'];
             $msg.="</div>";
        }

        $_SESSION['msg']['sucesso']=null;

        $msg .="";
        if(isset($_SESSION['msg']['erro'])&& $_SESSION['msg']['erro']!=null){
             $msg="<div class=\"alert alert-succes\">";
             $msg.= $_SESSION['msg']['erro'];
             $msg.="</div>";
        }
          $_SESSION['msg']['erro']=null;
        return $msg;
    }
}
