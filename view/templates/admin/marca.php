  <div class="container-fluid" style="margin-top: 50px;">
    <div class="col-lg-12">
        <div class="card">
          <div class="card-header d-flex align-items-center">
            <h3 class="h4">Marca Admin</h3>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>Id</th>
                    <th>Nome - Marca</th>
                    <th>Link - imagem</th>
                    <th>Ações</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($data as $marca): ?>
                  <tr>
                    <th scope="row"><?php echo $marca->getId_marca(); ?></th>
                    <td><?php echo $marca->getNome(); ?></td>
                    <td>...</td>
                    <td>
                      <a href="<?php echo $this->base_url; ?>MarcaAdmin/viewMarca">
                        <i class="fa fa-eye"></i>
                      </a>
                      <a href="<?php echo $this->base_url; ?>MarcaAdmin/updateMarca/<?php echo $marca->getId_marca(); ?>">
                        <i class="fa fa-pencil"></i>
                      </a>
                      <a href="<?php echo $this->base_url; ?>MarcaAdmin/deleteMarca">
                        <i class="fa fa-remove"></i>
                      </a>
                    </td>
                  </tr>
                <?php endforeach; ?>
                  <tr>
                      <td colspan="8"><center><a href="<?php echo $this->base_url; ?>MarcaAdmin/addMarca" class="btn btn-success btn-lg btn-block"><i class="fa fa-plus"></i></a></center></td>
                  </tr>

                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
  </div>
