<div class="container-fluid" style="margin-top: 50px;">
  <div class="col-lg-12">
      <div class="card">
        <div class="card-header d-flex align-items-center">
          <h3 class="h4">Destaque Admin</h3>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>Id</th>
                  <th>Nome</th>
                  <th>Categoria Destacada</th>
                  <th>Ações</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($data['destaque'] as $destaque): ?>
                <tr>
                  <th scope="row"><?php echo $destaque->getId_destaque(); ?></th>
                  <td><?php echo $destaque->getNome(); ?></td>
                  <td><?php
                        foreach ($data['categoria'] as $categoria):
                            if($destaque->getId_categoria() == $categoria->getId_categoria()){
                                echo $categoria->getNome();
                            }
                        endforeach;
                      ?></td>
                  <td>
                    <a href="<?php echo $this->base_url; ?>DestaqueAdmin/updateDestaque/<?php echo $destaque->getId_destaque(); ?>">
                      <i class="fa fa-pencil"></i>
                    </a>
                    <a href="<?php echo $this->base_url; ?>DestaqueAdmin/deleteDestaque/<?php echo $destaque->getId_destaque(); ?>">
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
    </div>
</div>
