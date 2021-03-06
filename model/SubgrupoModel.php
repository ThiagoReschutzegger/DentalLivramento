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
    
    public function getSubgrupoByCategoriaId($id) {
        $list = [];
        $sql = "SELECT subgrupo.* FROM subgrupo JOIN grupo ON subgrupo.id_grupo = grupo.id_grupo JOIN categoria ON grupo.id_categoria = categoria.id_categoria WHERE categoria.id_categoria = :id ORDER BY nome ASC;";
        $consulta = $this->ExecuteQuery($sql, [':id' => $id]);
        foreach ($consulta as $subgrupo) {
            $list[] = new Subgrupo($subgrupo['id_subgrupo'], $subgrupo['nome'], $subgrupo['id_grupo']);
        }
        return $list;
    }

    public function getSubgrupoByGrupoForTxt($id) {
        $list = [];

        $sql = "SELECT id_subgrupo, nome FROM subgrupo WHERE id_grupo = :id";
        $consulta = $this->ExecuteQuery($sql, [':id' => $id]);

        foreach ($consulta as $linha) {
          $list[] = [$linha['id_subgrupo'],$linha['nome']];
        }
        //echo '<pre>';var_dump($list);echo '</pre>';die;
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


   public function getAllSubgrupos() {

       $list = [];

       $sql = "SELECT id_subgrupo,nome from subgrupo";
       $consulta = $this->ExecuteQuery($sql, $list);

       foreach ($consulta as $linha) {
         $list[] = [$linha['id_subgrupo'],$linha['nome']];
       }
       //echo '<pre>';var_dump($list);echo '</pre>';die;
       return $list;
   }

    public function insertSubgrupoTxt($nome,$id_grupo) {

        $sql = "INSERT INTO subgrupo(nome,id_grupo) VALUES(:nome,:idgrupo)";
        if ($this->ExecuteCommand($sql,[':nome'=>$nome,':idgrupo'=>$id_grupo])){
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

    public function getIdByNomeAndFather($nome, $id_grupo) {
        $list = [];
        $sql = "SELECT id_subgrupo FROM subgrupo WHERE nome = :nome AND id_grupo = :id";
        $query = $this->ExecuteQuery($sql, [':nome' => $nome, ':id' => $id_grupo]);
        return $query[0]['id_subgrupo'];
    }

    public function getIdGrupoByNome($nome) {
        $list = [];
        $sql = "SELECT id_grupo FROM subgrupo WHERE nome = :nome";
        $query = $this->ExecuteQuery($sql,[':nome'=>$nome]);
        foreach ($query as $linha) {
            $list[] = $linha['id_grupo'];
        }
        return $list;
    }

    public function verificaTudo($subgrupo,$idgrupo,$idcategoria) {
        $sql = "select id_subgrupo from subgrupo join grupo on subgrupo.id_grupo = grupo.id_grupo where subgrupo.nome = :subgrupo and subgrupo.id_grupo = :idgrupo and grupo.id_categoria = :idcategoria";
        $query = $this->ExecuteQuery($sql,[':nome'=>$nome,':idgrupo'=>$idgrupo,':idcategoria'=>$idcategoria]);
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

    public function searchSubgrupoForAdm($texto) { //Edu
        $list_sub = [];
        $sql = "SELECT * FROM subgrupo WHERE UPPER(nome) like '%{$texto}%'";
        $consulta = $this->ExecuteQuery($sql, array());

        if(!empty($consulta)):
        $ids_gp = [];
        foreach ($consulta as $subgrupo) {
          $list_sub[] = new Subgrupo($subgrupo['id_subgrupo'], $subgrupo['nome'], $subgrupo['id_grupo']);
          if(!in_array($subgrupo['id_grupo'], $ids_gp)){
              $ids_gp[] = $subgrupo['id_grupo'];
          }
        }

        $list_gp = [];
        $string_gp = "WHERE id_grupo = ";
        foreach ($ids_gp as $id){
            $string_gp = $string_gp.$id." OR id_grupo = "; //15 char
        }
        $string_gp = substr($string_gp, 0, -15);

        $sql = "SELECT * FROM grupo ".$string_gp;
        $consulta = $this->ExecuteQuery($sql, array());

        $ids_cat = [];
        foreach ($consulta as $linha) {
          $list_gp[] = new Grupo($linha['id_grupo'], $linha['nome'], $linha['id_categoria']);
          if(!in_array($linha['id_categoria'], $ids_cat)){
              $ids_cat[] = $linha['id_categoria'];
          }
        }

        $list_cat = [];
        $string_cat = "WHERE id_categoria = ";
        foreach ($ids_cat as $id){
            $string_cat = $string_cat.$id." OR id_categoria = "; //15 char
        }
        $string_cat = substr($string_cat, 0, -19);

        $sql = "SELECT * FROM categoria ".$string_cat;
        $consulta = $this->ExecuteQuery($sql, array());

        foreach ($consulta as $categoria) {
          $list_cat[] = new Categoria( $categoria['id_categoria'],$categoria['nome'],$categoria['descricao'],$categoria['imagem']);
         }


//        echo '<pre>';var_dump($list_sub);echo '</pre>';
//        die;

        return array($list_sub, $list_gp, $list_cat);
        else:
            return array();
        endif;
    }

    public function removeEmpty() {
        $sql = "DELETE FROM subgrupo WHERE id_subgrupo not in (SELECT id_subgrupo FROM produto)";
        $this->ExecuteCommand($sql, array());
    }
    
    public function verificaSubgrupo($id) {
        $list = [];
        $sql = "SELECT * FROM subgrupo WHERE id_subgrupo = :id_subgrupo";
        if(!empty($this->ExecuteQuery($sql, [':id_subgrupo' => $id])[0])){
            return true;
        }else return false;
    
    }

    public function searchSubgrupo2($pesquisa){
      $list = [];

      $sql = "SELECT * FROM subgrupo WHERE MATCH (nome) AGAINST (:pesquisa)";
      $consulta = $this->ExecuteQuery($sql, [':pesquisa' => $pesquisa]);

      foreach ($consulta as $linha) {
        $list[] = new Subgrupo($linha['id_subgrupo'], $linha['nome'], $linha['id_grupo']);
      }
      //echo '<pre>';var_dump($list);echo '</pre>';die;
      return $list;

    }


}
