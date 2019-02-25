<?php

class HomeAdminModel extends Model {
    /*
     * Retorna o nº de dias que foi trocada a senha
     */

    public function getEstilo() {
      $list = array();
      $sql = "SELECT * FROM estilo";

      $resultados = $this->ExecuteQuery($sql, array());

      foreach ($resultados as $linha) {
          $list[] = new Estilo($linha['id_estilo'],$linha['hexadecimal'],$linha['local'],$linha['nome'],$linha['status']);
      }
      return $list;
    }
    
    public function getEstiloAtual() {
      $list = array();
      $sql = "SELECT * FROM estilo WHERE status=1";

      $resultados = $this->ExecuteQuery($sql, array());

      foreach ($resultados as $linha) {
          $list = new Estilo($linha['id_estilo'],$linha['hexadecimal'],$linha['local'],$linha['nome'],$linha['status']);
      }
      return $list;
    }
    
    public function updateEstilo($id) {
      $sql = "UPDATE estilo SET status = 0 WHERE id_estilo != :Id;
              UPDATE estilo SET status = 1 WHERE id_estilo = :Id;";
      
        $param = [':Id' => $id];
        
        if ($this->ExecuteCommand($sql, $param)) {
            return true;
        } else {
            return false;
        }
    }
}
