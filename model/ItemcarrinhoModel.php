<?php

class ItemcarrinhoModel extends Model {

    public function insertItemcarrinho($itemcarrinho) {
        $sql = "INSERT INTO itemcarrinho(id_produto,quantidade,id_carrinho) VALUES(:id_produto,:quantidade,:id_carrinho)";
        if ($this->ExecuteCommand($sql,[':id_produto'=>$itemcarrinho->getId_produto(),':quantidade'=>$itemcarrinho->getQuantidade(),':id_carrinho'=>$itemcarrinho->getId_carrinho()])){
            return true;
        } else {
            return false;
        }
    }

}
