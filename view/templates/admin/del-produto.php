<?php
$produto = $data['produto'];
$id_subgrupo = $data['id_subgrupo'];
$nome = $data['nome'];
$esp = $data['esp'];
 ?>
<div class="container-fluid" style="margin-top: 50px">
<div class="col-lg-12">
  <div class="card">
    <div class="card-header d-flex align-items-center ">
      <h3 class="h4">Deletar Produto</h3>
    </div>
    <div class="card-body alert-danger">
        <div class="form-group row">
          <label class="col-sm-2 form-control-label text-right">Nome</label><p><?php echo $nome ?></p>
          <br>
          <label class="col-sm-2 form-control-label text-right">Especificação</label><p><?php echo $esp ?></p>
          <div class="col-sm-8">
            <div class="form-group row text-left">
                <div class="col-sm-4 offset-sm-3">
                  <form method="post">
                  <a class="btn btn-primary" href="<?php echo $this->base_url; ?>ProdutoAdmin/viewSubOf/<?php echo $id_subgrupo; ?>">Voltar</a>
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
