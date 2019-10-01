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
    
    public function getPackprodutoByIds($id_produto, $id_subgrupo, $id_marca) { //Edu
        $sql = "SELECT produto.id_produto, produto.barcode, produto.preco, produto.estoque, produto.especificacao, produto.tipo, produto.id_subgrupo, produto.id_marca, subgrupo.nome, item.descricao, item.imagem, item.destaque "
                . "from produto join subgrupo on produto.id_subgrupo=subgrupo.id_subgrupo "
                . "join item on produto.id_subgrupo=item.id_subgrupo and produto.id_marca=item.id_marca and produto.tipo=item.tipo "
                . "where produto.id_produto = :id_produto and produto.id_subgrupo = :id_subgrupo and produto.id_marca = :id_marca";
        
        $linha = $this->ExecuteQuery($sql, [':id_produto' => $id_produto, ':id_subgrupo' => $id_subgrupo, ':id_marca' => $id_marca])[0];
        return new Packproduto($linha['id_produto'], $linha['barcode'], $linha['preco'], $linha['estoque'], $linha['especificacao'], $linha['tipo'], $linha['id_subgrupo'], $linha['id_marca'], $linha['nome'], $linha['descricao'], $linha['imagem'], $linha['destaque']);
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

//    public function getPackprodutoByGrupo($id,$paginador) { //pega pelo id do grupo
//        $list = [];
//        $ids_prod = [];
//        $offset = ($paginador * 12) - 12;
//        $sql = "SELECT produto.id_produto, produto.barcode, produto.preco, produto.estoque, produto.especificacao, produto.id_subgrupo, subgrupo.nome, subgrupo.descricao, subgrupo.imagem,subgrupo.destaque, subgrupo.id_grupo, subgrupo.id_marca from produto join subgrupo on produto.id_subgrupo=subgrupo.id_subgrupo where subgrupo.id_grupo = :id ORDER BY produto.id_subgrupo DESC";
//        //limit 12 offset {$offset}
//        $consulta = $this->ExecuteQuery($sql, [':id' => $id]);
//        foreach ($consulta as $linha) {
//            $list[] = new Packproduto($linha['id_produto'], $linha['barcode'], $linha['preco'], $linha['estoque'], $linha['especificacao'], $linha['id_subgrupo'], $linha['nome'], $linha['descricao'], $linha['imagem'], $linha['destaque'], $linha['id_grupo'], $linha['id_marca']);
//            $ids_prod[] = $linha['id_subgrupo'];
//        }
//        $ids_prod = array_unique($ids_prod);
//        $total_prod = count($ids_prod);
//        if($total_prod>12){
//          $paginador_max = ceil($total_prod/12);
//          $list_paginada = [];
//          $ponto =12*($paginador-1);
//          $resto = 12; // quantos registros serão exibidos na tela, sofre alterações no caminho... repetições, list com menos prod que 12,...
//
//          if($paginador == 1 && $total_prod < $resto) $resto = count($list);
//
//          if($ponto > $total_prod - $ponto && $total_prod - $ponto > 0 && $paginador > 1) $resto = $total_prod - $ponto;
//
//          $repetidos_old = 0;
//          if($paginador > 1){
//            $ids_aux = [];
//            if($paginador == 2) $aux = 0; else $aux = 1;
//            $ponto_aux = 0;
//            $i = $ponto_aux + 12*($paginador-1) - $aux;//12
//            if($i > count($list)) $i = count($list) - $aux;
//
//            $prox_ponto = $ponto;
//            if($i > $prox_ponto) $i = $prox_ponto;
//
//            $x = 0;
//            foreach($list as $list_2):
//              if($x != $ponto_aux){ $x++; continue;} else{
//                if($i+1 <= count(array_unique($ids_aux))){
//                  continue;
//                }else{
//                  if(in_array($list_2->getId_subgrupo(), $ids_aux)) $repetidos_old++; else $ids_aux[] = $list_2->getId_subgrupo();
//                }
//              }
//            endforeach;
//          }
//
//          $ids_aux = [];
//          $i = $resto;
//          $repetidos_atuais =0;
//          $prox_ponto = $ponto + 12; //12
//
//          // echo count($list);die;
//
//          $x = 0;
//          foreach($list as $list_2):
//            if($x != $ponto+$repetidos_old){$x++; continue;} else{
//              if($i+1 <= count(array_unique($ids_aux))){
//                continue;
//              }else{
//                if(in_array($list_2->getId_subgrupo(), $ids_aux)) $repetidos_atuais++; else $ids_aux[] = $list_2->getId_subgrupo();
//              }
//            }
//          endforeach;
//
//
//          $resto = $resto + $repetidos_atuais;
//          $ponto = $ponto + $repetidos_old;
//
//          $i = 1;
//          while ($i <= $resto) {
//            $list_paginada[] = $list[$i-1+$ponto];
//            $i++;
//          }
//          //echo "<pre>";var_dump($list_paginada);echo "</pre>";die;
//          return array($paginador_max, $list_paginada, $total_prod);
//        }else{
//          $paginador_max = 1;
//          return array($paginador_max, $list, $total_prod);
//        }
//    }

//    public function getPackprodutoByGrupoV2($id,$paginador) { //vei, não altera a outra função, sipa pode da merda
//        $list = [];
//        $sql = "SELECT DISTINCT produto.id_produto, produto.barcode, produto.preco, produto.estoque, produto.especificacao, produto.id_subgrupo, subgrupo.nome, subgrupo.descricao, subgrupo.imagem,subgrupo.destaque, subgrupo.id_grupo, subgrupo.id_marca from produto join subgrupo on produto.id_subgrupo=subgrupo.id_subgrupo where subgrupo.id_grupo = :id GROUP BY subgrupo.id_subgrupo";
//        $consulta = $this->ExecuteQuery($sql, [':id' => $id]);
//        foreach ($consulta as $linha) {
//            $list[] = new Packproduto($linha['id_produto'], $linha['barcode'], $linha['preco'], $linha['estoque'], $linha['especificacao'], $linha['id_subgrupo'], $linha['nome'], $linha['descricao'], $linha['imagem'], $linha['destaque'], $linha['id_grupo'], $linha['id_marca']);
//        }
//        return $list;
//    }

//    public function searchPackproduto($nome, $codigo) {
//        $list = [];
//
//        if ($nome == '' && $codigo != '') {
//            $sql = "SELECT * FROM packproduto WHERE (barcode LIKE '%{$codigo}%')";
//        }
//        if ($nome != '' && $codigo == '') {
//            $sql = "SELECT * FROM packproduto WHERE (nome LIKE '%{$nome}%')";
//        }
//        if ($nome != '' && $codigo != '') {
//            $sql = "SELECT * FROM packproduto WHERE (barcode LIKE '%{$codigo}%' OR nome LIKE '%{$nome}%')";
//        }
//        $consulta = $this->ExecuteQuery($sql, array());
//
//        foreach ($consulta as $linha) {
//            $list[] = new Packproduto($linha['id_packproduto'], $linha['barcode'], $linha['preco'], $linha['nome'], $linha['estoque'], $linha['imagem'], $linha['descricao'], $linha['destaque'], $linha['tipo'], $linha['id_grupo'], $linha['id_marca']);
//        }
//        return $list;
//    }


//    public function filtroPackproduto($marca_id,$ordem,$grupo_id,$paginador){
//      $base_str = "SELECT produto.id_produto, produto.barcode, produto.preco, produto.estoque, produto.especificacao, produto.id_subgrupo, subgrupo.nome, subgrupo.descricao, subgrupo.imagem,subgrupo.destaque, subgrupo.id_grupo, subgrupo.id_marca FROM produto JOIN subgrupo ON produto.id_subgrupo=subgrupo.id_subgrupo ";
//
//      if($marca_id == 0){
//        $marca_str = '';
//      }else{
//        $marca_str = "AND subgrupo.id_marca = ".$marca_id." ";
//      }
//
//      $grupo_str = "AND subgrupo.id_grupo = ".$grupo_id." ";
//
//       if($ordem == "alfa"){
//         $ordem_str = "ORDER BY subgrupo.nome asc";
//       }else if ($ordem == "maior"){
//         $ordem_str = "ORDER BY produto.preco desc";
//       }else if ($ordem == "menor"){
//         $ordem_str = "ORDER BY produto.preco asc";
//       }else if ($ordem == "new"){
//         $ordem_str = "ORDER BY subgrupo.id_subgrupo desc";
//       }else{
//         $ordem_str = "ORDER BY subgrupo.id_subgrupo desc";
//       }
//
//
//      $sql = $base_str.$marca_str.$grupo_str.$ordem_str;
//
//      //echo"<pre>";var_dump($sql);die;
//
//      $list = [];
//      $ids_prod = [];
//
//      $consulta = $this->ExecuteQuery($sql, array());
//      foreach ($consulta as $linha) {
//          $list[] = new Packproduto($linha['id_produto'], $linha['barcode'], $linha['preco'], $linha['estoque'], $linha['especificacao'], $linha['id_subgrupo'], $linha['nome'], $linha['descricao'], $linha['imagem'], $linha['destaque'], $linha['id_grupo'], $linha['id_marca']);
//          $ids_prod[] = $linha['id_subgrupo'];
//      }
//      $ids_prod = array_unique($ids_prod);
//      $total_prod = count($ids_prod);
//
//      if($total_prod>12){
//        $paginador_max = ceil($total_prod/12);
//        $list_paginada = [];
//        $ponto =12*($paginador-1);
//        $resto = 12; // quantos registros serão exibidos na tela, sofre alterações no caminho... repetições, list com menos prod que 12,...
//
//        if($paginador == 1 && $total_prod < $resto) $resto = count($list);
//
//        if($ponto > $total_prod - $ponto && $total_prod - $ponto > 0 && $paginador > 1) $resto = $total_prod - $ponto;
//
//        $repetidos_old = 0;
//        if($paginador > 1){
//          $ids_aux = [];
//          if($paginador == 2) $aux = 0; else $aux = 1;
//          $ponto_aux = $ponto - 12;
//          $i = $ponto_aux + 12*($paginador-1) - $aux;//12
//          if($i > count($list)) $i = count($list) - $aux;
//
//          $prox_ponto = $ponto;
//          if($i > $prox_ponto) $i = $prox_ponto;
//
//          $x = 0;
//          foreach($list as $list_2):
//            if($x != $ponto_aux){ $x++; continue;} else{
//              if($i+1 <= count(array_unique($ids_aux))){
//                continue;
//              }else{
//                if(in_array($list_2->getId_subgrupo(), $ids_aux)) $repetidos_old++; else $ids_aux[] = $list_2->getId_subgrupo();
//              }
//            }
//          endforeach;
//        }
//
//        $ids_aux = [];
//        $i = $resto;
//        $repetidos_atuais =0;
//        $prox_ponto = $ponto + 12; //12
//
//        // echo count($list);die;
//
//        $x = 0;
//        foreach($list as $list_2):
//          if($x != $ponto+$repetidos_old){$x++; continue;} else{
//            if($i+1 <= count(array_unique($ids_aux))){
//              continue;
//            }else{
//              if(in_array($list_2->getId_subgrupo(), $ids_aux)) $repetidos_atuais++; else $ids_aux[] = $list_2->getId_subgrupo();
//            }
//          }
//        endforeach;
//
//
//        $resto = $resto + $repetidos_atuais;
//        $ponto = $ponto + $repetidos_old;
//
//        $i = 1;
//        while ($i <= $resto) {
//          $list_paginada[] = $list[$i-1+$ponto];
//          $i++;
//        }
//        //echo "<pre>";var_dump($list_paginada);echo "</pre>";die;
//        return array($paginador_max, $list_paginada, $total_prod,$ordem);
//      }else{
//        $paginador_max = 1;
//        return array($paginador_max, $list, $total_prod,$ordem);
//      }
//    }

//    public function searchPackprodutoForDefault($texto) {
//        $list = [];
//        $sql = "SELECT DISTINCT produto.id_produto, produto.barcode, produto.preco, produto.estoque, produto.especificacao, produto.id_subgrupo, subgrupo.nome, subgrupo.descricao, subgrupo.imagem, subgrupo.destaque, subgrupo.id_grupo, subgrupo.id_marca
//                FROM subgrupo JOIN produto ON produto.id_subgrupo=subgrupo.id_subgrupo WHERE UPPER(subgrupo.nome) like '%{$texto}%'";
//        $consulta = $this->ExecuteQuery($sql, array());
//
//        foreach ($consulta as $linha) {
//          $list[] = new Packproduto($linha['id_produto'], $linha['barcode'], $linha['preco'], $linha['estoque'], $linha['especificacao'], $linha['id_subgrupo'], $linha['nome'], $linha['descricao'], $linha['imagem'], $linha['destaque'], $linha['id_grupo'], $linha['id_marca']);
//        }
//        return $list;
//    }


}
