<?php

class GrupoModel extends Model {

    public function getGrupo() {
        $list = [];
        $sql = "SELECT * FROM grupo";
        $consulta = $this->ExecuteQuery($sql, array());
        foreach ($consulta as $linha) {
            $list[] = new Grupo($linha['id_grupo'],$linha['nome'],$linha['id_categoria']);
        }
        return $list;
    }

    public function getGrupoById($id) {
        $sql = "SELECT * FROM grupo WHERE id_grupo=:id;";
        $consulta = $this->ExecuteQuery($sql, [':id' => $id])[0];
        $grupo = $this->ExecuteQuery($sql, [':id' => $id])[0];
            return new Grupo( $grupo['id_grupo'],$grupo['nome'],$grupo['id_categoria']);
    }

    public function insertGrupo($grupo) {
        $sql = "INSERT INTO grupo(nome, id_categoria) VALUES(:nome, :id_categoria)";
        var_dump($grupo);
        if ($this->ExecuteCommand($sql,[':nome'=>$grupo->getNome(),':id_categoria'=>$grupo->getId_categoria()])){
            return true;
        } else {
            return false;
        }
    }

     public  function removeGrupo($id) {
        $sql = "DELETE FROM grupo WHERE id_grupo = :id";
        if ($this->ExecuteCommand($sql, [':id'=>$id])) {
            return true;
        } else {
            return false;
        }
    }

    public function updateGrupo($grupo) {
        $sql = "UPDATE grupo SET nome = :nome, id_categoria = :id_categoria WHERE id_grupo = :id";
        $param = [':id'=>$grupo->getId_grupo(),':nome'=>$grupo->getNome(),':id_categoria'=>$grupo->getId_categoria()];
        if ($this->ExecuteCommand($sql,$param)) {
            return true;
        } else {
            return false;
        }
    }

    public function disableForeign() {
        $sql = "UPDATE grupo SET FOREIGN_KEY_CHECKS=0";
        if ($this->ExecuteCommand($sql)) {
            return true;
        } else {
            return false;
        }
    }

    public function enableForeign() {
        $sql = "UPDATE grupo SET FOREIGN_KEY_CHECKS=1";
        if ($this->ExecuteCommand($sql)) {
            return true;
        } else {
            return false;
        }
    }


}
