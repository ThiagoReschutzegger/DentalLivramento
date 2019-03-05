<?php

class HomeAdminModel extends Model {

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

    public function getEstiloById($id) {

        $sql = "SELECT * FROM estilo WHERE id_estilo=:id;";
        $consulta = $this->ExecuteQuery($sql, [':id' => $id])[0];
        $estilo = $this->ExecuteQuery($sql, [':id' => $id])[0];
            return new Estilo( $estilo['id_estilo'],$estilo['hexadecimal'],$estilo['local'],$estilo['nome'],$estilo['status']);
    }

    public function updateEstilo($estilo) {
      $sql = "UPDATE estilo SET status = 1 WHERE id_estilo = :id;";

        $param = [':id'=>$estilo->getId_estilo()];

        if ($this->ExecuteCommand($sql, $param)) {
            return true;
        } else {
            return false;
        }
    }

    public function zerarEstilo($estilo) {
      $sql = "UPDATE estilo SET status = 0 WHERE id_estilo != :id;";

        $param = [':id'=>$estilo->getId_estilo()];

        if ($this->ExecuteCommand($sql, $param)) {
            return true;
        } else {
            return false;
        }
    }
}
