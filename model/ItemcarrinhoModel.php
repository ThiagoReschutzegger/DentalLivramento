<?php

class ItemcarrinhoModel extends Model {

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

    public function insertItemcarrinho($itemcarrinho) {
        $sql = "INSERT INTO itemcarrinho(id_produto,quantidade,id_carrinho) VALUES(:id_produto,:quantidade,:id_carrinho)";
        if ($this->ExecuteCommand($sql,[':id_produto'=>$itemcarrinho->getId_produto(),':quantidade'=>$itemcarrinho->getQuantidade(),':id_carrinho'=>$itemcarrinho->getId_carrinho()])){
            return true;
        } else {
            return false;
        }
    }

}
