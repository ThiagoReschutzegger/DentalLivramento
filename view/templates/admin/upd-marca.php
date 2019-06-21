<?php $marca = $data['marca']; ?>
<div class="container-fluid" style="margin-top: 50px">
  <?php if ($data['msg']): ?>
    <div class="row container-fluid">
        <div class="col-sm-12 alert alert-<?php if($data['msg']== 'Adicionado com Sucesso!'){ echo "success";} else{ echo "danger";}?> alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <?php echo $data['msg'] ?>
        </div>
    </div>
  <?php endif ?>
<div class="col-lg-12">
  <div class="card">
    <div class="card-header d-flex align-items-center">
      <h3 class="h4">Editar Marca</h3>
    </div>
    <div class="card-body">
      <form class="form-horizontal" method="post">
        <input type="hidden" name="id" value="<?php echo $marca->getId_marca(); ?>"/>
        <div class="form-group row">
          <label class="col-sm-2 form-control-label text-right">Nome:</label>
          <div class="col-sm-8">
            <input type="text" class="form-control" name="nome" value="<?php echo $marca->getNome(); ?>">
          </div>
        </div>
        <div class="line"></div>
        <div class="form-group row">
          <label class="col-sm-2 form-control-label text-right">Link:</label>
          <div class="col-sm-8">
            <input type="text" class="form-control" name="imagem" value="<?php echo $marca->getImagem(); ?>"><small class="help-block-none">Cole aqui o link da imagem. (sempre terminado em .jpg .png ou outros tipos de imagem)</small>
          </div>
        </div>
        <div class="line"></div>
        <div class="form-group row">
          <label class="col-sm-2 form-control-label text-right">Catálogo:</label>
          <div class="col-sm-8">
            <input type="text" class="form-control" name="catalogo" value="<?php echo $marca->getCatalogo(); ?>"><small class="help-block-none">Cole aqui o link do catálogo.</small>
          </div>
        </div>
        <div class="line"></div>
        <div class="form-group row">
          <label class="col-sm-2 form-control-label text-right">Deseja exibir no Slider de Marcas:</label>
          <div class="col-sm-8">
            <div class="i-checks">
              <input id="sim" type="radio" <?php  if($marca->getSlider() != 0) echo "checked"; ?> value="1" name="slider" class="radio-template">
              <label for="sim">Sim</label>
            </div>
            <div class="i-checks">
              <input id="nao" type="radio" <?php  if($marca->getSlider() == 0) echo "checked"; ?> value="0" name="slider" class="radio-template">
              <label for="nao">Não</label>
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
