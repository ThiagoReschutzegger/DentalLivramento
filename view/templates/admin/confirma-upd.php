<?php  $estilo = $data; ?>
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
                    <div class="col-lg-12">
                      <div class="articles card">
                        <div class="card-close">
                          <div class="dropdown">
                            <button type="button" id="closeCard4" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-ellipsis-v"></i></button>
                            <div aria-labelledby="closeCard4" class="dropdown-menu dropdown-menu-right has-shadow"><a href="#" class="dropdown-item remove"> <i class="fa fa-times"></i>Close</a></div>
                          </div>
                        </div>
                        <div class="card-header d-flex align-items-center">
                          <h2 class="h3">Confirmar <span style="color:<?php echo $estilo->getHexadecimal(); ?>"><?php echo $estilo->getNome(); ?></span> como Cor?</h2>
                        </div>
                        <form role="form" method="post" enctype="multipart/form-data">
                          <input type="hidden" name="id" value="<?php echo $estilo->getId_estilo(); ?>"/>
                            <input type="hidden" name="hexadecimal" value="<?php echo $estilo->getHexadecimal(); ?>"/>
                            <input type="hidden" name="local" value="<?php echo $estilo->getLocal(); ?>"/>
                            <input type="hidden" name="nome" value="<?php echo $estilo->getNome(); ?>"/>
                            <input type="hidden" name="status" value="<?php echo $estilo->getStatus(); ?>"/>
                          <div class="item d-flex align-items-center">

                            <input type="submit" name="confirma" value="Confirmar alterações" class="btn btn-primary col-lg-12 col-md-12 col-sm-12">

                          </div>
                        </form>
                        </div>
                      </div>
                    </div>
                  </div>
              </div>
</section>
