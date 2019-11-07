<?php

class Slider_2Model extends Model {

    public function getSlider_2() {
        $slider_2 = [];
        $sql = "SELECT * FROM slider_2";
        $consulta = $this->ExecuteQuery($sql, array());
        foreach ($consulta as $linha) {
            $slider_2[] = new Slider($linha['id_slider'],$linha['imagem'],$linha['status'],$linha['id_item']);
        }

        //echo '<pre>';var_dump($slider_2);echo '</pre>';die;

        return $slider_2;
    }

//    public function getSlider_2SubgrupoIds() {
//        $slider_2 = [];
//        $sql = "SELECT slider_2.id_subgrupo FROM slider_2 WHERE slider_2.status = 1;";
//        $consulta = $this->ExecuteQuery($sql, array());
//        foreach ($consulta as $linha) {
//            $slider_2[] = $linha['id_subgrupo'];
//        }
//
//        //echo '<pre>';var_dump($slider_2);echo '</pre>';die;
//
//        return $slider_2;
//    }
    public function getSliderById($id) {
        $sql = "SELECT * FROM slider_2 WHERE id_slider = :id;";
        $linha = $this->ExecuteQuery($sql, [':id' => $id])[0];
            return new Slider($linha['id_slider'],$linha['imagem'],$linha['status'],$linha['id_item']);
    }

    public function insertSlider_2($slider_2) {
      // print_r($slider_2);die;
        $sql = "INSERT INTO slider_2(imagem,status,id_item) VALUES(:imagem,1,:id_item)";
        if ($this->ExecuteCommand($sql,[':id_item'=>$slider_2->getId_item(),':imagem'=>$slider_2->getImagem()])){
            return true;
        } else {
            return false;
        }
    }

     public  function removeSlider_2($id) {
        $sql = "DELETE FROM slider_2 WHERE id_slider = :id";
        if ($this->ExecuteCommand($sql, [':id'=>$id])) {
            return true;
        } else {
            return false;
        }
    }

    public function updateSlider_2($slider_2) {
        $sql = "UPDATE slider_2 SET imagem = :imagem, status = :status, id_item = :id_item WHERE id_slider = :id";
        $param = [':id'=>$slider_2->getId_slider(),':id_item'=>$slider_2->getId_item(),':imagem'=>$slider_2->getImagem(),':status'=>$slider_2->getStatus()];
        if ($this->ExecuteCommand($sql,$param)) {
            return true;
        } else {
            return false;
        }
    }


}
