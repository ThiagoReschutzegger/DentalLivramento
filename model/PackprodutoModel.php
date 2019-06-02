<?php

class PackprodutoModel extends Model {

    public function getPackproduto() {
        $list = [];
        $sql = "SELECT produto.* , subgrupo.* FROM packproduto JOIN produto ON produto.id_produto = packproduto.id_produto JOIN subgrupo ON subgrupo.id_subgrupo = packproduto.id_subgrupo";
        $consulta = $this->ExecuteQuery($sql, array());
        foreach ($consulta as $linha) {
            $list[] = new Packproduto($linha['id_packproduto'], $linha['id_produto'], $linha['barcode'], $linha['preco'], $linha['estoque'], $linha['especificacao'], $linha['id_subgrupo'], $linha['nome'], $linha['imagem'], $linha['descricao'], $linha['id_grupo'], $linha['id_marca']);
        }
        return $list;
    }

    public function getPackprodutoById($id) { //pega pelo id do produto
        $sql = "SELECT produto.id_produto, produto.barcode, produto.preco, produto.estoque, produto.especificacao, produto.id_subgrupo, subgrupo.nome, subgrupo.descricao, subgrupo.imagem,subgrupo.destaque, subgrupo.id_grupo, subgrupo.id_marca from produto join subgrupo on produto.id_subgrupo=subgrupo.id_subgrupo where produto.id_produto = :id";
        $linha = $this->ExecuteQuery($sql, [':id' => $id])[0];
        return new Packproduto($linha['id_produto'], $linha['barcode'], $linha['preco'], $linha['estoque'], $linha['especificacao'], $linha['id_subgrupo'], $linha['nome'], $linha['descricao'], $linha['imagem'], $linha['destaque'], $linha['id_grupo'], $linha['id_marca']);
    }

    public function getPackprodutoBySubgrupo($id) { //pega pelo id do subgrupo
        $list = [];
        $sql = "SELECT produto.id_produto, produto.barcode, produto.preco, produto.estoque, produto.especificacao, produto.id_subgrupo, subgrupo.nome, subgrupo.descricao, subgrupo.imagem,subgrupo.destaque, subgrupo.id_grupo, subgrupo.id_marca from produto join subgrupo on produto.id_subgrupo=subgrupo.id_subgrupo where subgrupo.id_subgrupo = :id";
        $consulta = $this->ExecuteQuery($sql, [':id' => $id]);
        foreach ($consulta as $linha) {
            $list[] = new Packproduto($linha['id_produto'], $linha['barcode'], $linha['preco'], $linha['estoque'], $linha['especificacao'], $linha['id_subgrupo'], $linha['nome'], $linha['descricao'], $linha['imagem'], $linha['destaque'], $linha['id_grupo'], $linha['id_marca']);
        }
        return $list;
    }

    public function getPackprodutoByGrupo($id,$paginador) { //pega pelo id do grupo
        $list = [];
        $ids_prod = [];
        $offset = ($paginador * 12) - 12;
        $sql = "SELECT produto.id_produto, produto.barcode, produto.preco, produto.estoque, produto.especificacao, produto.id_subgrupo, subgrupo.nome, subgrupo.descricao, subgrupo.imagem,subgrupo.destaque, subgrupo.id_grupo, subgrupo.id_marca from produto join subgrupo on produto.id_subgrupo=subgrupo.id_subgrupo where subgrupo.id_grupo = :id ORDER BY produto.id_subgrupo DESC";
        //limit 12 offset {$offset}
        $consulta = $this->ExecuteQuery($sql, [':id' => $id]);
        foreach ($consulta as $linha) {
            $list[] = new Packproduto($linha['id_produto'], $linha['barcode'], $linha['preco'], $linha['estoque'], $linha['especificacao'], $linha['id_subgrupo'], $linha['nome'], $linha['descricao'], $linha['imagem'], $linha['destaque'], $linha['id_grupo'], $linha['id_marca']);
            $ids_prod[] = $linha['id_subgrupo'];
        }
        $ids_prod = array_unique($ids_prod);
        $total_prod = count($ids_prod);
        if($total_prod>12){
          $paginador_max = ceil($total_prod/12);
          $list_paginada = [];
          $ponto =0;
          $i = 1;
          $repetidos = count($list) - $total_prod;
          $excedente = count($list) - (12*$paginador);
          $resto = 12;
          if($excedente < 0){
            $resto = $excedente+12;
            $ponto = 12*($paginador-1);
          }

          while ($i <= $resto) {
            $list_paginada[] = $list[$i-1+$ponto];
            $i++;
          }
          return array($paginador_max, $list_paginada, $total_prod);
        }else{
          $paginador_max = 1;
          return array($paginador_max, $list, $total_prod);
        }
    }

    public function getPackprodutoByGrupoV2($id,$paginador) { //vei, não altera a outra função, sipa pode da merda
        $list = [];
        $sql = "SELECT DISTINCT produto.id_produto, produto.barcode, produto.preco, produto.estoque, produto.especificacao, produto.id_subgrupo, subgrupo.nome, subgrupo.descricao, subgrupo.imagem,subgrupo.destaque, subgrupo.id_grupo, subgrupo.id_marca from produto join subgrupo on produto.id_subgrupo=subgrupo.id_subgrupo where subgrupo.id_grupo = :id GROUP BY subgrupo.id_subgrupo";
        $consulta = $this->ExecuteQuery($sql, [':id' => $id]);
        foreach ($consulta as $linha) {
            $list[] = new Packproduto($linha['id_produto'], $linha['barcode'], $linha['preco'], $linha['estoque'], $linha['especificacao'], $linha['id_subgrupo'], $linha['nome'], $linha['descricao'], $linha['imagem'], $linha['destaque'], $linha['id_grupo'], $linha['id_marca']);
        }
        return $list;
    }

