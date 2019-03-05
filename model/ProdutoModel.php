<?php

class ProdutoModel extends Model {

    public function getProduto() {
        $list = [];
        $sql = "SELECT * FROM produto";
        $consulta = $this->ExecuteQuery($sql, array());
        foreach ($consulta as $linha) {
            $list[] = new Produto($linha['id_produto'], $linha['barcode'], $linha['preco'], $linha['estoque'], $linha['especificacao']);
        }
        return $list;
    }

    public function getProdutoById($id) {
        $sql = "SELECT * FROM produto WHERE id_produto=:id;";
        $produto = $this->ExecuteQuery($sql, [':id' => $id])[0];
        return new Produto($produto['id_produto'], $produto['barcode'], $produto['preco'], $produto['estoque'], $produto['especificacao']);
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
        $sql = "UPDATE produto SET barcode = :barcode, preco = :preco, estoque = :estoque, especificacao = :especificacao WHERE id_produto = :id";
        $param = [':barcode' => $produto->getBarcode(),
                    ':preco' => $produto->getPreco(),
                    ':estoque' => $produto->getEstoque(),
                    ':id_prouto' => $produto->getId_produto(),
                    ':especificacao' => $produto->getEspecificacao()
                ];
        if ($this->ExecuteCommand($sql, $param)) {
            return true;
        } else {
            return false;
        }
    }

    public function searchProdutoUnitario($nome, $codigo) {
        $list = [];

        if($nome == '' && $codigo != ''){
            $sql = "SELECT * FROM produto WHERE (barcode LIKE '%{$codigo}%')";
        }
        if($nome != '' && $codigo == ''){
            $sql = "SELECT * FROM produto WHERE (nome LIKE '%{$nome}%')";
        }
        if($nome != '' && $codigo != ''){
            $sql = "SELECT * FROM produto WHERE (barcode LIKE '%{$codigo}%' OR nome LIKE '%{$nome}%') ORDER BY CASE barcode WHEN barcode='{$codigo}' and nome='{$nome}' THEN '0' WHEN barcode='{$codigo}' or nome='{$nome}' THEN '1' ELSE nome END";
        }
        $consulta = $this->ExecuteQuery($sql,array());

        foreach ($consulta as $linha) {
            $list[] = new Produto($linha['id_produto'], $linha['barcode'], $linha['preco'], $linha['nome'], $linha['estoque'], $linha['imagem'], $linha['descricao'], $linha['destaque'], $linha['tipo'], $linha['id_grupo'], $linha['id_marca']);
        }

        return $list;
    }

        public function searchProdutoAgrupado($nome, $codigo) {
        $list = [];

        if($nome == '' && $codigo != ''){
            $sql = "SELECT * FROM produto WHERE (barcode LIKE '%{$codigo}%')";
        }
        if($nome != '' && $codigo == ''){
            $sql = "SELECT * FROM produto WHERE (nome LIKE '%{$nome}%')";
        }
        if($nome != '' && $codigo != ''){
            $sql = "SELECT * FROM produto WHERE (barcode LIKE '%{$codigo}%' OR nome LIKE '%{$nome}%') ORDER BY CASE barcode WHEN barcode='{$codigo}' and nome='{$nome}' THEN '0' WHEN barcode='{$codigo}' or nome='{$nome}' THEN '1' ELSE nome END";
        }
        $consulta = $this->ExecuteQuery($sql,array());

        foreach ($consulta as $linha) {
            $list[] = new Produto($linha['id_produto'], $linha['barcode'], $linha['preco'], $linha['nome'], $linha['estoque'], $linha['imagem'], $linha['descricao'], $linha['destaque'], $linha['tipo'], $linha['id_grupo'], $linha['id_marca']);
        }

        return $list;
    }



}
