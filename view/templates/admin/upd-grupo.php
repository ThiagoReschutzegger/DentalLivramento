<?php
  $grupo = $data['grupo'];
?>
<div class="container-fluid" style="margin-top: 50px">
<div class="col-lg-12">
  <div class="card">
    <div class="card-header d-flex align-items-center">
      <h3 class="h4">Atualizar Grupo</h3>
    </div>
    <div class="card-body">
      <form class="form-horizontal" method="post">
        <input type="hidden" name="id" value="<?php echo $grupo->getId_grupo(); ?>">
        <div class="form-group row">
          <label class="col-sm-3 form-control-label text-right">Nome:</label>
          <div class="col-sm-8">
            <input type="text" class="form-control" name="nome" value="<?php echo $grupo->getNome(); ?>">
          </div>
        </div>
        <div class="line"></div>
        <label class="col-sm-3 form-control-label text-right">Selecionar Categoria:</label>
        <?php foreach( $data['categoria'] as $categoria ): ?>
        <div class="form-group row">
          <label class="col-sm-3"></label>
          <div class="col-sm-8">
            <input id="id_categoria<?php echo $categoria->getId_categoria(); ?>" type="radio" class="radio-template" name="id_categoria" value="<?php echo $categoria->getId_categoria(); ?>" <?php if($grupo->getId_categoria() == $categoria->getId_categoria()){echo 'checked';} ?> >
            <label from="id_categoria<?php echo $categoria->getId_categoria(); ?>" class="form-control-label text-right"><?php echo $categoria->getNome(); ?></label>
          </div>
        </div>
      <?php endforeach; ?>
      <div class="col-sm-6 text-right">
        <a class="btn btn-primary" href="<?php echo $this->base_url; ?>CategoriaAdmin/addCategoria">Adicionar Categoria</a>
      </div>
      <br>
        <div class="form-group row">
          <div class="col-sm-4 offset-sm-3">
            <input type="reset" class="btn btn-secondary" value="Limpar" />
            <input type="submit" class="btn btn-success" value="Salvar" name="upd" />
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
