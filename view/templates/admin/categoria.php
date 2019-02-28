<div class="container-fluid" style="margin-top: 50px;">
  <div class="col-lg-12">
      <div class="card">
        <div class="card-header d-flex align-items-center">
          <h3 class="h4">Categoria Admin</h3>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>Id</th>
                  <th>Nome - Categoria</th>
                  <th>Descrição</th>
                  <th>Link - imagem</th>
                  <th>Ações</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($data as $categoria): ?>
                <tr>
                  <th scope="row"><?php echo $categoria->getId_categoria(); ?></th>
                  <td><?php echo $categoria->getNome(); ?></td>
                  <td>...</td>
                  <td><img src="<?php echo $categoria->getImagem(); ?>" height="80px" /></td>
                  <td>
                    <a href="<?php echo $this->base_url; ?>CategoriaAdmin/viewCategoria/<?php echo $categoria->getId_categoria(); ?>">
                      <i class="fa fa-eye"></i>
                    </a>
                    <a href="<?php echo $this->base_url; ?>CategoriaAdmin/updateCategoria/<?php echo $categoria->getId_categoria(); ?>">
                      <i class="fa fa-pencil"></i>
                    </a>
                    <a href="<?php echo $this->base_url; ?>CategoriaAdmin/deleteCategoria/<?php echo $categoria->getId_categoria(); ?>">
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
