<?php

class ItemModel extends Model {

    public function getItem() {
        $list = [];
        $sql = "SELECT * FROM item";
        $consulta = $this->ExecuteQuery($sql, array());
        foreach ($consulta as $item) {
            $list[] = new Item($item['id_item'], $item['descricao'], $item['imagem'], $item['destaque'], $item['id_subgrupo'], $item['id_marca']);
        }
        return $list;
    }
    
    public function getItemBySubgrupo($id) {
        $list = [];
        $sql = "SELECT * FROM item WHERE id_subgrupo = :id ORDER BY id_item DESC";
        $consulta = $this->ExecuteQuery($sql, [':id' => $id]);
        foreach ($consulta as $item) {
            $list[] = new Item($item['id_item'], $item['descricao'], $item['imagem'], $item['destaque'], $item['id_subgrupo'], $item['id_marca']);
        }
        return $list;
    }
    
    
    public function getItemById($id) {
        $sql = "SELECT * FROM item WHERE id_item = :id;";
        $item = $this->ExecuteQuery($sql, [':id' => $id])[0];
        return new Item($item['id_item'], $item['descricao'], $item['imagem'], $item['destaque'], $item['id_subgrupo'], $item['id_marca']);
    }

    public function getItemDestaque() { //Edu
        $list = [];
        $sql = "SELECT * FROM item WHERE destaque = 1";
        $consulta = $this->ExecuteQuery($sql, array());
        foreach ($consulta as $item) {
            $list[] = new Item($item['id_item'], $item['descricao'], $item['imagem'], $item['destaque'], $item['id_subgrupo'], $item['id_marca']);
        }
        return $list;
    }

//    public function getIdBy($nome, $descricao, $imagem) {
//        $sql = "SELECT * FROM item WHERE nome = :nome AND descricao = :descricao AND imagem = :imagem;";
//        $item = $this->ExecuteQuery($sql, [':nome' => $nome, ':descricao' => $descricao, ':imagem' => $imagem ])[0];
//        return new Item($item['id_item'], $item['nome'], $item['descricao'], $item['imagem'],  $item['destaque'], $item['id_subgrupo'], $item['id_marca']);
//    }

//    public function getItemByGrupo($id) {
//        $list = [];
//        $sql = "SELECT * FROM item WHERE id_subgrupo = :id;";
//        $consulta = $this->ExecuteQuery($sql, [':id' => $id]);
//        foreach ($consulta as $item) {
//            $list[] = new Item($item['id_item'], $item['nome'], $item['descricao'], $item['imagem'], $item['destaque'], $item['id_subgrupo'], $item['id_marca']);
//        }
//        return $list;
//    }

    public function insertItem($item) {
        $sql = "INSERT INTO item(descricao,imagem,destaque,id_subgrupo,id_marca) VALUES(:descricao,:imagem,:destaque,:id_subgrupo,:id_marca)";
        if ($this->ExecuteCommand($sql, [':descricao' => $item->getDescricao(),
                                        ':imagem' => $item->getImagem(),
                                        ':destaque' => $item->getDestaque(),
                                        ':id_subgrupo' => $item->getId_subgrupo(),
                                        ':id_marca' => $item->getId_marca()
                                    ])) {
            return true;
        } else {
            return false;
        }
    }

    public function removeItem($id) {
        $sql = "DELETE FROM item WHERE id_item = :id";
        if ($this->ExecuteCommand($sql, [':id' => $id])) {
            return true;
        } else {
            return false;
        }
    }

    public function updateItem($item) {
        $sql = "UPDATE item SET descricao = :descricao, imagem = :imagem, destaque = :destaque, id_subgrupo = :id_subgrupo, id_marca = :id_marca WHERE id_item = :id_item";
        $param = [':id_item' => $item->getId_item(),
                  ':descricao' => $item->getDescricao(),
                  ':imagem' => $item->getImagem(),
                  ':destaque' => $item->getDestaque(),
                  ':id_subgrupo' => $item->getId_subgrupo(),
                  ':id_marca' => $item->getId_marca()
                ];
        if ($this->ExecuteCommand($sql, $param)) {
            return true;
        } else {
            return false;
        }
    }

//    public function searchItem($nome, $codigo) {
//        $list = [];
//
//        if($nome == '' && $codigo != ''){
//            $sql = "SELECT * FROM item WHERE (barcode LIKE '%{$codigo}%')";
//        }
//        if($nome != '' && $codigo == ''){
//            $sql = "SELECT * FROM item WHERE (nome LIKE '%{$nome}%')";
//        }
//        if($nome != '' && $codigo != ''){
//            $sql = "SELECT * FROM item WHERE (barcode LIKE '%{$codigo}%' OR nome LIKE '%{$nome}%')";
//        }
//        $consulta = $this->ExecuteQuery($sql,array());
//
//        foreach ($consulta as $linha) {
//            $list[] = new Item($linha['id_item'], $linha['barcode'], $linha['preco'], $linha['nome'], $linha['estoque'], $linha['imagem'], $linha['descricao'], $linha['destaque'], $linha['tipo'], $linha['id_subgrupo'], $linha['id_marca']);
//        }
//        return $list;
//    }

    public function removeDestaque($id) { //EDU
        $sql = "UPDATE item SET destaque = 0 WHERE id_item = :id";
        if ($this->ExecuteCommand($sql, [':id' => $id])) {
            return true;
        } else {
            return false;
        }
    }
    public function addDestaque($id) { //EDU
        $sql = "UPDATE item SET destaque = 1 WHERE id_item = :id";
        if ($this->ExecuteCommand($sql, [':id' => $id])) {
            return true;
        } else {
            return false;
        }
    }



}
