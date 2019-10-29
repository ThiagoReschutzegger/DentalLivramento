<?php

class Slider_1Model extends Model {

    public function getSlider_1() {
        $slider_1 = [];
        $sql = "SELECT * FROM slider_1";
        $consulta = $this->ExecuteQuery($sql, array());
        foreach ($consulta as $linha) {
            $slider_1[] = new Slider($linha['id_slider'],$linha['imagem'],$linha['status'],$linha['id_item']);
        }

        //echo '<pre>';var_dump($slider_1);echo '</pre>';die;

        return $slider_1;
    }

//    public function getSlider_1SubgrupoIds() {
//        $slider_1 = [];
//        $sql = "SELECT slider_1.id_subgrupo FROM slider_1 WHERE slider_1.status = 1;";
//        $consulta = $this->ExecuteQuery($sql, array());
//        foreach ($consulta as $linha) {
//            $slider_1[] = $linha['id_subgrupo'];
//        }
//
//        //echo '<pre>';var_dump($slider_1);echo '</pre>';die;
//
//        return $slider_1;
//    }

    public function getSliderById($id) {
        $sql = "SELECT * FROM slider_1 WHERE id_slider = :id;";
        $linha = $this->ExecuteQuery($sql, [':id' => $id])[0];
            return new Slider($linha['id_slider'],$linha['imagem'],$linha['status'],$linha['id_item']);
    }

    public function insertSlider_1($slider_1) {
      // print_r($slider_1);die;
        $sql = "INSERT INTO slider_1(imagem,status,id_item) VALUES(:imagem,1,:id_item)";
        if ($this->ExecuteCommand($sql,[':id_item'=>$slider_1->getId_item(),':imagem'=>$slider_1->getImagem()])){
            return true;
        } else {
            return false;
        }
    }

     public  function removeSlider_1($id) {
        $sql = "DELETE FROM slider_1 WHERE id_slider = :id";
        if ($this->ExecuteCommand($sql, [':id'=>$id])) {
            return true;
        } else {
            return false;
        }
    }

    public function updateSlider_1($slider_1) {
        $sql = "UPDATE slider_1 SET imagem = :imagem, status = :status, id_item = :id_item WHERE id_slider = :id";
        $param = [':id'=>$slider_1->getId_slider(),':id_item'=>$slider_1->getId_item(),':imagem'=>$slider_1->getImagem(),':status'=>$slider_1->getStatus()];
        if ($this->ExecuteCommand($sql,$param)) {
            return true;
        } else {
            return false;
        }
    }


}
