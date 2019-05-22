<?php

class FotoModel extends Model {

    public function getFoto() {

        $list = [];
        $sql = "SELECT * FROM foto";
        $consulta = $this->ExecuteQuery($sql, array());
        foreach ($consulta as $linha) {
            $list[] = new Foto($linha['src'],$linha['id_foto']);
        }
        return $list;
    }

    public function getFotoById($id) {

        $sql = "SELECT * FROM foto WHERE id_foto=:id;";
        $foto = $this->ExecuteQuery($sql, [':id' => $id])[0];
            return new Foto($foto['src'],$foto['id_foto']);
    }

    public function insertFoto($foto) {
        $sql = "INSERT INTO foto(src) VALUES(:src)";
        if ($this->ExecuteCommand($sql,[':src'=>$foto->getSrc()])){
            return true;
        } else {
            return false;
        }
    }

     public  function removeFoto($id) {
        $sql = "DELETE FROM foto WHERE id_foto = :id";
        if ($this->ExecuteCommand($sql, [':id'=>$id])) {
            return true;
        } else {
            return false;
        }
    }

}
