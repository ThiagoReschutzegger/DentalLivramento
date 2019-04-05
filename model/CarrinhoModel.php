<?php

class CarrinhoModel extends Model {

    public function getCarrinho() {
        $list = [];
        $sql = "SELECT * FROM carrinho";
        $consulta = $this->ExecuteQuery($sql, array());
        foreach ($consulta as $linha) {
            $list[] = new Carrinho($linha['id_carrinho']);
        }
        return $list;
    }

    public function getCarrinhoById($id) {
        $sql = "SELECT * FROM carrinho WHERE id_carrinho=:id;";
        $marca = $this->ExecuteQuery($sql, [':id' => $id])[0];
            return new Marca( $marca['id_carrinho']);
    }

    public function insertCarrinho() {
        $sql = "INSERT INTO carrinho (id_carrinho) VALUES (NULL);";
        if($this->ExecuteCommand($sql,array())){
            return true;
        } else {
            return false;
        }
    }

    public function getLastIdInserted(){
      $sql = "SELECT id_carrinho FROM carrinho ORDER BY id_carrinho DESC LIMIT 1";
      $consulta = $this->ExecuteQuery($sql, array());
      return $consulta[0]['id_carrinho'];
    }

}
