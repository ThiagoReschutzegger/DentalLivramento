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
      <h3 class="h4">Adicionar Destaque</h3>
    </div>
    <div class="card-body">
      <form class="form-horizontal" method="post">
        <div class="form-group row">
          <label class="col-sm-3 form-control-label text-right">Nome:</label>
          <div class="col-sm-8">
            <input type="text" class="form-control" name="nome">
          </div>
        </div>
        <div class="line"></div>

        <label class="col-sm-3 form-control-label text-right">Selecionar Categoria:</label>
        <div class="form-group row container-fluid">
        <?php foreach( $data['categoria'] as $categoria ): ?>
          <div class="col-sm-3">
            <input id="id_categoria<?php echo $categoria->getId_categoria(); ?>" type="radio" class="radio-template" name="id_categoria" value="<?php echo $categoria->getId_categoria(); ?>">
            <label from="id_categoria<?php echo $categoria->getId_categoria(); ?>" class="form-control-label text-right"><?php echo $categoria->getNome(); ?></label>
          </div>
      <?php endforeach; ?>
      </div>
        <div class="form-group row">
            <a class="btn btn-primary col-sm-6 offset-sm-3" style="margin-bottom: 10px;" href="<?php echo $this->base_url; ?>CategoriaAdmin/addCategoria">Adicionar Categoria</a>

            <input type="reset" class="btn btn-secondary col-sm-4 offset-sm-2" style="margin-right: 10px;" value="Limpar" />
            <input type="submit" class="btn btn-success col-sm-4 " value="Salvar" name="add" />
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
</div>
