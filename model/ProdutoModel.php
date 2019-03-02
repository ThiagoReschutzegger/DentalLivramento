<?php

class ProdutoModel extends Model {

    public function getProduto() {
        $list = [];
        $sql = "SELECT * FROM produto";
        $consulta = $this->ExecuteQuery($sql, array());
        foreach ($consulta as $linha) {
            $list[] = new Produto($linha['id_produto'], $linha['barcode'], $linha['preco'], $linha['nome'], $linha['estoque'], $linha['imagem'], $linha['descricao'], $linha['destaque'], $linha['tipo'], $linha['id_grupo'], $linha['id_marca']);
        }
        return $list;
    }

    public function getProdutoById($id) {
        $sql = "SELECT * FROM produto WHERE id_produto=:id;";
        $consulta = $this->ExecuteQuery($sql, [':id' => $id])[0];
        $produto = $this->ExecuteQuery($sql, [':id' => $id])[0];
        return new Produto($produto['id_produto'], $produto['barcode'], $produto['preco'], $produto['nome'], $produto['estoque'], $produto['imagem'], $produto['descricao'], $produto['destaque'], $produto['tipo'], $produto['id_grupo'], $produto['id_marca']);
    }

    public function insertProduto($produto) {
        $sql = "INSERT INTO produto(barcode,preco,nome,estoque,imagem,descricao,destaque,tipo,id_grupo,id_marca) VALUES(:barcode,:preco,:nome,:estoque,:imagem,:descricao,:destaque,:tipo,:id_grupo,:id_marca)";
        if ($this->ExecuteCommand($sql, [':barcode' => $produto->getBarcode(),
                    ':preco' => $produto->getPreco(),
                    ':nome' => $produto->getNome(),
                    ':estoque' => $produto->getEstoque(),
                    ':imagem' => $produto->getImagem(),
                    ':descricao' => $produto->getDescricao(),
                    ':destaque' => $produto->getDestaque(),
                    ':tipo' => $produto->getTipo(),
                    ':id_grupo' => $produto->getId_produto(),
                    ':id_marca' => $produto->getId_marca()
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
        $sql = "UPDATE produto SET nome = :nome, imagem = :imagem  WHERE id_produto = :id";
        $param = [':nome' => $produto->getNome(), ':imagem' => $produto->getImagem(), ':id' => $produto->getId_produto()];
        if ($this->ExecuteCommand($sql, $param)) {
            return true;
        } else {
            return false;
        }
    }

    public function searchProduto($nome, $codigo) {
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
