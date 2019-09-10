<?php $item = $data['item']; ?>
<div class="container-fluid" style="margin-top: 50px">
<div class="col-lg-12">
  <?php if ($data['msg']): ?>
    <div class="row container-fluid">
        <div class="col-lg-12 alert alert-<?php if($data['msg']== 'Adicionado com Sucesso!'){ echo "success";} else{ echo "danger";}?> alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <?php echo $data['msg'] ?>
        </div>
    </div>
  <?php endif ?>
  <div class="card">
    <div class="card-header d-flex align-items-center">
      <h3 class="h4">Editar Produto:</h3>
    </div>
    <div class="card-body">
      <form class="form-horizontal" method="post">
        
        <div class="form-group row">
          <label class="col-sm-3 form-control-label text-right">Link da Imagem:</label>
          <div class="col-sm-8">
            <input type="text" class="form-control" name="imagem" value="<?php echo $item->getImagem(); ?>"><small class="help-block-none">Cole aqui o link da imagem. <b style="color:red;">SEMPRE terminado em <i>.jpg</i>, <i>.png</i> ou outras extensões imagem.</b></small>
          </div>
        </div>
        <div class="line"></div>
        <div class="form-group row">
          <label class="col-sm-3 form-control-label text-right">Descrição:</label>
          <div class="col-sm-8">
            <textarea class="form-control" name="descricao"><?php echo $item->getDescricao(); ?></textarea>
          </div>
        </div>
        <div class="line"></div>
        <div class="form-group row">
          <label class="col-sm-2 form-control-label text-right">Deseja exibir no Slider Principal?</label>
          <div class="col-sm-8">
            <div class="i-checks">
              <input id="sim" type="radio" <?php  if($item->getDestaque() != 0) echo "checked"; ?> value="1" name="destaque" class="radio-template">
              <label for="sim">Sim</label>
            </div>
            <div class="i-checks">
              <input id="nao" type="radio" <?php  if($item->getDestaque() == 0) echo "checked"; ?> value="0" name="destaque" class="radio-template">
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
