<?php $slider = $data; ?>
<div class="container-fluid" style="margin-top: 50px">
<div class="col-lg-12">
  <div class="card">
    <div class="card-header d-flex align-items-center ">
      <h3 class="h4">Deletar Slider</h3>
    </div>
    <div class="card-body alert-danger">
        <div class="form-group row">
          <label class="col-sm-2 form-control-label text-right">Nome</label>
          <div class="col-sm-8">
            <p><?php echo $slider[1]->getNome(); ?></p>
          </div>
        </div>
        <div class="line"></div>
        <div class="form-group row">
          <label class="col-sm-2 form-control-label text-right">Link</label>
          <div class="col-sm-8">
            <img class="image-fluid" src="<?php echo $slider[0]->getImagem(); ?>" height="250px" />
            <br>
            <small>"<?php echo $slider[0]->getImagem(); ?>"</small>
          </div>
        </div>
        <div class="line"></div>
        <div class="form-group row">
          <label class="col-sm-2 form-control-label text-right">Descrição</label>
          <div class="col-sm-8">
            <p><?php echo $slider[1]->getDescricao(); ?></p>
          </div>
        </div>

        <form method="post">
            <div class="form-group row">
              <a class="btn btn-primary col-sm-4 offset-sm-2" style="margin-right: 10px;" href="<?php echo $this->base_url; ?>ProdutoAdmin/viewSubOf/<?php echo $slider[1]->getId_subgrupo(); ?>">Voltar</a>
              <input type="submit" name="del" value="Deletar" class="btn btn-danger col-sm-4 ">
            </div>
        </form>

    </div>
  </div>
</div>
</div>
