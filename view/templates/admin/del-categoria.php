<?php $categoria = $data; ?>
<div class="container-fluid" style="margin-top: 50px">
<div class="col-lg-12">
  <div class="card">
    <div class="card-header d-flex align-items-center ">
      <h3 class="h4">Deletar Categoria</h3>
    </div>
    <div class="card-body alert-danger">
        <div class="form-group row">
          <label class="col-sm-2 form-control-label text-right">Nome</label>
          <div class="col-sm-8">
            <p><?php echo $categoria->getNome(); ?></p>
          </div>
        </div>
        <form method="post">
            <div class="form-group row">
              <a class="btn btn-primary col-sm-4 offset-sm-2" style="margin-right: 10px;" href="<?php echo $this->base_url; ?>CategoriaAdmin">Voltar</a>
              <input type="submit" name="del" value="Deletar" class="btn btn-danger col-sm-4 ">
            </div>
        </form>

    </div>
  </div>
</div>
</div>
