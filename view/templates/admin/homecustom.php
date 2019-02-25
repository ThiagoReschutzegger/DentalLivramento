<div class="content-inner">
    <!-- Page Header-->
<header class="page-header">
    <div class="container-fluid">
        <h2 class="no-margin-bottom">Customização da Página Inicial</h2>
    </div>
</header>
<br>
<section class="feeds no-padding-top">
  <div class="container-fluid">
                  <div class="row">
                    <!-- Trending Articles-->
                    <div class="col-lg-5">
                      <div class="articles card">
                        <div class="card-close">
                          <div class="dropdown">
                            <button type="button" id="closeCard4" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-ellipsis-v"></i></button>
                            <div aria-labelledby="closeCard4" class="dropdown-menu dropdown-menu-right has-shadow"><a href="#" class="dropdown-item remove"> <i class="fa fa-times"></i>Close</a></div>
                          </div>
                        </div>
                        <div class="card-header d-flex align-items-center">
                          <h2 class="h3">Estilização da cores do site</h2>
                        </div>
                          <?php foreach ($data as $estilo): ?>
                            <a id="Custom<?php echo $estilo->getId_estilo(); ?>" href="<?php echo $this->base_url ?>HomeAdmin/confirma_upd/<?php echo $estilo->getId_estilo(); ?>">
                                <div class="statistic d-flex align-items-center <?php if($estilo->getStatus()!=1) echo 'bg-white' ?> has-shadow" <?php if($estilo->getStatus()==1) echo 'style="background-color:lightblue;"' ?>>
                              <div class="icon bg-red">
                                <label for="Custom<?php echo $estilo->getId_estilo(); ?>"><div class="btn btn-primary container-fluid cor-apresentacao" style="width:50px; height:50px; background-color: <?php echo $estilo->getHexadecimal(); ?>; border-color:<?php echo $estilo->getHexadecimal(); ?> !important;"></div></label>
                              </div>
                              <div class="text float-right col-lg-6"><br><strong><?php echo $estilo->getNome(); ?></strong><br><small><?php echo $estilo->getHexadecimal(); ?></small></div>
                            </div>
                          </a>
                          <?php endforeach;?>
                        </div>
                      </div>
                    </div>
                  </div>
              </div>
</section>
