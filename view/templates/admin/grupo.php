<?php $algum = false; ?>
<div class="content-inner">
    <!-- Page Header-->
    <header class="page-header">
        <div class="container-fluid">
            <h2 class="no-margin-bottom">Grupo Admin</h2>
        </div>
    </header>
<section class="dashboard-counts no-padding-bottom">
<div class="container-fluid" >
  <div class="card">
  <div class="card-header d-flex align-items-center">
    <h3 class="h4">Selecine o Grupo desejado</h3>
  </div>
  <div class="container-fluid row" style="margin-top: 10px;">
    <?php foreach($data['categoria'] as $categoria): ?>
      <div class="col-md-6">
          <div class="card">
            <div class="card-header d-flex align-items-center">
              <h3 class="h4">
                <a class="btn btn-info" data-toggle="collapse" href="#collapseExample<?php echo $categoria->getId_categoria(); ?>" role="button" aria-expanded="false" aria-controls="collapseExample" style="text-decoration: none;">
                  <?php echo $categoria->getNome(); ?>
                </a>
              </h3>
            </div>
            <div class="collapse" id="collapseExample<?php echo $categoria->getId_categoria(); ?>">
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
                          if ($grupo->getId_categoria() == $categoria->getId_categoria()):?>
                              <tr>
                                <td><?php echo $grupo->getNome();?></td>
                                <td>
                                  <a class="btn btn-info" style="font-size: 15px;" href="<?php echo $this->base_url; ?>GrupoAdmin/updateGrupo/<?php echo $grupo->getId_grupo(); ?>">
                                    <i class="fa fa-pencil"></i>
                                  </a>
                                  <a class="btn btn-danger" style="font-size: 15px;" href="<?php echo $this->base_url; ?>GrupoAdmin/deleteGrupo/<?php echo $grupo->getId_grupo(); ?>">
                                    <i class="fa fa-remove"></i>
                                  </a>
                                </td>
                              </tr>
                              <?php $algum = true;
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
                    <a class="btn btn-info btn-block" href="<?php echo $this->base_url; ?>GrupoAdmin/addGrupo">Adicionar Grupo</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
      </div>
    <?php $algum = false; endforeach; ?>
  </div>

  </div>
</div>
</section>
</div>
