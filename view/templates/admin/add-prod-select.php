<?php $algum = false; ?>
<div class="container-fluid" style="margin-top: 50px;">
<div class="card">
<div class="card-header d-flex align-items-center">
  <h3 class="h4">Selecine o Grupo desejado</h3>
</div>
<div class="container-fluid row" style="margin-top: 30px;">
  <?php foreach ($data['categoria'] as $categoria):?>
    <div class="col-lg-6">
        <div class="card">
          <div class="card-header d-flex align-items-center">
            <h3 class="h4"><?php echo $categoria->getNome(); ?></h3>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-striped table-hover">
                <thead>
                  <tr>
                    <th>Id</th>
                    <th>Nome Grupo</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>

                    <?php foreach ($data['grupo'] as $grupo):
                      if ($grupo->getId_categoria() == $categoria->getId_categoria()){
                          echo '<tr>
                          <th scope="row">'.$grupo->getId_grupo().'</th>
                          <td>'.$grupo->getNome().'</td>
                          <td>
                          <a class="btn btn-success" style="font-size: 10px;" href="'.$this->base_url.'ProdutoAdmin/addProdutoCompleto/'.$grupo->getId_grupo().'"><i class="fa fa-check"></i></a>
                          </td>
                          </tr>';
                          $algum = true;
                      }
                   endforeach;
                   if(!$algum){
                     echo '<tr>
                     <td colspan="3">Nenhum grupo selecionado nessa categoria.</td>
                     </tr>';
                     $algum = true;
                   }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
    </div>
  <?php $algum = false; endforeach; ?>
  <div class="col-sm-6">
    <a class="btn btn-primary" href="<?php echo $this->base_url; ?>CategoriaAdmin/addCategoria">Adicionar Categoria</a>
  </div>
</div>
</div>
</div>
