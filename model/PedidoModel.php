<?php

class PedidoModel extends Model {

    function group_by($key, $data) {
      $result = array();

      foreach($data as $val) {
      if(array_key_exists($key, $val)){
      $result[$val[$key]][] = $val;
      }else{
      $result[""][] = $val;
      }
      }

      return $result;
    }

    public function getPedido() {
        $list = [];
        $list1 = [];

        $sql = "SELECT pedido.*, itemcarrinho.*, produto.*, subgrupo.*, pedido.nome AS nomepedido
                FROM pedido
                JOIN carrinho ON pedido.id_carrinho = carrinho.id_carrinho
                JOIN itemcarrinho ON carrinho.id_carrinho = itemcarrinho.id_carrinho
                JOIN produto ON itemcarrinho.id_produto = produto.id_produto
                JOIN subgrupo ON produto.id_subgrupo = subgrupo.id_subgrupo
                ORDER BY pedido.id_pedido DESC";

        $consulta = $this->ExecuteQuery($sql, array());

        foreach ($consulta as $linha) {
          $list1[] = array('id_pedido' => $linha['id_pedido'],'produto' => new Packproduto($linha['id_produto'], $linha['barcode'], $linha['preco'], $linha['estoque'], $linha['especificacao'], $linha['id_subgrupo'], $linha['nome'], $linha['descricao'], $linha['imagem'], $linha['destaque'], $linha['id_grupo'], $linha['id_marca']), 'quantidade' => $linha['quantidade']);
        }

        $list1 = $this->group_by("id_pedido", $list1);

        foreach($list1 as $prods){
          //echo "1<br>";
          //print_r( $prods[0]['id_pedido']);
          foreach ($consulta as $linha2){
            //echo "2<br>";
            if($prods[0]['id_pedido'] == $linha2['id_pedido']){
              //echo '3<br>';
              $list[] = array(new Pedido($linha2['id_pedido'],$linha2['nomepedido'],$linha2['endereco'],$linha2['cep'],$linha2['cidade'],$linha2['uf'],$linha2['telefone'],
                                         $linha2['email'],$linha2['mensagem'],$linha2['precototal'],$linha2['data'],$linha2['status'],$linha2['id_carrinho']), $prods);
            }
          }

        }

        $ha = array_unique($list, SORT_REGULAR);
        return $ha;
    }

    public function getPedidoPendente() {
      $list = [];
      $list1 = [];
        $sql = "SELECT pedido.*, itemcarrinho.*, produto.*, subgrupo.*, pedido.nome AS nomepedido FROM pedido JOIN carrinho ON pedido.id_carrinho = carrinho.id_carrinho JOIN itemcarrinho ON carrinho.id_carrinho = itemcarrinho.id_carrinho JOIN produto ON itemcarrinho.id_produto = produto.id_produto JOIN subgrupo ON produto.id_subgrupo = subgrupo.id_subgrupo WHERE status='NAO ENTREGUE' ORDER BY pedido.id_pedido DESC";
        $consulta = $this->ExecuteQuery($sql, array());

        foreach ($consulta as $linha) {
          $list1[] = array('id_pedido' => $linha['id_pedido'],'produto' => new Packproduto($linha['id_produto'], $linha['barcode'], $linha['preco'], $linha['estoque'], $linha['especificacao'], $linha['id_subgrupo'], $linha['nome'], $linha['descricao'], $linha['imagem'], $linha['destaque'], $linha['id_grupo'], $linha['id_marca']), 'quantidade' => $linha['quantidade']);
        }

        $list1 = $this->group_by("id_pedido", $list1);

        foreach($list1 as $prods){
          //echo "1<br>";
          //print_r( $prods[0]['id_pedido']);
          foreach ($consulta as $linha2){
            //echo "2<br>";
            if($prods[0]['id_pedido'] == $linha2['id_pedido']){
              //echo '3<br>';
              $list[] = array(new Pedido($linha2['id_pedido'],$linha2['nomepedido'],$linha2['endereco'],$linha2['cep'],$linha2['cidade'],$linha2['uf'],$linha2['telefone'],
                                         $linha2['email'],$linha2['mensagem'],$linha2['precototal'],$linha2['data'],$linha2['status'],$linha2['id_carrinho']), $prods);
            }
          }

        }

        $ha = array_unique($list, SORT_REGULAR);
        return $ha;
    }

    public function getPedidoConcluido() {
      $list = [];
      $list1 = [];
        $sql = "SELECT pedido.*, itemcarrinho.*, produto.*, subgrupo.*, pedido.nome AS nomepedido FROM pedido JOIN carrinho ON pedido.id_carrinho = carrinho.id_carrinho JOIN itemcarrinho ON carrinho.id_carrinho = itemcarrinho.id_carrinho JOIN produto ON itemcarrinho.id_produto = produto.id_produto JOIN subgrupo ON produto.id_subgrupo = subgrupo.id_subgrupo WHERE status='ENTREGUE' ORDER BY pedido.id_pedido DESC LIMIT 10";

        $consulta = $this->ExecuteQuery($sql, array());

        foreach ($consulta as $linha) {
          $list1[] = array('id_pedido' => $linha['id_pedido'],'produto' => new Packproduto($linha['id_produto'], $linha['barcode'], $linha['preco'], $linha['estoque'], $linha['especificacao'], $linha['id_subgrupo'], $linha['nome'], $linha['descricao'], $linha['imagem'], $linha['destaque'], $linha['id_grupo'], $linha['id_marca']), 'quantidade' => $linha['quantidade']);
        }

        $list1 = $this->group_by("id_pedido", $list1);

        foreach($list1 as $prods){
          //echo "1<br>";
          //print_r( $prods[0]['id_pedido']);
          foreach ($consulta as $linha2){
            //echo "2<br>";
            if($prods[0]['id_pedido'] == $linha2['id_pedido']){
              //echo '3<br>';
              $list[] = array(new Pedido($linha2['id_pedido'],$linha2['nomepedido'],$linha2['endereco'],$linha2['cep'],$linha2['cidade'],$linha2['uf'],$linha2['telefone'],
                                         $linha2['email'],$linha2['mensagem'],$linha2['precototal'],$linha2['data'],$linha2['status'],$linha2['id_carrinho']), $prods);
            }
          }

        }

        $ha = array_unique($list, SORT_REGULAR);
        return $ha;

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
