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
                    <div class="col-lg-6">
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
                        <form role="form" method="post">
                          <?php foreach ($data as $estilo): ?>
                            <div class="item d-flex align-items-center">
                              <div class="image">
                                <div class="i-checks">
                                    <input id="radioCustom<?php echo $estilo->getId_estilo(); ?>" type="radio" value="<?php echo $estilo->getId_estilo(); ?>" name="a" class="radio-template" <?php if($estilo->getStatus()==1) echo "checked"?>>
                                </div>
                              </div>
                              <div class="text col-lg-4">
                                    <label for="radioCustom<?php echo $estilo->getId_estilo(); ?>"><h3 class="h5"><?php echo $estilo->getNome(); ?></h3><small><?php echo $estilo->getHexadecimal(); ?></small></label>
                              </div>
                              <center>
                              <div class="form-group text-center">
                                <label for="radioCustom<?php echo $estilo->getId_estilo(); ?>"><div class="btn btn-primary container-fluid cor-apresentacao" style="width:100px; height:50px; background-color: <?php echo $estilo->getHexadecimal(); ?>; border-color:<?php echo $estilo->getHexadecimal(); ?> !important"></div></label>
                              </div>
                            </center>
                            </div>
                          <?php endforeach;?>
                          <div class="item d-flex align-items-center">

                            <input type="submit" name="cor" value="Salvar alterações" class="btn btn-primary col-lg-12 col-md-12 col-sm-12">

                          </div>
                        </form>
                        </div>
                      </div>
                    </div>
                  </div>
              </div>
</section>
