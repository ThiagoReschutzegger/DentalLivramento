<?php $destaque = $data; ?>
<div class="container-fluid" style="margin-top: 50px">
<div class="col-lg-12">
  <div class="card">
    <div class="card-header d-flex align-items-center ">
      <h3 class="h4">Deletar Destaque</h3>
    </div>
    <div class="card-body alert-danger">
        <div class="form-group row">
          <label class="col-sm-2 form-control-label text-right">Nome</label>
          <div class="col-sm-8">
            <p><?php echo $destaque->getNome(); ?></p>
            <div class="form-group row text-left">
                <div class="col-sm-4 offset-sm-3">
                  <form method="post">
                  <a class="btn btn-primary" href="<?php echo $this->base_url; ?>DestaqueAdmin">Voltar</a>
                  <input type="submit" name="del" value="Deletar" class="btn btn-danger">
                  </form>
                </div>
              </div>
          </div>
        </div>

    </div>
  </div>
</div>
</div>
