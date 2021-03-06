<?php

class ItemModel extends Model {

    public function getItem() {
        $list = [];
        $sql = "SELECT * FROM item";
        $consulta = $this->ExecuteQuery($sql, array());
        foreach ($consulta as $item) {
            $list[] = new Item($item['id_item'], $item['descricao'], $item['imagem'], $item['destaque'], $item['selecionado'], $item['tipo'], $item['id_subgrupo'], $item['id_marca']);
        }
        return $list;
    }

    public function getItemBySubgrupo($id) {
        $list = [];
        $sql = "SELECT * FROM item WHERE id_subgrupo = :id ORDER BY id_item DESC";
        $consulta = $this->ExecuteQuery($sql, [':id' => $id]);
        foreach ($consulta as $item) {
            $list[] = new Item($item['id_item'], $item['descricao'], $item['imagem'], $item['destaque'], $item['selecionado'], $item['tipo'], $item['id_subgrupo'], $item['id_marca']);
        }
        return $list;
    }

    public function getItemByIds($id_subgrupo, $ids_marca) { //Edu,
          $list = [];

            $string = "AND (id_marca = ";
            if(is_array($ids_marca)):
                foreach ($ids_marca as $id){
                    $string = $string.$id." OR id_marca = "; //15 charcter
                }
            else:
                $string = $string.$ids_marca." OR id_marca = ";
            endif;

            $string = substr($string, 0, -15);

          $sql = "SELECT * FROM item WHERE id_subgrupo=:id_subgrupo ".$string.")";
          $consulta = $this->ExecuteQuery($sql, [':id_subgrupo' => $id_subgrupo]);
          foreach ($consulta as $item) {
            $list[] = new Item($item['id_item'], $item['descricao'], $item['imagem'], $item['destaque'], $item['selecionado'], $item['tipo'], $item['id_subgrupo'], $item['id_marca']);
        }
          return $list;
      }


    public function getItemById($id) {
        $sql = "SELECT * FROM item WHERE id_item = :id;";
        $item = $this->ExecuteQuery($sql, [':id' => $id])[0];
        return new Item($item['id_item'], $item['descricao'], $item['imagem'], $item['destaque'], $item['selecionado'], $item['tipo'], $item['id_subgrupo'], $item['id_marca']);
    }

    public function getItemDestaque() { //Edu
        $list = [];
        $sql = "SELECT * FROM item WHERE destaque = 1";
        $consulta = $this->ExecuteQuery($sql, array());
        foreach ($consulta as $item) {
            $list[] = new Item($item['id_item'], $item['descricao'], $item['imagem'], $item['destaque'], $item['selecionado'], $item['tipo'], $item['id_subgrupo'], $item['id_marca']);
        }
        return $list;
    }
    
    public function getItemSelecionado() { //Edu
        $list = [];
        $sql = "SELECT * FROM item WHERE selecionado = '1'";
        $consulta = $this->ExecuteQuery($sql, array());
        foreach ($consulta as $item) {
            $list[] = new Item($item['id_item'], $item['descricao'], $item['imagem'], $item['destaque'], $item['selecionado'], $item['tipo'], $item['id_subgrupo'], $item['id_marca']);
        }
        return $list;
    }

