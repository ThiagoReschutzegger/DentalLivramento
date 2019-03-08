<div class="content-inner">
    <!-- Page Header-->
    <header class="page-header">
        <div class="container-fluid">
            <h2 class="no-margin-bottom">Categoria Admin</h2>
        </div>
    </header>
<section class="dashboard-counts no-padding-bottom">
<div class="container-fluid">
  <div class="col-lg-12">
      <div class="card">
        <div class="card-header d-flex align-items-center">
          <h3 class="h4">Categorias</h3>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>Nome da Categoria</th>
                  <th>Descrição</th>
                  <th>Link da imagem</th>
                  <th>Ações</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($data as $categoria): ?>
                <tr>
                  <td><?php echo $categoria->getNome(); ?></td>
                  <td><?php echo substr($categoria->getDescricao(), 0, 45) . "..."; ?></td>
                  <td><a target="_blank" href='<?php echo $categoria->getImagem(); ?>'><img src="<?php echo $categoria->getImagem(); ?>" height="65px" /></a></td>
                  <td>
                    <a class="btn btn-secondary" style="font-size: 15px;" href="<?php echo $this->base_url; ?>CategoriaAdmin/viewCategoria/<?php echo $categoria->getId_categoria(); ?>">
                      <i class="fa fa-eye"></i>
                    </a>
                    <a class="btn btn-info" style="font-size: 15px;" href="<?php echo $this->base_url; ?>CategoriaAdmin/updateCategoria/<?php echo $categoria->getId_categoria(); ?>">
                      <i class="fa fa-pencil"></i>
                    </a>
                    <a class="btn btn-danger" style="font-size: 15px;" href="<?php echo $this->base_url; ?>CategoriaAdmin/deleteCategoria/<?php echo $categoria->getId_categoria(); ?>">
                      <i class="fa fa-remove"></i>
                    </a>
                  </td>
                </tr>
              <?php endforeach; ?>
                <tr>
                    <td colspan="8"><center><a href="<?php echo $this->base_url; ?>CategoriaAdmin/addCategoria" class="btn btn-success btn-lg btn-block"><i class="fa fa-plus"></i></a></center></td>
                </tr>

              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
</div>
