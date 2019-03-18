<?php

class SliderModel extends Model {

    public function getSlider() {
        $slider = [];
        $sql = "SELECT slider.id_slider, slider.id_subgrupo, slider.imagem, slider.fundo, slider.status,subgrupo.id_subgrupo, subgrupo.nome,subgrupo.descricao FROM slider JOIN subgrupo ON slider.id_subgrupo = subgrupo.id_subgrupo WHERE slider.status = 1;";
        $consulta = $this->ExecuteQuery($sql, array());
        foreach ($consulta as $linha) {
            $slider[] = array(new Slider($linha['id_slider'],$linha['id_subgrupo'],$linha['imagem'],$linha['fundo'],$linha['status']), new Subgrupo ($linha['id_subgrupo'],$linha['nome'],$linha['descricao'],null,null,null,null));
        }

        //echo '<pre>';var_dump($slider);echo '</pre>';die;

        return $slider;
    }

    public function getSliderSubgrupoIds() {
        $slider = [];
        $sql = "SELECT slider.id_subgrupo FROM slider WHERE slider.status = 1;";
        $consulta = $this->ExecuteQuery($sql, array());
        foreach ($consulta as $linha) {
            $slider[] = $linha['id_subgrupo'];
        }

        //echo '<pre>';var_dump($slider);echo '</pre>';die;

        return $slider;
    }

    public function getSliderById($id) {
        $sql = "SELECT * FROM slider WHERE id_slider=:id;";
        $linha = $this->ExecuteQuery($sql, [':id' => $id])[0];
            return new Slider($linha['id_slider'],$linha['id_subgrupo'],$linha['imagem'],$linha['status']);
    }

    public function insertSlider($slider) {
        $sql = "INSERT INTO slider(id_subgrupo,imagem,fundo,status) VALUES(:id_subgrupo,:imagem,:fundo,status)";
        if ($this->ExecuteCommand($sql,[':id_subgrupo'=>$slider->getId_subgrupo(),':fundo'=>$slider->getFundo(),':imagem'=>$slider->getImagem(),':status'=>$slider->getStatus()])){
            return true;
        } else {
            return false;
        }
    }

     public  function removeSlider($id) {
        $sql = "DELETE FROM slider WHERE id_slider = :id";
        if ($this->ExecuteCommand($sql, [':id'=>$id])) {
            return true;
        } else {
            return false;
        }
    }

    public function updateSlider($slider) {
        $sql = "UPDATE slider SET nome = :nome, imagem = :imagem, fundo = :fundo  WHERE id_slider = :id";
        $param = [':id'=>$slider->getId_slider(),':id_subgrupo'=>$slider->getId_subgrupo(),':fundo'=>$slider->getFundo(),':imagem'=>$slider->getImagem()];
        if ($this->ExecuteCommand($sql,$param)) {
            return true;
        } else {
            return false;
        }
    }


}