    public function getItemRelacionados($id_subgrupo) { //Edu
        $list = [];
        $sql = "SELECT * FROM item WHERE id_subgrupo = :id_subgrupo ORDER BY RAND() LIMIT 4";
        $consulta = $this->ExecuteQuery($sql, [':id_subgrupo' => $id_subgrupo]);
        foreach ($consulta as $item) {
            $list[] = new Item($item['id_item'], $item['descricao'], $item['imagem'], $item['destaque'], $item['selecionado'], $item['tipo'], $item['id_subgrupo'], $item['id_marca']);
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
        $sql = "INSERT INTO item(descricao,imagem,destaque,tipo,id_subgrupo,id_marca) VALUES(:descricao,:imagem,:destaque,:tipo,:id_subgrupo,:id_marca)";
        if ($this->ExecuteCommand($sql, [':descricao' => $item->getDescricao(),
                                        ':imagem' => $item->getImagem(),
                                        ':destaque' => $item->getDestaque(),
                                        ':tipo' => $item->getTipo(),
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
        $sql = "UPDATE item SET descricao = :descricao, imagem = :imagem, destaque = :destaque, selecionado = :selecionado, tipo = :tipo, id_subgrupo = :id_subgrupo, id_marca = :id_marca WHERE id_item = :id_item";
        $param = [':id_item' => $item->getId_item(),
                  ':descricao' => $item->getDescricao(),
                  ':imagem' => $item->getImagem(),
                  ':destaque' => $item->getDestaque(),
                  ':selecionado' => $item->getSelecionado(),
                  ':tipo' => $item->getTipo(),
                  ':id_subgrupo' => $item->getId_subgrupo(),
                  ':id_marca' => $item->getId_marca()
                ];
        if ($this->ExecuteCommand($sql, $param)) {
            return true;
        } else {
            return false;
        }
    }

    public function updateTodosSemImagem() {
        $sql = "UPDATE item SET imagem=:imagem WHERE imagem=''";
        $param = [':imagem' => $this->asset."view/images/produto-sem-imagem.gif"];
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

    public function getAllItens() {

        $list = [];

        $sql = "SELECT id_item,tipo,id_subgrupo,id_marca from item";
        $consulta = $this->ExecuteQuery($sql, $list);

        foreach ($consulta as $linha) {
          $list[] = [$linha['id_item'],$linha['tipo'],$linha['id_subgrupo'],$linha['id_marca']];
        }
        //echo '<pre>';var_dump($list);echo '</pre>';die;
        return $list;
    }

    public function getItemBySubgrupoForTxt($id) {

        $list = [];

        $sql = "SELECT id_item,tipo,id_subgrupo,id_marca FROM item WHERE id_subgrupo = :id";
        $consulta = $this->ExecuteQuery($sql,[':id' => $id]);

        foreach ($consulta as $linha) {
          $list[] = [$linha['id_item'],$linha['tipo'],$linha['id_subgrupo'],$linha['id_marca']];
        }
        //echo '<pre>';var_dump($list);echo '</pre>';die;
        return $list;
    }

    public function insertItemTxt($tipo,$id_marca,$id_subgrupo) {
        $sql = "INSERT INTO item(tipo,id_marca,id_subgrupo,destaque,selecionado) VALUES(:tipo,:id_marca,:id_subgrupo,0,0)";
        if ($this->ExecuteCommand($sql,[':tipo'=>$tipo,':id_marca'=>$id_marca,':id_subgrupo'=>$id_subgrupo])){
            return true;
        } else {
            return false;
        }
    }
    
    public function updateByTxt($id_item, $tipo, $id_subgrupo, $id_marca) {
        //IMPORTANTE!! $array É ARRAY COM TODOS OS BARCODES

          $sql = "UPDATE item SET tipo = :tipo, id_subgrupo = :id_subgrupo, id_marca = :id_marca WHERE id_item = :id_item";
          $param = [':id_item' => $id_item,
                    ':tipo' => $tipo,
                    ':id_subgrupo' => $id_subgrupo,
                    ':id_marca' => $id_marca
                    ];
          $this->ExecuteCommand($sql, $param);
      }
      
      public function getItemBy($id_subgrupo, $id_marca, $tipo) {
        $list = [];
        $sql = "SELECT * FROM item WHERE id_subgrupo = :id_subgrupo AND id_marca = :id_marca AND tipo = :tipo";
        $item = $this->ExecuteQuery($sql, [':id_subgrupo' => $id_subgrupo, ':id_marca' => $id_marca, ':tipo' => $tipo])[0];
        return new Item($item['id_item'], $item['descricao'], $item['imagem'], $item['destaque'], $item['selecionado'], $item['tipo'], $item['id_subgrupo'], $item['id_marca']);
    }
    
    public function verificaItemBy($id_subgrupo, $id_marca, $tipo) {
        $list = [];
        $sql = "SELECT * FROM item WHERE id_subgrupo = :id_subgrupo AND id_marca = :id_marca AND tipo = :tipo";
        if(!empty($this->ExecuteQuery($sql, [':id_subgrupo' => $id_subgrupo, ':id_marca' => $id_marca, ':tipo' => $tipo])[0])){
            return true;
        }else return false;
    
    }
    
    public function selectDuplicate($id_subgrupo, $id_marca, $tipo) {
        $list = [];
        $sql = "select * from item
                where (tipo,id_subgrupo,id_marca) in (
                  select tipo,id_subgrupo,id_marca
                  from   item
                  group by tipo,id_subgrupo,id_marca
                  having count(*) > 1
                ) and id_subgrupo = :id_subgrupo
                and id_marca = :id_marca
                and tipo = :tipo
                ORDER BY id_item DESC";
        $consulta = $this->ExecuteQuery($sql, [':id_subgrupo' => $id_subgrupo, ':id_marca' => $id_marca, ':tipo' => $tipo]);
        
         foreach ($consulta as $item) {
            $list[] = new Item($item['id_item'], $item['descricao'], $item['imagem'], $item['destaque'], $item['selecionado'], $item['tipo'], $item['id_subgrupo'], $item['id_marca']);
        }
        //echo '<pre>';var_dump($list);echo '</pre>';die;
        return $list;
        
    }
    
    public function isDuplicate() {
        $list = [];
        $sql = "select *
                  from   item
                  group by tipo,id_subgrupo,id_marca
                  having count(*) > 1
                ";
        
        $consulta = $this->ExecuteQuery($sql, array());
        
         foreach ($consulta as $item) {
            $list[] = new Item($item['id_item'], $item['descricao'], $item['imagem'], $item['destaque'], $item['selecionado'], $item['tipo'], $item['id_subgrupo'], $item['id_marca']);
        }
        
        return $list;
    
    }
    
    

}
