<?php

class PedidoModel extends Model {

    public function getPedido() {
        $list = [];
        $list1 = [];

        $sql = "SELECT pedido.*, itemcarrinho.*, produto.*, subgrupo.* FROM pedido
                JOIN carrinho ON pedido.id_carrinho = carrinho.id_carrinho
                JOIN itemcarrinho ON carrinho.id_carrinho = itemcarrinho.id_carrinho
                JOIN produto ON itemcarrinho.id_produto = produto.id_produto
                JOIN subgrupo ON produto.id_subgrupo = subgrupo.id_subgrupo";
        $consulta = $this->ExecuteQuery($sql, array());
         // echo "<pre>";
         // var_dump($consulta);die;
         echo "<pre>";
        foreach ($consulta as $linha) {
          $list1[] = array('id_pedido' => $linha['id_pedido'],'produto' => new Packproduto($linha['id_produto'], $linha['barcode'], $linha['preco'], $linha['estoque'], $linha['especificacao'], $linha['id_subgrupo'], $linha['nome'], $linha['descricao'], $linha['imagem'], $linha['destaque'], $linha['id_grupo'], $linha['id_marca']), 'quantidade' => $linha['quantidade']);
        }
        print_r($list1);
        die;
        foreach ($consulta as $linha) {
          $listaux = [];

        //  $list[] = array(new Pedido($linha['id_pedido'],$linha['nome'],$linha['endereco'],$linha['cep'],$linha['cidade'],$linha['uf'],$linha['telefone'],
                            //  $linha['email'],$linha['mensagem'],$linha['precototal'],$linha['data'],$linha['status'],$linha['id_carrinho']), $listaux);
          //var_dump($listaux);
          //unset($listaux);
        }
        die;

        //return $list;
    }

    public function getPedidoPendente() {
        $list = [];
        $sql = "SELECT * FROM pedido WHERE status='NAO ENTREGUE'";
        $consulta = $this->ExecuteQuery($sql, array());
        foreach ($consulta as $linha) {
            $list[] = new Pedido($linha['id_carrinho'],
                                $linha['nome'],
                                $linha['endereco'],
                                $linha['cep'],
                                $linha['cidade'],
                                $linha['uf'],
                                $linha['telefone'],
                                $linha['email'],
                                $linha['mensagem'],
                                $linha['precototal'],
                                $linha['data'],
                                $linha['status'],
                                $linha['id_carrinho']);
        }
        return $list;
    }

    public function getPedidoConcluido() {
        $list = [];
        $sql = "SELECT * FROM pedido WHERE status='ENTREGUE' LIMIT 10";
        $consulta = $this->ExecuteQuery($sql, array());
        foreach ($consulta as $linha) {
            $list[] = new Pedido($linha['id_carrinho'],
                                $linha['nome'],
                                $linha['endereco'],
                                $linha['cep'],
                                $linha['cidade'],
                                $linha['uf'],
                                $linha['telefone'],
                                $linha['email'],
                                $linha['mensagem'],
                                $linha['precototal'],
                                $linha['data'],
                                $linha['status'],
                                $linha['id_carrinho']);
        }
        return $list;
    }

    public function insertPedido($pedido) {
        $sql = "INSERT INTO pedido(nome,endereco,cep,cidade,uf,telefone,email,mensagem,precototal,data,status,id_carrinho) VALUES(:nome,:endereco,:cep,:cidade,:uf,:telefone,:email,:mensagem,:precototal,:data,:status,:id_carrinho)";
        if ($this->ExecuteCommand($sql,[':nome'=>$pedido->getNome(),
                                        ':endereco'=>$pedido->getEndereco(),
                                        ':cep'=>$pedido->getCep(),
                                        ':cidade'=>$pedido->getCidade(),
                                        ':uf'=>$pedido->getUf(),
                                        ':telefone'=>$pedido->getTelefone(),
                                        ':email'=>$pedido->getEmail(),
                                        ':mensagem'=>$pedido->getMensagem(),
                                        ':precototal'=>$pedido->getPrecototal(),
                                        ':data'=>$pedido->getData(),
                                        ':status'=>$pedido->getStatus(),
                                        ':id_carrinho'=>$pedido->getId_carrinho()])){
            return true;
        } else {
            return false;
        }
    }

    public function changeStatus($id) {
        $sql = "UPDATE pedido SET status = 'ENTREGUE' WHERE id_pedido = :id";
        $param = [':id'=>$id];
        if ($this->ExecuteCommand($sql,$param)) {
            return true;
        } else {
            return false;
        }
    }

}
