<?php
$subgrupo = $data['subgrupo'];
 ?>
<div class="container-fluid" style="margin-top: 50px">
<div class="col-lg-12">
  <div class="card">
    <div class="card-header d-flex align-items-center ">
      <h3 class="h4">Deletar Produto e suas especificações</h3>
    </div>
    <div class="card-body alert-danger">
        <div class="form-group">
          <div class="row">
          <label class="col-sm-2 form-control-label text-right">Nome:</label><p><?php echo $subgrupo->getNome(); ?></p>
        </div>
          <div class="row">
          <label class="col-sm-2 form-control-label text-right">Descrição:</label>
          <div class="col-sm-10">
            <p><?php echo $subgrupo->getDescricao(); ?></p>
          </div>
        </div>
        <div class="row">
          <label class="col-sm-2 form-control-label text-right">Especificações:</label>
          <div class="col-sm-10">
          <?php foreach( $data['produto'] as $produto ): ?>
              <p><?php echo $produto->getEspecificacao(); ?></p>
          <?php endforeach; ?>
        </div>
        </div>
          <div class="col-sm-8">
            <div class="form-group row text-left">
                <div class="col-sm-4 offset-sm-3">
                  <form method="post">
                  <a class="btn btn-primary" href="<?php echo $this->base_url; ?>ProdutoAdmin/viewSubOf/<?php echo $subgrupo->getId_subgrupo(); ?>">Voltar</a>
                  <input type="submit" name="del" value="Deletar" class="btn btn-danger">
                  </form>
                </div>
              </div>
          </div>
        </div>

    </div>
  </div>
</div>
</div>
