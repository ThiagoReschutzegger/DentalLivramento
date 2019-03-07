<?php

class MarcaModel extends Model {

    public function getMarca() {
        $list = [];
        $sql = "SELECT * FROM marca";
        $consulta = $this->ExecuteQuery($sql, array());
        foreach ($consulta as $linha) {
            $list[] = new Marca($linha['id_marca'],$linha['nome'],$linha['imagem']);
        }
        return $list;
    }

    public function getMarcaById($id) {
        $sql = "SELECT * FROM marca WHERE id_marca=:id;";
        $consulta = $this->ExecuteQuery($sql, [':id' => $id])[0];
        $marca = $this->ExecuteQuery($sql, [':id' => $id])[0];
            return new Marca( $marca['id_marca'],$marca['nome'],$marca['imagem']);
    }

    public function insertMarca($marca) {
        $sql = "INSERT INTO marca(nome,imagem) VALUES(:nome,:imagem)";
        if ($this->ExecuteCommand($sql,[':nome'=>$marca->getNome(),':imagem'=>$marca->getImagem()])){
            return true;
        } else {
            return false;
        }
    }

     public  function removeMarca($id) {
        $sql = "DELETE FROM marca WHERE id_marca = :id";
        if ($this->ExecuteCommand($sql, [':id'=>$id])) {
            return true;
        } else {
            return false;
        }
    }

    public function updateMarca($marca) {
        $sql = "UPDATE marca SET nome = :nome, imagem = :imagem  WHERE id_marca = :id";
        $param = [':id'=>$marca->getId_marca(),':nome'=>$marca->getNome(),':imagem'=>$marca->getImagem()];
        if ($this->ExecuteCommand($sql,$param)) {
            return true;
        } else {
            return false;
        }
    }

    public function getMarcaBySubgrupoId($id) {
        $list = [];
        $sql = "SELECT marca.* FROM subgrupo JOIN marca ON subgrupo.id_marca=marca.id_marca WHERE id_subgrupo = :id";
        $query = $this->ExecuteQuery($sql, [':id' => $id]);
        foreach ($query as $linha) {
            $list[] = new Marca($linha['id_marca'], $linha['nome'], $linha['imagem']);
        }
        //echo 'Mok';
        return $list;
    }

}