    public function searchPackproduto($nome, $codigo) {
        $list = [];

        if ($nome == '' && $codigo != '') {
            $sql = "SELECT * FROM packproduto WHERE (barcode LIKE '%{$codigo}%')";
        }
        if ($nome != '' && $codigo == '') {
            $sql = "SELECT * FROM packproduto WHERE (nome LIKE '%{$nome}%')";
        }
        if ($nome != '' && $codigo != '') {
            $sql = "SELECT * FROM packproduto WHERE (barcode LIKE '%{$codigo}%' OR nome LIKE '%{$nome}%')";
        }
        $consulta = $this->ExecuteQuery($sql, array());

        foreach ($consulta as $linha) {
            $list[] = new Packproduto($linha['id_packproduto'], $linha['barcode'], $linha['preco'], $linha['nome'], $linha['estoque'], $linha['imagem'], $linha['descricao'], $linha['destaque'], $linha['tipo'], $linha['id_grupo'], $linha['id_marca']);
        }
        return $list;
    }


    public function filtroPackproduto($marca_id,$ordem,$grupo_id,$paginador){
      $base_str = "SELECT produto.id_produto, produto.barcode, produto.preco, produto.estoque, produto.especificacao, produto.id_subgrupo, subgrupo.nome, subgrupo.descricao, subgrupo.imagem,subgrupo.destaque, subgrupo.id_grupo, subgrupo.id_marca FROM produto JOIN subgrupo ON produto.id_subgrupo=subgrupo.id_subgrupo ";

      if($marca_id == 0){
        $marca_str = '';
      }else{
        $marca_str = "AND subgrupo.id_marca = ".$marca_id." ";
      }

      $grupo_str = "AND subgrupo.id_grupo = ".$grupo_id." ";

       if($ordem == "alfa"){
         $ordem_str = "ORDER BY subgrupo.nome asc";
       }else if ($ordem == "maior"){
         $ordem_str = "ORDER BY produto.preco desc";
       }else if ($ordem == "menor"){
         $ordem_str = "ORDER BY produto.preco asc";
       }else if ($ordem == "new"){
         $ordem_str = "ORDER BY subgrupo.id_subgrupo desc";
       }else{
         $ordem_str = "ORDER BY subgrupo.id_subgrupo desc";
       }


      $sql = $base_str.$marca_str.$grupo_str.$ordem_str;

      //echo"<pre>";var_dump($sql);die;

      $list = [];
      $ids_prod = [];

      $consulta = $this->ExecuteQuery($sql, array());
      foreach ($consulta as $linha) {
          $list[] = new Packproduto($linha['id_produto'], $linha['barcode'], $linha['preco'], $linha['estoque'], $linha['especificacao'], $linha['id_subgrupo'], $linha['nome'], $linha['descricao'], $linha['imagem'], $linha['destaque'], $linha['id_grupo'], $linha['id_marca']);
          $ids_prod[] = $linha['id_subgrupo'];
      }
      $ids_prod = array_unique($ids_prod);
      $total_prod = count($ids_prod);
      if(count($list)>12){
        $paginador_max = ceil(count($list)/12);
        $list_paginada = [];
        $ponto =0;
        $i = 1;
        $excedente = count($list) - (12*$paginador);
        $resto = 12;
        if($excedente < 0){
          $resto = $excedente+12;
          $ponto = 12*($paginador-1);
        }
        $ids = [];
        foreach ($list as $linha) {
          if(in_array($linha->getId_subgrupo(), $ids)){
            $resto++;
            continue;
          }else{
            $ids[] = $linha->getId_subgrupo();
          }
        }
        while ($i <= $resto) {
          $list_paginada[] = $list[$i-1+$ponto];
          $i++;
        }
        return array($paginador_max, $list_paginada, $total_prod,$ordem);
      }else{
        $paginador_max = 1;
        return array($paginador_max, $list, $total_prod,$ordem);
      }
    }

    public function searchPackprodutoForDefault($texto) {
        $list = [];
        $sql = "SELECT DISTINCT produto.id_produto, produto.barcode, produto.preco, produto.estoque, produto.especificacao, produto.id_subgrupo, subgrupo.nome, subgrupo.descricao, subgrupo.imagem, subgrupo.destaque, subgrupo.id_grupo, subgrupo.id_marca
                FROM subgrupo JOIN produto ON produto.id_subgrupo=subgrupo.id_subgrupo WHERE UPPER(subgrupo.nome) like '%{$texto}%'";
        $consulta = $this->ExecuteQuery($sql, array());

        foreach ($consulta as $linha) {
          $list[] = new Packproduto($linha['id_produto'], $linha['barcode'], $linha['preco'], $linha['estoque'], $linha['especificacao'], $linha['id_subgrupo'], $linha['nome'], $linha['descricao'], $linha['imagem'], $linha['destaque'], $linha['id_grupo'], $linha['id_marca']);
        }
        return $list;
    }


}
