<?php

class PackprodutoModel extends Model {

    public function getPackproduto() {
        $list = [];
        $sql = "SELECT produto.* , subgrupo.* FROM packproduto JOIN produto ON produto.id_produto = packproduto.id_produto JOIN subgrupo ON subgrupo.id_subgrupo = packproduto.id_subgrupo";
        $consulta = $this->ExecuteQuery($sql, array());
        foreach ($consulta as $linha) {
            $list[] = new Packproduto($linha['id_packproduto'],
                                      $linha['id_produto'],
                                      $linha['barcode'],
                                      $linha['preco'],
                                      $linha['estoque'],
                                      $linha['especificacao'],
                                      $linha['id_subgrupo'],
                                      $linha['nome'],
                                      $linha['imagem'],
                                      $linha['descricao'],
                                      $linha['id_grupo'],
                                      $linha['id_marca']);
        }
        return $list;
    }

    public function getPackprodutoById($id) {
        $sql = "SELECT produto.* , subgrupo.* FROM packproduto JOIN produto ON produto.id_produto = packproduto.id_produto JOIN subgrupo ON subgrupo.id_subgrupo = packproduto.id_subgrupo WHERE subgrupo.id_subgrupo = :id";
        $linha = $this->ExecuteQuery($sql, [':id' => $id])[0];
        return new Packproduto($linha['id_packproduto'],
                                $linha['id_produto'],
                                $linha['barcode'],
                                $linha['preco'],
                                $linha['estoque'],
                                $linha['especificacao'],
                                $linha['id_subgrupo'],
                                $linha['nome'],
                                $linha['imagem'],
                                $linha['descricao'],
                                $linha['id_grupo'],
                                $linha['id_marca']);
    }

    
    public function searchPackproduto($nome, $codigo) {
        $list = [];

        if($nome == '' && $codigo != ''){
            $sql = "SELECT * FROM packproduto WHERE (barcode LIKE '%{$codigo}%')";
        }
        if($nome != '' && $codigo == ''){
            $sql = "SELECT * FROM packproduto WHERE (nome LIKE '%{$nome}%')";
        }
        if($nome != '' && $codigo != ''){
            $sql = "SELECT * FROM packproduto WHERE (barcode LIKE '%{$codigo}%' OR nome LIKE '%{$nome}%')";
        }
        $consulta = $this->ExecuteQuery($sql,array());

        foreach ($consulta as $linha) {
            $list[] = new Packproduto($linha['id_packproduto'], $linha['barcode'], $linha['preco'], $linha['nome'], $linha['estoque'], $linha['imagem'], $linha['descricao'], $linha['destaque'], $linha['tipo'], $linha['id_grupo'], $linha['id_marca']);
        }
        return $list;
    }



}
