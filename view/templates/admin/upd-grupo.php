<?php $grupo = $data['grupo']; ?>
<div class="container-fluid" style="margin-top: 50px">
<div class="col-lg-12">
  <div class="card">
    <div class="card-header d-flex align-items-center">
      <h3 class="h4">Editar Grupo</h3>
    </div>
    <div class="card-body">
      <form class="form-horizontal" method="post">
        <input type="hidden" name="id" value="<?php echo $grupo->getId_grupo(); ?>"/>
        <div class="form-group row">
          <label class="col-sm-2 form-control-label text-right">Nome</label>
          <div class="col-sm-8">
            <input type="text" class="form-control" name="nome" value="<?php echo $grupo->getNome(); ?>">
          </div>
        </div>
        <div class="line"></div>
        <div class="form-group row">
          <div class="col-sm-4 offset-sm-3">
            <input type="reset" class="btn btn-secondary" value="Limpar" />
            <input type="submit" class="btn btn-primary" value="Salvar" name="upd" />
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
