<?php

class SubgrupoModel extends Model {

    public function getSubgrupo() {
        $list = [];
        $sql = "SELECT * FROM subgrupo";
        $consulta = $this->ExecuteQuery($sql, array());
        foreach ($consulta as $subgrupo) {
            $list[] = new Subgrupo($subgrupo['id_subgrupo'], $subgrupo['nome'], $subgrupo['id_grupo']);
        }
        return $list;
    }
    
    public function getSubgrupoById($id) {
        $sql = "SELECT * FROM subgrupo WHERE id_subgrupo = :id;";
        $subgrupo = $this->ExecuteQuery($sql, [':id' => $id])[0];
        return new Subgrupo($subgrupo['id_subgrupo'], $subgrupo['nome'], $subgrupo['id_grupo']);
    }
    
     public function getSubgrupoByIds($ids_subgrupo) { //Edu, 
          $list = [];
          
            $string2 = "(id_subgrupo = ";
            foreach ($ids_subgrupo as $id){
                $string2 = $string2.$id." OR id_subgrupo = "; //18 charcter
            }
            $string2 = substr($string2, 0, -18);
          
          $sql = "SELECT * FROM subgrupo WHERE ".$string2.")";
          $consulta = $this->ExecuteQuery($sql, array());
          foreach ($consulta as $subgrupo) {
            $list[] = new Subgrupo($subgrupo['id_subgrupo'], $subgrupo['nome'], $subgrupo['id_grupo']);
        }
          return $list;
      }

//    public function getSubgrupoDestaque() { //Edu
//        $list = [];
//        $sql = "SELECT * FROM subgrupo WHERE destaque = 1";
//        $consulta = $this->ExecuteQuery($sql, array());
//        foreach ($consulta as $subgrupo) {
//            $list[] = new Subgrupo($subgrupo['id_subgrupo'], $subgrupo['nome'], $subgrupo['descricao'], $subgrupo['imagem'], $subgrupo['destaque'], $subgrupo['id_grupo'], $subgrupo['id_marca']);
//        }
//        return $list;
//    }

//    public function getIdBy($nome, $descricao, $imagem) {
//        $sql = "SELECT * FROM subgrupo WHERE nome = :nome AND descricao = :descricao AND imagem = :imagem;";
//        $subgrupo = $this->ExecuteQuery($sql, [':nome' => $nome, ':descricao' => $descricao, ':imagem' => $imagem ])[0];
//        return new Subgrupo($subgrupo['id_subgrupo'], $subgrupo['nome'], $subgrupo['descricao'], $subgrupo['imagem'],  $subgrupo['destaque'], $subgrupo['id_grupo'], $subgrupo['id_marca']);
//    }

    

    public function getSubgrupoByGrupo($id) {
        $list = [];
        $sql = "SELECT * FROM subgrupo WHERE id_grupo = :id ORDER BY nome ASC;";
        $consulta = $this->ExecuteQuery($sql, [':id' => $id]);
        foreach ($consulta as $subgrupo) {
            $list[] = new Subgrupo($subgrupo['id_subgrupo'], $subgrupo['nome'], $subgrupo['id_grupo']);
        }
        return $list;
    }

    public function insertSubgrupo($subgrupo) {
        $sql = "INSERT INTO subgrupo(nome,id_grupo) VALUES(:nome,:id_grupo)";
        if ($this->ExecuteCommand($sql, [':nome' => $subgrupo->getNome(),
                                        ':id_grupo' => $subgrupo->getId_grupo()
                                    ])) {
            return true;
        } else {
            return false;
        }
    }

    public function removeSubgrupo($id) {
        $sql = "DELETE FROM subgrupo WHERE id_subgrupo = :id";
        if ($this->ExecuteCommand($sql, [':id' => $id])) {
            return true;
        } else {
            return false;
        }
    }

    public function updateSubgrupo($subgrupo) {
        $sql = "UPDATE subgrupo SET nome = :nome, id_grupo = :id_grupo WHERE id_subgrupo = :id_subgrupo";
        $param = [':id_subgrupo' => $subgrupo->getId_subgrupo(),
                  ':nome' => $subgrupo->getNome(),
                  ':id_grupo' => $subgrupo->getId_grupo()
                ];
        if ($this->ExecuteCommand($sql, $param)) {
            return true;
        } else {
            return false;
        }
    }

//    public function searchSubgrupo($nome, $codigo) {
//        $list = [];
//
//        if($nome == '' && $codigo != ''){
//            $sql = "SELECT * FROM subgrupo WHERE (barcode LIKE '%{$codigo}%')";
//        }
//        if($nome != '' && $codigo == ''){
//            $sql = "SELECT * FROM subgrupo WHERE (nome LIKE '%{$nome}%')";
//        }
//        if($nome != '' && $codigo != ''){
//            $sql = "SELECT * FROM subgrupo WHERE (barcode LIKE '%{$codigo}%' OR nome LIKE '%{$nome}%')";
//        }
//        $consulta = $this->ExecuteQuery($sql,array());
//
//        foreach ($consulta as $linha) {
//            $list[] = new Subgrupo($linha['id_subgrupo'], $linha['barcode'], $linha['preco'], $linha['nome'], $linha['estoque'], $linha['imagem'], $linha['descricao'], $linha['destaque'], $linha['tipo'], $linha['id_grupo'], $linha['id_marca']);
//        }
//        return $list;
//    }

//    public function removeDestaque($id) { //EDU
//        $sql = "UPDATE subgrupo SET destaque = 0 WHERE id_subgrupo = :id";
//        if ($this->ExecuteCommand($sql, [':id' => $id])) {
//            return true;
//        } else {
//            return false;
//        }
//    }
//    public function addDestaque($id) { //EDU
//        $sql = "UPDATE subgrupo SET destaque = 1 WHERE id_subgrupo = :id";
//        if ($this->ExecuteCommand($sql, [':id' => $id])) {
//            return true;
//        } else {
//            return false;
//        }
//    }


//    public function getAllSubgrupos() {
//
//        $list = [];
//
//        $sql = "SELECT id_subgrupo,nome from subgrupo";
//        $consulta = $this->ExecuteQuery($sql, $list);
//
//        foreach ($consulta as $linha) {
//          $list[] = [$linha['id_subgrupo'],$linha['nome']];
//        }
//        //echo '<pre>';var_dump($list);echo '</pre>';die;
//        return $list;
//    }

    public function insertSubgrupoTxt($nome,$id_grupo,$id_marca) {

        $sql = "INSERT INTO subgrupo(nome,id_grupo,id_marca,destaque) VALUES(:nome,:idgrupo,:idmarc,:destaque)";
        if ($this->ExecuteCommand($sql,[':nome'=>$nome,':idgrupo'=>$id_grupo,':idmarc'=>$id_marca,':destaque'=>0])){
            return true;
        } else {
            return false;
        }
    }

    public function getIdByNome($nome) {
        $list = [];
        $sql = "SELECT id_subgrupo FROM subgrupo WHERE nome = :nome";
        $query = $this->ExecuteQuery($sql, [':nome' => $nome]);
        return $query[0]['id_subgrupo'];
    }
    
     public function searchSubgrupoForDefault($texto) { //Edu
        $list = [];
        $sql = "SELECT * FROM subgrupo WHERE UPPER(nome) like '%{$texto}%'";
        $consulta = $this->ExecuteQuery($sql, array());

        foreach ($consulta as $subgrupo) {
          $list[] = new Subgrupo($subgrupo['id_subgrupo'], $subgrupo['nome'], $subgrupo['id_grupo']);
        }
        return $list;
    }


}
