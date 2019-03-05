<div class="container-fluid" style="margin-top: 50px">
<div class="col-lg-12">
  <div class="card">
    <div class="card-header d-flex align-items-center">
      <h3 class="h4">Selecione a marca desejada:</h3>
    </div>
    <div class="card-body">
      <form class="form-horizontal" method="post">
        <label class="col-sm-3 form-control-label text-right">Selecione:</label>
        <?php foreach( $data['marca'] as $marca ): ?>
        <div class="form-group row">
          <label class="col-sm-3"></label>
          <div class="col-sm-8">
            <input id="id_marca<?php echo $marca->getId_marca(); ?>" type="radio" class="radio-template" name="id_marca" value="<?php echo $marca->getId_marca(); ?>">
            <label from="id_marca<?php echo $marca->getId_marca(); ?>" class="form-control-label text-right"><?php echo $marca->getNome(); ?></label>
          </div>
        </div>
      <?php endforeach; ?>
        <div class="form-group row">
          <div class="col-sm-4 offset-sm-3">
            <a class="btn btn-primary" href="<?php echo $this->base_url; ?>MarcaAdmin/addMarca">Adicionar Marca</a>
            <br>
            <br>
            <input type="reset" class="btn btn-secondary" value="Limpar" />
            <input type="submit" class="btn btn-success" value="Próximo" name="next" />
          </div>
        </div>
        <?php if ($data['msg']): ?>
          <div class="row col-sm-12">
              <div class="alert alert-danger alert-dismissable">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <?php echo $data['msg'] ?>
              </div>
          </div>
        <?php endif ?>
      </form>
    </div>
  </div>
</div>
</div>
