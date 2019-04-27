<?php

class MensagemModel extends Model {

    public function getMensagem() {
        $list = [];
        $sql = "SELECT * FROM mensagem";
        $consulta = $this->ExecuteQuery($sql, array());
        foreach ($consulta as $linha) {
            $list[] = new Mensagem($linha['id_mensagem'],$linha['email'],$linha['mensagem'],$linha['data']);
        }
        return $list;
    }

    public function getMensagemById($id) {
        $sql = "SELECT * FROM mensagem WHERE id_mensagem=:id;";
        $mensagem = $this->ExecuteQuery($sql, [':id' => $id])[0];
            return new Mensagem( $mensagem['id_mensagem'],$mensagem['email'],$mensagem['mensagem'],$mensagem['imagem'],$mensagem['mensagem']);
    }

    public function insertMensagem($mensagem) {
        $sql = "INSERT INTO mensagem(email,mensagem,data) VALUES(:email,:mensagem,:data)";
        if ($this->ExecuteCommand($sql,[':email'=>$mensagem->getEmail(),':mensagem'=>$mensagem->getMensagem(),':data'=>$mensagem->getData()])){
            return true;
        } else {
            return false;
        }
    }

     public  function removeMensagem($id) {
        $sql = "DELETE FROM mensagem WHERE id_mensagem = :id";
        if ($this->ExecuteCommand($sql, [':id'=>$id])) {
            return true;
        } else {
            return false;
        }
    }

}
