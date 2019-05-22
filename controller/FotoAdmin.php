<?php

class FotoAdmin extends Admin  {

    protected $model;

    function __construct() {
        parent::__construct();
        $this->model = new FotoModel();
    }

    public function index() {
        $data['fotos'] = $this->model->getFoto();
        $this->view->load('header');
        $this->view->load('nav');
        $this->view->load('foto', $data);
        $this->view->load('footer');
    }

    public function addFoto() {
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

                   if ($this->model->insertFoto(new Foto($new_name))){
                      header('location:' . $this->config->base_url.'AdminFotos');
                     return true;
                } else {
                    $data['msg']='Erro ao cadastrar foto!';
                    }
                } else {
                    $data['msg']= "Erro ao mover arquivo";
                }
            } else {
                $data['msg']= "Tipo de arquivo não suportado.";
            }

        }
        $this->view->load('header');
        $this->view->load('nav');
        $this->view->load('add-foto', $data);
        $this->view->load('footer');
    }

     public function removeFoto($id_foto) {
        if (filter_input(INPUT_POST, 'del')) {
            $this->model->removeFoto($id_foto);
            $this->index();
        } else {
            $this->index();
        }
    }

}
