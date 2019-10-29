<?php

class SliderAdmin extends Admin {

    protected $model_1;
    protected $model_2;

    public function __construct() {
        parent::__construct();
        $this->model_1 = new Slider_1Model();
        $this->model_2 = new Slider_2Model();
    }

    public function index() {
      $data['slider_1'] = $this->model_1->getSlider_1();
      $data['slider_2'] = $this->model_2->getSlider_2();
      $this->view->load('header');
      $this->view->load('nav');
      $this->view->load('slider', $data);
      $this->view->load('footer');
    }

    public function addSlider_1() {
        header('location:' . $this->config->base_url.'SliderAdmin/addSlider/1');
        return true;
    }
    
    public function addSlider_2() {
        header('location:' . $this->config->base_url.'SliderAdmin/addSlider/2');
        return true;
    }
    
    
    public function addSlider($qual) {
      $data['msg'] = '';
        
        if (filter_input(INPUT_POST, 'add')) {

            //VALIDANDO O TIPO DA IMAGEM
            $types = ['image/jpeg', 'image/png', 'image/gif', 'image/jpg'];
            $type_image = false;

            foreach ($types as $type){
                $type_image = ($type == $_FILES['foto']['type']) ? true : false;
                if($type_image){
                    break;
                }
            }

            if ($type_image) {
                $tempname = $_FILES['foto']['tmp_name'];
                $folder = "view/images/";
                $name = $_FILES['foto']['name'];
                //LÓGICA PARA NÃO SOBRESCREVER ARQUIVOS
                $count = 1;
                $new_name = $name;
                while (file_exists($folder . $new_name)) {
                    $new_name = str_replace(".", "_$count.", $name);
                    $count++;
                }
                $destino = $folder . $new_name;
                if (move_uploaded_file($tempname, $destino)) {

                        $imagem = 'http://dentallivramento.com.br/'.$destino;
                        $id_item = filter_input(INPUT_POST, 'id_item', FILTER_SANITIZE_STRING);

                        if ($imagem && $id_item) {
                            $slider = new Slider(null,$imagem, 1, $id_item);
                            if($qual == 1):
                                if ($this->model_1->insertSlider_1($slider)) {
                                      $data['msg'] = 'Adicionado com Sucesso!';
                                      $data['msg_alt'] = 's';
                                } else {
                                    $data['msg'] = 'Erro!';
                                    $data['msg_alt'] = 'n';
                                    }
                            else:
                                if ($this->model_2->insertSlider_2($slider)) {
                                      $data['msg'] = 'Adicionado com Sucesso!';
                                      $data['msg_alt'] = 's';
                                } else {
                                    $data['msg'] = 'Erro!';
                                    $data['msg_alt'] = 'n';
                                    }
                            endif;
                        } else {
                             $data['msg'] = 'Preencha todos os Campos!';
                             $data['msg_alt'] = 'n';
                        }
                } else {
                    $data['msg']= "Erro ao mover arquivo";
                    $data['msg_alt'] = 'n';
                }
            } else {
                $data['msg']= "Tipo de arquivo não suportado.";
                $data['msg_alt'] = 'n';
            }

        }
      $this->view->load('header');
      $this->view->load('nav');
      $this->view->load('add-destaque', $data);
      $this->view->load('footer');
    }

    public function deleteSlider_1($id) {
      if (filter_input(INPUT_POST, 'del')) {
        $this->model_1->removeSlider_1($id);
        $this->index();
        return true;
      }
      $data['slider'] = $this->model_1->getSliderById($id);
      $this->view->load('header');
      $this->view->load('nav');
      $this->view->load('del-destaque', $data['slider']);
      $this->view->load('footer');
    }
    
    public function deleteSlider_2($id) {
      if (filter_input(INPUT_POST, 'del')) {
        $this->model_2->removeSlider_2($id);
        $this->index();
        return true;
      }
      $data['slider'] = $this->model_2->getSliderById($id);
      $this->view->load('header');
      $this->view->load('nav');
      $this->view->load('del-destaque', $data['slider']);
      $this->view->load('footer');
    }
    
}
