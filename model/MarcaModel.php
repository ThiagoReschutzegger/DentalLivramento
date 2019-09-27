<?php

class MarcaModel extends Model {

    public function getMarca() {
        $list = [];
        $sql = "SELECT * FROM marca";
        $consulta = $this->ExecuteQuery($sql, array());
        foreach ($consulta as $linha) {
            $list[] = new Marca($linha['id_marca'],$linha['nome'],$linha['imagem'],$linha['catalogo'],$linha['slider'],$linha['single_prod']);
        }
        return $list;
    }

    public function getMarcaById($id) {
        $sql = "SELECT * FROM marca WHERE id_marca=:id;";
        $consulta = $this->ExecuteQuery($sql, [':id' => $id])[0];
        $marca = $this->ExecuteQuery($sql, [':id' => $id])[0];
            return new Marca( $marca['id_marca'],$marca['nome'],$marca['imagem'],$marca['catalogo'],$marca['slider'],$marca['single_prod']);
    }
    
    public function getMarcaByIds($ids) {
        $list = [];
        $string = "WHERE id_marca = "; //15 caracteres
        foreach ($ids as $id){
            $string = $string.$id." OR id_marca = ";
        }
        $string = substr($string, 0, -15);
        
        $sql = "SELECT * FROM marca ".$string;
        $consulta = $this->ExecuteQuery($sql, array());
        foreach ($consulta as $linha) {
            $list[] = new Marca($linha['id_marca'],$linha['nome'],$linha['imagem'],$linha['catalogo'],$linha['slider'],$linha['single_prod']);
        }
        return $list;
    }

    public function insertMarca($marca) {
        $sql = "INSERT INTO marca(nome,imagem,catalogo,slider,single_prod) VALUES(:nome,:imagem,:catalogo,1,1)";
        if ($this->ExecuteCommand($sql,[':nome'=>$marca->getNome(),':imagem'=>$marca->getImagem(),':catalogo'=>$marca->getCatalogo()])){
            return true;
        } else {
            return false;
        }
    }

    public function insertMarcaTxt($nome) {
        $sql = "INSERT INTO marca(nome) VALUES(:nome)";
        if ($this->ExecuteCommand($sql,[':nome'=>$nome])){
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
        $sql = "UPDATE marca SET nome = :nome, imagem = :imagem, catalogo = :catalogo, slider = :slider, single_prod = :single_prod WHERE id_marca = :id";
        $param = [':id'=>$marca->getId_marca(),':nome'=>$marca->getNome(),':imagem'=>$marca->getImagem(),':catalogo'=>$marca->getCatalogo(),':slider'=>$marca->getSlider(),':single_prod'=>$marca->getSingle_prod()];
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
            $list[] = new Marca($linha['id_marca'], $linha['nome'], $linha['imagem'], $linha['catalogo'], $linha['slider'], $linha['single_prod']);
        }
        //echo 'Mok';
        return $list;
    }

    public function getIdByNome($nome) {
        $list = [];
        $sql = "SELECT id_marca FROM marca WHERE nome = :nome";
        $query = $this->ExecuteQuery($sql, [':nome' => $nome]);

        return $query;
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
            $list[] = new Marca($linha['id_marca'], $linha['nome'], $linha['imagem'], $linha['catalogo'], $linha['slider'], $linha['single_prod']);
        }
        //echo 'Mok';
        return $list;
    }

    public function getAllMarcas() {

        $list = [];

        $sql = "SELECT id_marca,nome from marca";
        $consulta = $this->ExecuteQuery($sql, $list);

        foreach ($consulta as $linha) {
          $list[] = [$linha['id_marca'],$linha['nome']];
        }
        //echo '<pre>';var_dump($list);echo '</pre>';die;
        return $list;
    }

}
