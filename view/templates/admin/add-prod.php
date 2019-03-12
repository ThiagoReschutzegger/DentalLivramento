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
      <h3 class="h4">Adicionar Produto</h3>
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
        <div class="form-group row">
          <label class="col-sm-3 form-control-label text-right">Descrição:</label>
          <div class="col-sm-8">
            <textarea class="form-control" name="descricao"></textarea>
          </div>
        </div>
        <div class="line"></div>
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
          <label class="col-sm-3 form-control-label text-right">Link da Imagem:</label>
          <div class="col-sm-8">
            <input type="text" class="form-control" name="imagem"><small class="help-block-none">Cole aqui o link da imagem. <b style="color:red;">SEMPRE terminado em <i>.jpg</i>, <i>.png</i> ou outras extensões imagem.</b></small>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-sm-3 form-control-label text-right">Selecione a Marca:</label>
          <div class="col-sm-8">
            <div class="input-group">
                <div class="input-group-prepend">
                  <button data-toggle="dropdown" type="button" class="btn btn-outline-secondary dropdown-toggle" aria-expanded="false">Selecionar<span class="caret"></span></button>
                  <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                    <a disabled="true" class="dropdown-item">Selecionar</a>
                    <div class="dropdown-divider"></div>
                    <a href="<?php echo $this->base_url; ?>MarcaAdmin/addMarca"  target="_blank" class="dropdown-item">Adicionar</a>
                  </div>
                </div>
            <select class="form-control" name="id_marca">
              <option selected="selected" disabled="true">Selecione:</option>
              <?php foreach( $data['marca'] as $marca ): ?>
                  <option value="<?php echo $marca->getId_marca(); ?>" ><?php echo $marca->getNome(); ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          </div>
        </div>
        <div class="form-group row">
          <input type="reset" class="btn btn-secondary col-sm-4 offset-sm-2" style="margin-right: 10px;" value="Limpar" />
          <input type="submit" class="btn btn-success col-sm-4 " value="Salvar" name="add" />
          <a href="<?php echo $this->base_url; ?>ProdutoAdmin" class="btn btn-danger col-sm-8 offset-sm-2" style="margin-top: 10px;">Parar de Adicionar<a/>
        </div>
      </form>
    </div>
  </div>
</div>
</div>
