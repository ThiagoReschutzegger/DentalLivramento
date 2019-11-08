<div class="content-inner">
    <!-- Page Header-->
    <header class="page-header">
        <div class="container-fluid">
            <h2 class="no-margin-bottom">Administrar Slides</h2>
        </div>
    </header>
<section class="dashboard-counts no-padding-bottom">
<div class="container-fluid">
  <div class="col-lg-12">
      <div class="card">
        <div class="card-header d-flex align-items-center">
          <h3 class="h4">1º Slider</h3>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>Id</th>
                  <th>Imagem</th>
                  <th>Status</th>
                  <th>Ações</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($data['slider_1'] as $slider): ?>
                <tr>
                  <th scope="row"><?php echo $slider->getId_slider(); ?></th>
                  <td><a href="<?php echo $slider->getImagem(); ?>" target="_blank"><img src="<?php echo $slider->getImagem(); ?>" height="100px"/></a></td>
                  <td><?php if($slider->getStatus() == 1) echo 'Exibindo'; else echo "Não Exibindo"; ?></td>
                  <td>
                    <a class="btn btn-danger" style="font-size: 15px;" href="<?php echo $this->base_url; ?>SliderAdmin/deleteSlider_1/<?php echo $slider->getId_slider(); ?>">
                      <i class="fa fa-remove"></i>
                    </a>
                  </td>
                </tr>
              <?php endforeach; ?>
                <tr>
                    <td colspan="8"><center><a href="<?php echo $this->base_url; ?>SliderAdmin/addSlider_1" class="btn btn-success btn-lg btn-block"><i class="fa fa-plus"></i></a></center></td>
                </tr>

              </tbody>
            </table>
          </div>
        </div>
      </div>
      
      <div class="card">
        <div class="card-header d-flex align-items-center">
          <h3 class="h4">2º Slider</h3>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>Id</th>
                  <th>Imagem</th>
                  <th>Status</th>
                  <th>Ações</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($data['slider_2'] as $slider): ?>
                <tr>
                  <th scope="row"><?php echo $slider->getId_slider(); ?></th>
                  <td><a href="<?php echo $slider->getImagem(); ?>" target="_blank"><img src="<?php echo $slider->getImagem(); ?>" height="100px"/></a></td>
                  <td><?php if($slider->getStatus() == 1) echo 'Exibindo'; else echo "Não Exibindo"; ?></td>
                  <td>
                    <a class="btn btn-danger" style="font-size: 15px;" href="<?php echo $this->base_url; ?>SliderAdmin/deleteSlider_2/<?php echo $slider->getId_slider(); ?>">
                      <i class="fa fa-remove"></i>
                    </a>
                  </td>
                </tr>
              <?php endforeach; ?>
                <tr>
                    <td colspan="8"><center><a href="<?php echo $this->base_url; ?>SliderAdmin/addSlider_2" class="btn btn-success btn-lg btn-block"><i class="fa fa-plus"></i></a></center></td>
                </tr>

              </tbody>
            </table>
          </div>
        </div>
      </div>
      
      <div class="card">
        <div class="card-header d-flex align-items-center">
          <h3 class="h4">Banners</h3>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>Id</th>
                  <th>Imagem</th>
                  <th>Subgrupo</th>
                  <th>Ações</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($data['selecionado'] as $selec): ?>
                <tr>
                  <th scope="row"><?php echo $selec->getId_selecionado(); ?></th>
                  <td><a href="<?php echo $selec->getImagem(); ?>" target="_blank"><img src="<?php echo $selec->getImagem(); ?>" height="100px"/></a></td>
                  <td><?php echo $data['nome-sub'.$selec->getId_selecionado()]; ?></td>
                  <td>
                    <a class="btn btn-danger" style="font-size: 15px;" href="<?php echo $this->base_url; ?>SliderAdmin/deleteBanner/<?php echo $selec->getId_selecionado(); ?>">
                      <i class="fa fa-remove"></i>
                    </a>
                  </td>
                </tr>
              <?php endforeach; ?>
                <tr>
                    <td colspan="8"><center><a href="<?php echo $this->base_url; ?>SliderAdmin/addBannerWhere" class="btn btn-success btn-lg btn-block"><i class="fa fa-plus"></i></a></center></td>
                </tr>

              </tbody>
            </table>
          </div>
        </div>
      </div>
