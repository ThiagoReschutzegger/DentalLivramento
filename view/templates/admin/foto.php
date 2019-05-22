<div class="content-inner">
    <!-- Page Header-->
    <header class="page-header">
        <div class="container-fluid">
            <h2 class="no-margin-bottom">Fotos</h2>
        </div>
    </header>
    <!-- Dashboard Counts Section-->
    <section class="dashboard-counts no-padding-bottom">
        <div class="container-fluid">
            <div class="row bg-white has-shadow">
              <div class="grid">
            		<div class="row">

                  <div class="col-4">
                    <div class="item d-flex align-items-center" style="border: 0;">
                      <a href="<?php echo $this->base_url; ?>FotoAdmin/addFoto">
                        <center>
                        <div class="icon bg-green" style="margin-top: 15px;"><i class="fa fa-plus"></i></div>
                            <div class="title" style="margin-top: 10px;"><span>Adicionar<br>foto</span>
                                <div class="progress">
                                    <div role="progressbar" style="width: 100%; height: 4px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" class="progress-bar bg-green"></div>
                                </div>
                            </div>
                          </center>
                        </a>
                    </div>
                  </div>
                  <?php foreach ($data['fotos'] as $foto): ?>
                    <div class="col-4">
                      <img src="<?php echo $this->base_url; ?>view/images/<?php echo $foto->getSrc(); ?>" style="background-size: cover !important;
                      background-position: 50% 50% !important;
                      transition: all 0.3s linear;
                      position: relative;">
                    </div>
                  <?php endforeach; ?>
                </div>
              </div>
            </div>
        </div>

    </section>
</div>
