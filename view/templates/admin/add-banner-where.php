<div class="content-inner">
    <!-- Page Header-->
    <header class="page-header">
        <div class="container-fluid">
            <h2 class="no-margin-bottom">Escolha o subgrupo desejado</h2>
        </div>
    </header>
<section class="dashboard-counts no-padding-bottom">
<div class="container-fluid">
  <div class="col-lg-12">
<?php foreach ($data['categoria'] as $categoria):?>
    <?php $algum = false; ?>
    <div class="card-header d-flex align-items-center row" style="border-width: 3px; border-color: #04040457;">
        <div class="col-md-2">
            <h3 class="h4"><?php echo $categoria->getNome(); ?></h3>
        </div>
    <div class="container-fluid col-md-10 row">
    <?php foreach ($data['grupo'] as $grupo):
         if($grupo->getId_categoria() == $categoria->getId_categoria()):
     ?>

      <div class="col-lg-6">
          <div class="card">
              <div class="card-header d-flex align-items-center" >
              <h3 class="h4">
                <a class="btn btn-info" data-toggle="collapse" href="#collapseExample<?php echo $grupo->getId_grupo(); ?>" role="button" aria-expanded="false" aria-controls="collapseExample" style="text-decoration: none;">
                  <?php echo $grupo->getNome(); ?>
                </a>
              </h3>
            </div>
            <div class="collapse" id="collapseExample<?php echo $grupo->getId_grupo(); ?>">
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-striped table-hover">
                    <thead>
                      <tr>
                        <th>Nome do Subgrupo</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>

                        <?php foreach ($data['subgrupo'] as $subgrupo):
                          if ($subgrupo->getId_grupo() == $grupo->getId_grupo()):
                              echo '<tr>
                              <td>'.$subgrupo->getNome().'</td>
                              <td>
                              <a class="btn btn-primary" href="'.$this->base_url.'SliderAdmin/addBanner/'.$subgrupo->getId_subgrupo().'"><i class="fa fa-angle-double-right"></i></a>
                              </td>
                              </tr>';
                              $algum = true;
                          endif;
                       endforeach;
                       if(!$algum){
                         echo '<tr><td colspan="3"><center>Nenhum subgrupo existente nesse grupo.</center></td></tr>';
                         $algum = true;
                       }
                      ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
      </div>
    <?php $algum = false; endif; endforeach; ?>

  </div>
  </div>
<?php endforeach;?>