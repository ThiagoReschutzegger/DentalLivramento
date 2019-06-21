<?php

class CategoriaModel extends Model {

    public function getCategoria() {
        $list = [];
        $sql = "SELECT * FROM categoria ORDER BY nome asc";
        $consulta = $this->ExecuteQuery($sql, array());
        foreach ($consulta as $linha) {
            $list[] = new Categoria($linha['id_categoria'],$linha['nome'],$linha['descricao'],$linha['imagem']);
        }
        return $list;
    }

    public function getCategoriaById($id) {
        $sql = "SELECT * FROM categoria WHERE id_categoria=:id;";
        $consulta = $this->ExecuteQuery($sql, [':id' => $id])[0];
        $categoria = $this->ExecuteQuery($sql, [':id' => $id])[0];
            return new Categoria( $categoria['id_categoria'],$categoria['nome'],$categoria['descricao'],$categoria['imagem']);
    }

    public function insertCategoria($categoria) {
        $sql = "INSERT INTO categoria(nome,descricao,imagem) VALUES(:nome,:descricao,:imagem)";
        if ($this->ExecuteCommand($sql,[':nome'=>$categoria->getNome(),':descricao'=>$categoria->getDescricao(),':imagem'=>$categoria->getImagem()])){
            return true;
        } else {
            return false;
        }
    }

     public  function removeCategoria($id) {
        $sql = "DELETE FROM categoria WHERE id_categoria = :id";
        if ($this->ExecuteCommand($sql, [':id'=>$id])) {
            return true;
        } else {
            return false;
        }
    }

    public function updateCategoria($categoria) {
        $sql = "UPDATE categoria SET nome = :nome, imagem = :imagem, descricao = :descricao  WHERE id_categoria = :id";
        $param = [':id'=>$categoria->getId_categoria(),':nome'=>$categoria->getNome(),':descricao'=>$categoria->getDescricao(),':imagem'=>$categoria->getImagem()];
        if ($this->ExecuteCommand($sql,$param)) {
            return true;
        } else {
            return false;
        }
    }

    public function getCategoriaByGrupoId($id) {
        $list = [];
        $sql = "SELECT categoria.* FROM grupo JOIN categoria ON grupo.id_categoria=categoria.id_categoria WHERE id_grupo = :id";
        $query = $this->ExecuteQuery($sql, [':id' => $id]);
        foreach ($query as $linha) {
            $list[] = new Categoria($linha['id_categoria'], $linha['nome'], $linha['descricao'], $linha['imagem']);
        }
        //echo 'Cok';
        return $list;
    }

}
