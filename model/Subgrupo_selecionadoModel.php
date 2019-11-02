<?php

class Subgrupo_selecionadoModel extends Model {

    public function getSubgrupo_selecionado() {
        $list = [];
        $sql = "SELECT * FROM subgrupo_selecionado";
        $consulta = $this->ExecuteQuery($sql, array());
        foreach ($consulta as $subgrupo_selecionado) {
            $list[] = new Subgrupo_selecionado($subgrupo_selecionado['id_selecionado'], $subgrupo_selecionado['id_subgrupo'], $subgrupo_selecionado['imagem']);
        }
        return $list;
    }

    public function getSubgrupo_selecionadoById($id) {
        $sql = "SELECT * FROM subgrupo_selecionado WHERE id_selecionado=:id;";
        $consulta = $this->ExecuteQuery($sql, [':id' => $id])[0];
        $subgrupo_selecionado = $this->ExecuteQuery($sql, [':id' => $id])[0];
            return new Subgrupo_selecionado($subgrupo_selecionado['id_selecionado'], $subgrupo_selecionado['id_subgrupo'], $subgrupo_selecionado['imagem']);
    }

    public function insertSubgrupo_selecionado($subgrupo_selecionado) {
        $sql = "INSERT INTO subgrupo_selecionado(id_subgrupo,imagem) VALUES(:id_subgrupo,:imagem)";
        if ($this->ExecuteCommand($sql,[':id_subgrupo'=>$subgrupo_selecionado->getId_subgrupo(),':imagem'=>$subgrupo_selecionado->getImagem()])){
            return true;
        } else {
            return false;
        }
    }

     public  function removeSubgrupo_selecionado($id) {
        $sql = "DELETE FROM subgrupo_selecionado WHERE id_selecionado = :id";
        if ($this->ExecuteCommand($sql, [':id'=>$id])) {
            return true;
        } else {
            return false;
        }
    }

}
