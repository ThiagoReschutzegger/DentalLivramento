<?php $categoria = $data['categoria']; ?>
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
      <h3 class="h4">Adicionar Categoria</h3>
    </div>
    <div class="card-body">
      <form class="form-horizontal" method="post">
        <input type="hidden" name="id" value="<?php echo $categoria->getId_categoria(); ?>">
        <input type="hidden" class="form-control" name="nome" value="<?php echo $categoria->getNome(); ?>">
        
        <div class="form-group row">
          <label class="col-sm-3 form-control-label text-right">Link:</label>
          <div class="col-sm-8">
            <input type="text" class="form-control" name="imagem" value="<?php echo $categoria->getImagem(); ?>"><small class="help-block-none">Cole aqui o link da imagem. (sempre terminado em .jpg .png ou outros tipos de imagem)</small>
          </div>
        </div>
        <div class="form-group row">
        <?php if($data['key']): ?>
        <label class="col-sm-3 form-control-label text-right">Destaque no menu?</label>
          <div class="col-sm-8">
            <div class="i-checks">
              <input id="sim" type="radio" <?php  if($categoria->getDestaque() == 1) echo "checked"; ?> value="1" name="destaque" class="radio-template">
              <label for="sim">Sim</label>
            </div>
            <div class="i-checks">
              <input id="nao" type="radio" <?php  if($categoria->getDestaque() != 1) echo "checked"; ?> value="0" name="destaque" class="radio-template">
              <label for="nao">Não</label>
            </div>
          </div>
        <?php else: ?>
        <label class="col-sm-3 form-control-label text-right">Destaque no menu?</label>
        <small class="help-block-none" style="">Somente 3 categorias podem ser destacadas.<br>Desabilite alguma antes de destacar outra.</small>
            <input type="hidden" value="0" name="destaque">
        <?php endif; ?>
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
