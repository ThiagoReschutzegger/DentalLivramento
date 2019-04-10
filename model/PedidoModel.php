<?php

class PedidoModel extends Model {

    public function getPedido() {
        $list = [];
        $sql = "SELECT pedido.*, itemcarrinho.*, produto.* FROM pedido
                JOIN carrinho ON pedido.id_carrinho = carrinho.id_carrinho
                JOIN itemcarrinho ON carrinho.id_carrinho = itemcarrinho.id_carrinho
                JOIN produto ON itemcarrinho.id_produto = produto.id_produto";
        $consulta = $this->ExecuteQuery($sql, array());
        //echo "<pre>";
        //var_dump($consulta);die;

        foreach ($consulta as $linha) {

          $list[] = new Pedido($linha['id_pedido'],$linha['nome'],$linha['endereco'],$linha['cep'],$linha['cidade'],$linha['uf'],$linha['telefone'],
                              $linha['email'],$linha['mensagem'],$linha['precototal'],$linha['data'],$linha['status'],$linha['id_carrinho']);
        }
        //echo "<pre>";
        //var_dump($list);die;
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
