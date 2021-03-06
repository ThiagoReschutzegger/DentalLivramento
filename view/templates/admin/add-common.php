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
      <h3 class="h4">Adicionar Produto</h3>
    </div>
    <div class="card-body">
      <form class="form-horizontal" method="post">
        <div class="form-group row">
          <label class="col-sm-3 form-control-label text-right">Especificação:</label>
          <div class="col-sm-8">
            <input type="text" class="form-control" name="especificacao">
          </div>
        </div>
        <div class="line"></div>
        <div class="form-group row">
          <label class="col-sm-3 form-control-label text-right">Código de Barras:</label>
          <div class="col-sm-8">
            <input type="number" class="form-control" name="barcode">
          </div>
        </div>
        <div class="line"></div>
        <div class="form-group row">
          <label class="col-sm-3 form-control-label text-right">Preço:</label>
          <div class="col-sm-8">
            <div class="input-group">
                <div class="input-group-prepend"><span class="input-group-text">R$</span></div>
                <input type="number" class="form-control" name="preco" min="0.00" step="0.01">
            </div>
          </div>
        </div>
        <div class="line"></div>
        <div class="form-group row">
          <label class="col-sm-3 form-control-label text-right">Estoque:</label>
          <div class="col-sm-8">
            <input type="text" class="form-control" name="estoque">
          </div>
        </div>
        <div class="line"></div>
        <div class="form-group row">
          <input type="reset" class="btn btn-secondary col-sm-4 offset-sm-2" style="margin-right: 10px;" value="Limpar" />
          <input type="submit" class="btn btn-success col-sm-4 " value="Salvar" name="add" />
          <a href="<?php echo $this->base_url; ?>ProdutoAdmin/viewSubOf/<?php echo $data['id']; ?>" class="btn btn-danger col-sm-8 offset-sm-2" style="margin-top: 10px;">Parar de Adicionar<a/>
        </div>
      </form>
    </div>
  </div>
</div>
</div>
