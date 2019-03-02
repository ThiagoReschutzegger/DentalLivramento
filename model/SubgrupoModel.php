<?php

class SubgrupoModel extends Model {

    public function getSubgrupo() {
        $list = [];
        $sql = "SELECT * FROM subgrupo";
        $consulta = $this->ExecuteQuery($sql, array());
        foreach ($consulta as $linha) {
            $list[] = new Subgrupo($linha['id_subgrupo'], $linha['nome'], $linha['imagem'], $linha['descricao'], $linha['id_grupo'], $linha['id_marca']);
        }
        return $list;
    }

    public function getSubgrupoById($id) {
        $sql = "SELECT * FROM subgrupo WHERE id_subgrupo=:id;";
        $consulta = $this->ExecuteQuery($sql, [':id' => $id])[0];
        $subgrupo = $this->ExecuteQuery($sql, [':id' => $id])[0];
        return new Subgrupo($subgrupo['id_subgrupo'], $subgrupo['nome'], $subgrupo['imagem'], $subgrupo['descricao'], $subgrupo['id_grupo'], $subgrupo['id_marca']);
    }

    public function insertSubgrupo($subgrupo) {
        $sql = "INSERT INTO subgrupo(nome,imagem,descricao,id_grupo,id_marca) VALUES(:nome,:imagem,:descricao,:id_grupo,:id_marca)";
        if ($this->ExecuteCommand($sql, [':nome' => $subgrupo->getNome(),
                                        ':imagem' => $subgrupo->getImagem(),
                                        ':descricao' => $subgrupo->getDescricao(),
                                        ':id_grupo' => $subgrupo->getId_grupo(),
                                        ':id_marca' => $subgrupo->getId_marca()
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
        $sql = "UPDATE subgrupo SET nome = :nome, imagem = :imagem, descricao = :descricao, id_grupo = :id_grupo, id_marca = :id_marca WHERE id_subgrupo = :id";
        $param = [':id_subgrupo' => $subgrupo->getId_subgrupo(),
                  ':nome' => $subgrupo->getNome(),
                  ':imagem' => $subgrupo->getImagem(),
                  ':descricao' => $subgrupo->getDescricao(),
                  ':id_grupo' => $subgrupo->getId_grupo(),
                  ':id_marca' => $subgrupo->getId_marca()
                ];
        if ($this->ExecuteCommand($sql, $param)) {
            return true;
        } else {
            return false;
        }
    }

    public function searchSubgrupo($nome, $codigo) {
        $list = [];

        if($nome == '' && $codigo != ''){
            $sql = "SELECT * FROM subgrupo WHERE (barcode LIKE '%{$codigo}%')";
        }
        if($nome != '' && $codigo == ''){
            $sql = "SELECT * FROM subgrupo WHERE (nome LIKE '%{$nome}%')";
        }
        if($nome != '' && $codigo != ''){
            $sql = "SELECT * FROM subgrupo WHERE (barcode LIKE '%{$codigo}%' OR nome LIKE '%{$nome}%')";
        }
        $consulta = $this->ExecuteQuery($sql,array());

        foreach ($consulta as $linha) {
            $list[] = new Subgrupo($linha['id_subgrupo'], $linha['barcode'], $linha['preco'], $linha['nome'], $linha['estoque'], $linha['imagem'], $linha['descricao'], $linha['destaque'], $linha['tipo'], $linha['id_grupo'], $linha['id_marca']);
        }
        return $list;
    }



}
