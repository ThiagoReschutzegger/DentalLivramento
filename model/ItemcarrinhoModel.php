<?php

class ItemcarrinhoModel extends Model {

    public function insertItemcarrinho($itemcarrinho) {
        $sql = "INSERT INTO itemcarrinho(barcode,quantidade,id_carrinho) VALUES(:barcode,:quantidade,:id_carrinho)";
        if ($this->ExecuteCommand($sql,[':barcode'=>$itemcarrinho->getBarcode(),':quantidade'=>$itemcarrinho->getQuantidade(),':id_carrinho'=>$itemcarrinho->getId_carrinho()])){
            return true;
        } else {
            return false;
        }
    }
    
    public function getItensById_carrinho($id) { // Edu
        $list = [];
        $sql = "SELECT * FROM itemcarrinho WHERE id_carrinho = :id ";
        $consulta = $this->ExecuteQuery($sql, [':id'=>$id]);
        foreach ($consulta as $linha):
            $list[] = new ItemCarrinhoBanco($linha['id_itemcarrinho'],$linha['barcode'],$linha['quantidade'],$linha['id_carrinho']);
        endforeach;
        return $list;
    }

}
