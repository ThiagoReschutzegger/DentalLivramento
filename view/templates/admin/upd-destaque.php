<?php
  $destaque = $data['destaque'];
?>
<div class="container-fluid" style="margin-top: 50px">
<div class="col-lg-12">
  <?php if ($data['msg']): ?>
    <div class="row container-fluid">
        <div class="col-sm-12 alert alert-<?php if($data['msg']== 'Adicionado com Sucesso!'){ echo "success";} else{ echo "danger";}?> alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <?php echo $data['msg'] ?>
        </div>
    </div>
  <?php endif ?>
  <div class="card">
    <div class="card-header d-flex align-items-center">
      <h3 class="h4">Atualizar Destaque</h3>
    </div>
    <div class="card-body">
      <form class="form-horizontal" method="post">
        <input type="hidden" name="id" value="<?php echo $destaque->getId_destaque(); ?>">
        <div class="form-group row">
          <label class="col-sm-3 form-control-label text-right">Nome:</label>
          <div class="col-sm-8">
            <input type="text" class="form-control" name="nome" value="<?php echo $destaque->getNome(); ?>">
          </div>
        </div>
        <div class="line"></div>
        <label class="col-sm-3 form-control-label text-right">Selecionar Categoria:</label>
        <?php foreach( $data['categoria'] as $categoria ): ?>
        <div class="form-group row">
          <label class="col-sm-3"></label>
          <div class="col-sm-8">
            <input id="id_categoria<?php echo $categoria->getId_categoria(); ?>" type="radio" class="radio-template" name="id_categoria" value="<?php echo $categoria->getId_categoria(); ?>" <?php if($destaque->getId_categoria() == $categoria->getId_categoria()){echo 'checked';} ?> >
            <label from="id_categoria<?php echo $categoria->getId_categoria(); ?>" class="form-control-label text-right"><?php echo $categoria->getNome(); ?></label>
          </div>
        </div>
      <?php endforeach; ?>
      <div class="col-sm-6 text-right">
        <a class="btn btn-success" href="<?php echo $this->base_url; ?>CategoriaAdmin/addCategoria">Adicionar Categoria</a>
      </div>
      <br>
        <div class="form-group row">
          <div class="col-sm-4 offset-sm-3">
            <input type="reset" class="btn btn-secondary" value="Limpar" />
            <input type="submit" class="btn btn-primary" value="Salvar" name="upd" />
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
</div>
