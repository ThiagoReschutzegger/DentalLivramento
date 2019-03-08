<div class="container-fluid" style="margin-top: 50px;">
  <div class="col-lg-12">
      <div class="card">
        <div class="card-header d-flex align-items-center">
          <h3 class="h4">Selecione o produto a ser implementado:</h3>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>Id</th>
                  <th>Nome - Produto</th>
                  <th>Escolha</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($data['subgrupo'] as $subgrupo): ?>
                <tr>
                  <th scope="row"><?php echo $subgrupo->getId_subgrupo(); ?></th>
                  <td><?php echo $subgrupo->getNome(); ?></td>
                  <td>
                      <a class="btn btn-primary" href="<?php echo $this->base_url; ?>ProdutoAdmin/addCommon/<?php echo $subgrupo->getId_subgrupo(); ?>"><i class="fa fa-angle-double-right"></i></a>
                  </td>
                </tr>
              <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
</div>
