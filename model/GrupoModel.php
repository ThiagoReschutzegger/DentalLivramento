<?php

class GrupoModel extends Model {

    public function getGrupo() {
        $list = [];
        $sql = "SELECT * FROM grupo ORDER BY nome asc";
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

    public function getGrupoBySubgrupoId($id) {
        $list = [];
        $sql = "SELECT grupo.* FROM subgrupo JOIN grupo ON subgrupo.id_grupo=grupo.id_grupo WHERE id_subgrupo = :id";
        $query = $this->ExecuteQuery($sql, [':id' => $id]);
        foreach ($query as $linha) {
            $list[] = new Grupo($linha['id_grupo'], $linha['nome'], $linha['id_categoria']);
        }
        //echo 'Gok';
        return $list;
    }

    public function getAllGrupos() {

        $list = [];

        $sql = "SELECT id_grupo,nome from grupo";
        $consulta = $this->ExecuteQuery($sql, $list);

        foreach ($consulta as $linha) {
          $list[] = [$linha['id_grupo'],$linha['nome']];
        }
        //echo '<pre>';var_dump($list);echo '</pre>';die;
        return $list;
    }

    public function insertGrupoTxt($nome,$id) {
        $sql = "INSERT INTO grupo(nome,id_categoria) VALUES(:nome,:id)";
        if ($this->ExecuteCommand($sql,[':nome'=>$nome,':id'=>$id])){
            return true;
        } else {
            return false;
        }
    }

    public function getIdByNome($nome) {
        $list = [];
        $sql = "SELECT id_grupo FROM grupo WHERE nome = :nome";
        $query = $this->ExecuteQuery($sql, [':nome' => $nome]);
        return $query[0]['id_grupo'];
    }


    public function getIdCategoriaByGrupoId($id) {
        $list = [];
        $sql = "SELECT id_categoria FROM grupo WHERE id_grupo = :id";
        $query = $this->ExecuteQuery($sql, [':id' => $id]);
        var_dump($query);die;
        return $query['id_categoria'];
    }



    public function verifyGrupo($grupo,$id_categoria){
      $list = [];
      $sql = "SELECT nome FROM grupo WHERE id_categoria = :id";
      $query = $this->ExecuteQuery($sql, [':id' => $id_categoria]);
      foreach ($query as $linha) {
        $list[] = $linha['nome'];
      }

      $i = 0;
      foreach ($list as $linha) {
        if(strtoupper($grupo) == strtoupper($linha)){
          return true;
        }
      }
      return false;

    }



}
