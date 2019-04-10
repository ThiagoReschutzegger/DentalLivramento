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
        <div class="form-group row">
          <label class="col-sm-3 form-control-label text-right">Link:</label>
          <div class="col-sm-8">
            <input type="text" class="form-control" name="imagem" value="<?php echo $destaque->getImagem(); ?>"><small class="help-block-none">Cole aqui o link da imagem. (sempre terminado em .jpg .png ou outros tipos de imagem)</small>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-sm-3 form-control-label text-right">Selecione a Categoria:</label>
          <div class="col-sm-8">
            <div class="input-group">
                <div class="input-group-prepend">
                  <button data-toggle="dropdown" type="button" class="btn btn-outline-secondary dropdown-toggle" aria-expanded="false">Selecionar<span class="caret"></span></button>
                  <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                    <a disabled="true" class="dropdown-item">Selecionar</a>
                    <div class="dropdown-divider"></div>
                    <a href="<?php echo $this->base_url; ?>CategoriaAdmin/addCategoria" target="_blank" class="dropdown-item">Adicionar</a>
                  </div>
                </div>
            <select class="form-control" name="id_categoria">
              <option selected="selected" disabled="true">Selecione:</option>
              <?php foreach( $data['categoria'] as $categoria ): ?>
                  <option value="<?php echo $categoria->getId_categoria(); ?>" <?php if($destaque->getId_categoria() == $categoria->getId_categoria()){echo 'selected="selected"';} ?> ><?php echo $categoria->getNome(); ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          </div>
        </div>

        <div class="form-group row">
          <input type="reset" class="btn btn-secondary col-sm-4 offset-sm-2" style="margin-right: 10px;" value="Limpar" />
          <input type="submit" class="btn btn-success col-sm-4 " value="Salvar" name="upd" />
        </div>
      </form>
    </div>
  </div>
</div>
</div>
