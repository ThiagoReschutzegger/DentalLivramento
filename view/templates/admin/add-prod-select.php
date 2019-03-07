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
                    <th>Nome do Grupo</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>

                    <?php foreach ($data['grupo'] as $grupo):
                      if ($grupo->getId_categoria() == $categoria->getId_categoria()):
                          echo '<tr>
                          <td>'.$grupo->getNome().'</td>
                          <td>
                          <a class="btn btn-primary" style="font-size: 10px;" href="'.$this->base_url.'ProdutoAdmin/addProdutoCompleto/'.$grupo->getId_grupo().'"><i class="fa fa-map-pin"></i></a>
                          </td>
                          </tr>';
                          $algum = true;
                      endif;
                   endforeach;
                   if(!$algum){
                     echo '<tr><td colspan="3"><center>Nenhum grupo existente nessa categoria.</center></td></tr>';
                     $algum = true;
                   }
                  ?>
                </tbody>
              </table>
              <div class="col-sm-12 mx-auto" style='margin:10px'>
                <a class="btn btn-info btn-block" href="<?php echo $this->base_url; ?>CategoriaAdmin/addCategoria">Adicionar Grupo</a>
              </div>
            </div>
          </div>
        </div>
    </div>
  <?php $algum = false; endforeach; ?>

</div>
<div class="col-sm-12 mx-auto" style='margin:10px'>
  <a class="btn btn-success btn-block" href="<?php echo $this->base_url; ?>CategoriaAdmin/addCategoria">Adicionar Categoria</a>
</div>
</div>
</div>
