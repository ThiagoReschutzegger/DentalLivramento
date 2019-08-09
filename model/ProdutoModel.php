<?php

  class ProdutoModel extends Model {

      public function getProduto() {
          $list = [];
          $sql = "SELECT * FROM produto";
          $consulta = $this->ExecuteQuery($sql, array());
          foreach ($consulta as $linha) {
              $list[] = new Produto($linha['id_produto'], $linha['barcode'], $linha['preco'], $linha['estoque'], $linha['especificacao'],$linha['id_subgrupo']);
          }
          return $list;
      }

      public function getProdutoById($id) {
          $sql = "SELECT * FROM produto WHERE id_produto=:id;";
          $produto = $this->ExecuteQuery($sql, [':id' => $id])[0];
          return new Produto($produto['id_produto'], $produto['barcode'], $produto['preco'], $produto['estoque'], $produto['especificacao'],$produto['id_subgrupo']);
      }

      public function getPrecoByProdutoId($id) {
          $sql = "SELECT preco FROM produto WHERE id_produto=:id;";
          $produto = $this->ExecuteQuery($sql, [':id' => $id])[0];
          return $produto['preco'];
      }

      public function getProdutosBySubgrupoId($id) {
          $list = [];
          $sql = "SELECT * FROM produto WHERE id_subgrupo=:id;";
          $produto = $this->ExecuteQuery($sql, [':id' => $id]);
          foreach ($produto as $linha) {
              $list[] = new Produto($linha['id_produto'], $linha['barcode'], $linha['preco'], $linha['estoque'], $linha['especificacao'], $linha['id_subgrupo']);
          }
          return $list;
      }

      public function insertProduto($produto) {
          $sql = "INSERT INTO produto(barcode,preco,estoque,especificacao,id_subgrupo) VALUES(:barcode,:preco,:estoque,:especificacao,:id_subgrupo)";
          if ($this->ExecuteCommand($sql, [':barcode' => $produto->getBarcode(),
                      ':preco' => $produto->getPreco(),
                      ':estoque' => $produto->getEstoque(),
                      ':especificacao' => $produto->getEspecificacao(),
                      ':id_subgrupo' => $produto->getId_subgrupo()
                  ])) {
              return true;
          } else {
              return false;
          }
      }

      public function removeProduto($id) {
          $sql = "DELETE FROM produto WHERE id_produto = :id";
          if ($this->ExecuteCommand($sql, [':id' => $id])) {
              return true;
          } else {
              return false;
          }
      }

      public function updateProduto($produto) {
          $sql = "UPDATE produto SET barcode = :barcode, preco = :preco, estoque = :estoque, especificacao = :especificacao, id_subgrupo = :id_subgrupo WHERE id_produto = :id";
          $param = [':id' => $produto->getId_produto(),
              ':barcode' => $produto->getBarcode(),
              ':preco' => $produto->getPreco(),
              ':estoque' => $produto->getEstoque(),
              ':especificacao' => $produto->getEspecificacao(),
              ':id_subgrupo' => $produto->getId_subgrupo()
          ];
          if ($this->ExecuteCommand($sql, $param)) {
              return true;
          } else {
              return false;
          }
      }

      public function searchProdutoUnitario($nome, $codigo) {
          $list = [];

          $nome = strtoupper($nome);
          $codigo = strtoupper($codigo);

          if ($nome == '' && $codigo != '') {
              $sql = "SELECT produto.id_produto, "
                      . "produto.barcode, "
                      . "produto.preco, "
                      . "produto.estoque, "
                      . "produto.especificacao, "
                      . "produto.id_subgrupo, "
                      . "subgrupo.nome, "
                      . "subgrupo.descricao, "
                      . "subgrupo.imagem, "
                      . "subgrupo.destaque, "
                      . "subgrupo.id_grupo, "
                      . "subgrupo.id_marca "
                      . "FROM produto JOIN subgrupo ON produto.id_subgrupo=subgrupo.id_subgrupo "
                      . "WHERE (UPPER(produto.barcode) LIKE '%{$codigo}%') "
                      . "ORDER BY CASE produto.barcode "
                      . "WHEN UPPER(produto.barcode)='{$codigo}' THEN 0 "
                      . "WHEN UPPER(produto.barcode)='{$codigo}%' THEN 1 "
                      . "WHEN UPPER(produto.barcode)='%{$codigo}' THEN 2 "
                      . "WHEN UPPER(produto.barcode)='%{$codigo}%' THEN 3 "
                      . "ELSE produto.barcode END";
          }
          if ($nome != '' && $codigo == '') {
              $sql = "SELECT produto.id_produto, "
                      . "produto.barcode, "
                      . "produto.preco, "
                      . "produto.estoque, "
                      . "produto.especificacao, "
                      . "produto.id_subgrupo, "
                      . "subgrupo.nome, "
                      . "subgrupo.descricao, "
                      . "subgrupo.imagem, "
                      . "subgrupo.destaque, "
                      . "subgrupo.id_grupo, "
                      . "subgrupo.id_marca "
                      . "FROM produto JOIN subgrupo ON produto.id_subgrupo=subgrupo.id_subgrupo "
                      . "WHERE (UPPER(subgrupo.nome) LIKE '%{$nome}%')"
                      . "ORDER BY CASE subgrupo.nome "
                      . "WHEN UPPER(subgrupo.nome)='{$nome}' THEN 0 "
                      . "WHEN UPPER(subgrupo.nome)='{$nome}%' THEN 1 "
                      . "WHEN UPPER(subgrupo.nome)='%{$nome}' THEN 2 "
                      . "WHEN UPPER(subgrupo.nome)='%{$nome}%' THEN 3 "
                      . "ELSE subgrupo.nome END";
          }
          if ($nome != '' && $codigo != '') {
              $sql = "SELECT produto.id_produto, "
                      . "produto.barcode, "
                      . "produto.preco, "
                      . "produto.estoque, "
                      . "produto.especificacao, "
                      . "produto.id_subgrupo, "
                      . "subgrupo.nome, "
                      . "subgrupo.descricao, "
                      . "subgrupo.imagem, "
                      . "subgrupo.destaque, "
                      . "subgrupo.id_grupo, "
                      . "subgrupo.id_marca "
                      . "FROM produto JOIN subgrupo ON produto.id_subgrupo=subgrupo.id_subgrupo "
                      . "WHERE (UPPER(produto.barcode) LIKE '%{$codigo}%'OR UPPER(subgrupo.nome) LIKE '%{$nome}%') "
                      . "ORDER BY CASE "
                      . "WHEN UPPER(produto.barcode)='{$codigo}' and UPPER(subgrupo.nome)='{$nome}' THEN 0 "
                      . "WHEN UPPER(produto.barcode)='%{$codigo}%' and UPPER(subgrupo.nome)='{$nome}%' THEN 1 "
                      . "WHEN UPPER(produto.barcode)='{$codigo}' or UPPER(subgrupo.nome)='{$nome}' THEN 2 "
                      . "WHEN UPPER(produto.barcode)='%{$codigo}%' or UPPER(subgrupo.nome)='{$nome}%' THEN 3 "
                      . "ELSE produto.barcode END";
          }
          $consulta = $this->ExecuteQuery($sql, array());


          foreach ($consulta as $linha) {

              $list[] = new Packproduto($linha['id_produto'], $linha['barcode'], $linha['preco'], $linha['estoque'], $linha['especificacao'], $linha['id_subgrupo'], $linha['nome'], $linha['descricao'], $linha['imagem'], $linha['destaque'], $linha['id_grupo'], $linha['id_marca']);
          }

          //echo '<pre>';var_dump($list);echo '</pre>';die;

          return $list;
      }

      public function searchProdutoAgrupado($nome, $codigo) {
          $list = [];

          if ($nome == '' && $codigo != '') {
            $sql = "SELECT DISTINCT subgrupo.* FROM subgrupo JOIN produto ON produto.id_subgrupo=subgrupo.id_subgrupo WHERE UPPER(produto.barcode) like '%{$codigo}%'";
          }
          if ($nome != '' && $codigo == '') {
            $sql = "SELECT DISTINCT subgrupo.* FROM subgrupo JOIN produto ON produto.id_subgrupo=subgrupo.id_subgrupo WHERE UPPER(subgrupo.nome) like '%{$nome}%'";
          }
          if ($nome != '' && $codigo != '') {
            $sql = "SELECT DISTINCT subgrupo.* FROM subgrupo JOIN produto ON produto.id_subgrupo=subgrupo.id_subgrupo WHERE UPPER(produto.barcode) like '%{$codigo}%' OR UPPER(subgrupo.nome) like '%{$nome}%'";
          }

          $consulta = $this->ExecuteQuery($sql, array());

          foreach ($consulta as $subgrupo) {
            $list[] = new Subgrupo($subgrupo['id_subgrupo'], $subgrupo['nome'], $subgrupo['descricao'], $subgrupo['imagem'], $subgrupo['destaque'], $subgrupo['id_grupo'], $subgrupo['id_marca']);
          }
          //echo '<pre>';var_dump($list);echo '</pre>';die;
          return $list;
      }

      public function getAllBarcodes() {

          $list = [];

          $sql = "SELECT barcode from produto";
          $consulta = $this->ExecuteQuery($sql, $list);

          foreach ($consulta as $barcode) {
            $list[] = $barcode['barcode'];
          }
          //echo '<pre>';var_dump($list);echo '</pre>';die;
          return $list;
      }

      public function updateByTxt($barcode,$preco,$estoque,$array) {
        //IMPORTANTE!! $array É ARRAY COM TODOS OS BARCODES


        //echo '<pre>';var_dump($array);echo '</pre>';
        //echo '<pre>';var_dump($barcode);echo '</pre>';

        if(in_array($barcode, $array)){

          //echo '<h1 style="COLOR:blue">existe</h1>';

          $sql = "UPDATE produto SET preco = :preco, estoque = :estoque WHERE barcode = :barcode";
          $param = [':barcode' => $barcode,
                    ':preco' => $preco,
                    ':estoque' => $estoque
                    ];
          if ($this->ExecuteCommand($sql, $param)) {

            //echo '<h1 style="COLOR:green">CERTO</h1>';

              $ver = array(1,$barcode);
              return $ver;
          }else{
            $ver = array(2,$barcode);
            return $ver;
          }

        }else {

          //echo '<h1 style="COLOR:RED">ERRADO</h1>';

          $ver = array(3,$barcode);
          return $ver;
        }

      }

      public function insertByTxt($barcode,$preco,$estoque,$especificacao,$id_subgrupo,$array) {
        //IMPORTANTE!! $array É ARRAY COM TODOS OS BARCODES

        //echo '<pre>';var_dump($array);echo '</pre>';
        //echo '<pre>';var_dump($barcode);echo '</pre>';

        if(!in_array($barcode, $array)){

          //echo '<h1 style="COLOR:blue">existe</h1>';

          $sql = "INSERT INTO produto(barcode,preco,estoque,especificacao,id_subgrupo) VALUES(:barcode,:preco,:estoque,:especificacao,:id_subgrupo)";
          
          $param = [':barcode' => $barcode,
                    ':preco' => $preco,
                    ':estoque' => $estoque,
                    ':especificacao' => $especificacao,
                    ':id_subgrupo' => $id_subgrupo
                    ];

          if ($this->ExecuteCommand($sql, $param)) {
              $ver = array(1,$barcode);
              return $ver;
          }else{
            $ver = array(2,$barcode);
            return $ver;
          }
        }else {
          $ver = array(3,$barcode);
          return $ver;
        }

      }

  }
