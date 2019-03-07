<?php

class SubgrupoModel extends Model {

    public function getSubgrupo() {
        $list = [];
        $sql = "SELECT * FROM subgrupo";
        $consulta = $this->ExecuteQuery($sql, array());
        foreach ($consulta as $subgrupo) {
            $list[] = new Subgrupo($subgrupo['id_subgrupo'], $subgrupo['nome'], $subgrupo['descricao'], $subgrupo['imagem'], $subgrupo['destaque'], $subgrupo['id_grupo'], $subgrupo['id_marca']);
        }
        return $list;
    }

    public function getIdBy($nome, $descricao, $imagem) {
        $sql = "SELECT * FROM subgrupo WHERE nome = :nome AND descricao = :descricao AND imagem = :imagem;";
        $subgrupo = $this->ExecuteQuery($sql, [':nome' => $nome, ':descricao' => $descricao, ':imagem' => $imagem ])[0];
        return new Subgrupo($subgrupo['id_subgrupo'], $subgrupo['nome'], $subgrupo['descricao'], $subgrupo['imagem'],  $subgrupo['destaque'], $subgrupo['id_grupo'], $subgrupo['id_marca']);
    }

    public function getSubgrupoById($id) {
        $sql = "SELECT * FROM subgrupo WHERE id_subgrupo = :id;";
        $subgrupo = $this->ExecuteQuery($sql, [':id' => $id])[0];
        return new Subgrupo($subgrupo['id_subgrupo'], $subgrupo['nome'], $subgrupo['descricao'], $subgrupo['imagem'], $subgrupo['destaque'], $subgrupo['id_grupo'], $subgrupo['id_marca']);
    }

    public function getSubgrupoByGrupo($id) {
        $list = [];
        $sql = "SELECT * FROM subgrupo WHERE id_grupo = :id;";
        $consulta = $this->ExecuteQuery($sql, [':id' => $id]);
        foreach ($consulta as $subgrupo) {
            $list[] = new Subgrupo($subgrupo['id_subgrupo'], $subgrupo['nome'], $subgrupo['descricao'], $subgrupo['imagem'], $subgrupo['destaque'], $subgrupo['id_grupo'], $subgrupo['id_marca']);
        }
        return $list;
    }

    public function insertSubgrupo($subgrupo) {
        $sql = "INSERT INTO subgrupo(nome,descricao,imagem,destaque,id_grupo,id_marca) VALUES(:nome,:descricao,:imagem,:destaque,:id_grupo,:id_marca)";
        if ($this->ExecuteCommand($sql, [':nome' => $subgrupo->getNome(),
                                        ':descricao' => $subgrupo->getDescricao(),
                                        ':imagem' => $subgrupo->getImagem(),
                                        ':destaque' => $subgrupo->getDestaque(),
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
