<?php

class DestaqueModel extends Model {

    public function getDestaque() {
        $list = [];
        $sql = "SELECT * FROM destaque";
        $consulta = $this->ExecuteQuery($sql, array());
        foreach ($consulta as $linha) {
            $list[] = new Destaque($linha['id_destaque'],$linha['nome'],$linha['imagem'],$linha['id_categoria']);
        }
        return $list;
    }

    public function getDestaqueById($id) {
        $sql = "SELECT * FROM destaque WHERE id_destaque=:id;";
        $consulta = $this->ExecuteQuery($sql, [':id' => $id])[0];
        $destaque = $this->ExecuteQuery($sql, [':id' => $id])[0];
            return new Destaque( $destaque['id_destaque'],$destaque['nome'],$destaque['imagem'],$destaque['id_categoria']);
    }

    public function insertDestaque($destaque) {
        $sql = "INSERT INTO destaque(nome, imagem, id_categoria) VALUES(:nome, :imagem, :id_categoria)";
        if ($this->ExecuteCommand($sql,[':nome'=>$destaque->getNome(),':imagem'=>$destaque->getImagem(),':id_categoria'=>$destaque->getId_categoria()])){
            return true;
        } else {
            return false;
        }
    }

     public  function removeDestaque($id) {
        $sql = "DELETE FROM destaque WHERE id_destaque = :id";
        if ($this->ExecuteCommand($sql, [':id'=>$id])) {
            return true;
        } else {
            return false;
        }
    }

    public function updateDestaque($destaque) {
        $sql = "UPDATE destaque SET nome = :nome, imagem = :imagem, id_categoria = :id_categoria WHERE id_destaque = :id";
        $param = [':id'=>$destaque->getId_destaque(),':nome'=>$destaque->getNome(),':imagem'=>$destaque->getImagem(),':id_categoria'=>$destaque->getId_categoria()];
        if ($this->ExecuteCommand($sql,$param)) {
            return true;
        } else {
            return false;
        }
    }

    public function disableForeign() {
        $sql = "UPDATE destaque SET FOREIGN_KEY_CHECKS=0";
        if ($this->ExecuteCommand($sql)) {
            return true;
        } else {
            return false;
        }
    }

    public function enableForeign() {
        $sql = "UPDATE destaque SET FOREIGN_KEY_CHECKS=1";
        if ($this->ExecuteCommand($sql)) {
            return true;
        } else {
            return false;
        }
    }


}
