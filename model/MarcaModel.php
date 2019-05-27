<?php

class MarcaModel extends Model {

    public function getMarca() {
        $list = [];
        $sql = "SELECT * FROM marca";
        $consulta = $this->ExecuteQuery($sql, array());
        foreach ($consulta as $linha) {
            $list[] = new Marca($linha['id_marca'],$linha['nome'],$linha['imagem'],$linha['catalogo']);
        }
        return $list;
    }

    public function getMarcaById($id) {
        $sql = "SELECT * FROM marca WHERE id_marca=:id;";
        $consulta = $this->ExecuteQuery($sql, [':id' => $id])[0];
        $marca = $this->ExecuteQuery($sql, [':id' => $id])[0];
            return new Marca( $marca['id_marca'],$marca['nome'],$marca['imagem'],$marca['catalogo']);
    }

    public function insertMarca($marca) {
        $sql = "INSERT INTO marca(nome,imagem,catalogo) VALUES(:nome,:imagem,:catalogo)";
        if ($this->ExecuteCommand($sql,[':nome'=>$marca->getNome(),':imagem'=>$marca->getImagem(),':catalogo'=>$marca->getCatalogo()])){
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
        $sql = "UPDATE marca SET nome = :nome, imagem = :imagem, catalogo = :catalogo WHERE id_marca = :id";
        $param = [':id'=>$marca->getId_marca(),':nome'=>$marca->getNome(),':imagem'=>$marca->getImagem(),':catalogo'=>$marca->getCatalogo()];
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
            $list[] = new Marca($linha['id_marca'], $linha['nome'], $linha['imagem'], $linha['catalogo']);
        }
        //echo 'Mok';
        return $list;
    }

    public function getMarcaByProduto($ids) {
        $list = [];
        $num = count($ids);
        $i = 1;
        $comando = [];
        $sql = "SELECT marca.* FROM subgrupo JOIN marca ON subgrupo.id_marca=marca.id_marca WHERE";
        foreach ($ids as $id_subgrupo) {
          $comando[] = " id_subgrupo = ".$id_subgrupo;
        }
        while ($i <= $num){
          $sql = $sql.$comando[$i-1];
          if($i < $num){
            $sql = $sql.' OR ';
          }
          $i++;
        }
        $query = $this->ExecuteQuery($sql, array());
        foreach ($query as $linha) {
            $list[] = new Marca($linha['id_marca'], $linha['nome'], $linha['imagem'], $linha['catalogo']);
        }
        //echo 'Mok';
        return $list;
    }

}
