<?php $grupo = $data; ?>
<div class="container-fluid" style="margin-top: 50px">
<div class="col-lg-12">
  <div class="card">
    <div class="card-header d-flex align-items-center ">
      <h3 class="h4">Deletar Grupo</h3>
    </div>
    <div class="card-body alert-danger">
        <div class="form-group row">
          <label class="col-sm-2 form-control-label text-right">Nome</label>
          <div class="col-sm-8">
            <p><?php echo $grupo->getNome(); ?></p>
          </div>
        </div>
        <div class="line"></div>
        <div class="form-group row">
          <div class="col-sm-4 offset-sm-3">
            <form method="post">
            <a class="btn btn-primary" href="<?php echo $this->base_url; ?>GrupoAdmin">Voltar</a>
            <input type="submit" name="del" value="Deletar" class="btn btn-secondary">
            </form>
          </div>
        </div>
    </div>
  </div>
</div>
</div>
