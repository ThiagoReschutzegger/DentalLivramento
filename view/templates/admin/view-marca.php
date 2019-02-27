<?php $marca = $data; ?>
<div class="container-fluid" style="margin-top: 50px">
<div class="col-lg-12">
  <div class="card">
    <div class="card-header d-flex align-items-center">
      <h3 class="h4">Vizualizar Marca</h3>
    </div>
    <div class="card-body">
        <div class="form-group row">
          <label class="col-sm-2 form-control-label text-right">Nome:</label>
          <div class="col-sm-8">
            <p><?php echo $marca->getNome(); ?></p>
          </div>
        </div>
        <div class="line"></div>
        <div class="form-group row">
          <label class="col-sm-2 form-control-label text-right">Link:</label>
          <div class="col-sm-8">
            <img class="image-fluid" src="<?php echo $marca->getImagem(); ?>" width="500px" />
            <br>
            <small>"<?php echo $marca->getImagem(); ?>"</small>
          </div>
        </div>
        <div class="form-group row">
          <div class="col-sm-4 offset-sm-3">
            <a class="btn btn-secondary" href="<?php echo $this->base_url; ?>MarcaAdmin">Voltar</a>
          </div>
        </div>
    </div>
  </div>
</div>
</div>
