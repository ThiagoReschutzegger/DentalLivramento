<div class="content-inner">
    <!-- Page Header-->
    <header class="page-header">
        <div class="container-fluid">
            <h2 class="no-margin-bottom">Administrar Destaques</h2>
        </div>
    </header>
<section class="dashboard-counts no-padding-bottom">
<div class="container-fluid">
  <div class="col-lg-12">
      <div class="card">
        <div class="card-header d-flex align-items-center">
          <h3 class="h4">Destaque o grupo para o 2º Slider</h3>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>Id</th>
                  <th>Imagem</th>
                  <th>Grupo Destacado</th>
                  <th>Ações</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($data['destaque'] as $destaque): ?>
                <tr>
                  <th scope="row"><?php echo $destaque->getId_destaque(); ?></th>
                  <td><a href="<?php echo $destaque->getImagem(); ?>" target="_blank"><img src="<?php echo $destaque->getImagem(); ?>" height="100px"/></a></td>
                  <td><?php
                        foreach ($data['grupo'] as $grupo):
                            if($destaque->getId_grupo() == $grupo->getId_grupo()){
                                echo $grupo->getNome();
                            }
                        endforeach;
                      ?></td>
                  <td>
                    <a class="btn btn-info" style="font-size: 15px;" href="<?php echo $this->base_url; ?>DestaqueAdmin/updateDestaque/<?php echo $destaque->getId_destaque(); ?>">
                      <i class="fa fa-pencil"></i>
                    </a>
                    <a class="btn btn-danger" style="font-size: 15px;" href="<?php echo $this->base_url; ?>DestaqueAdmin/deleteDestaque/<?php echo $destaque->getId_destaque(); ?>">
                      <i class="fa fa-remove"></i>
                    </a>
                  </td>
                </tr>
              <?php endforeach; ?>
                <tr>
                    <td colspan="8"><center><a href="<?php echo $this->base_url; ?>DestaqueAdmin/addDestaque" class="btn btn-success btn-lg btn-block"><i class="fa fa-plus"></i></a></center></td>
                </tr>

              </tbody>
            </table>
          </div>
        </div>
      </div>
