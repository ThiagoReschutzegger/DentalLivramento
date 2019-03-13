<div class="container-fluid" style="margin-top: 50px">
<div class="col-lg-12">
  <?php if($data != ''): ?>
  <?php
  $certo = $data[0];

  $errado = $data[1];

  if (!$certo): ?>
    <div class="row container-fluid">
        <div class="col-sm-12 alert alert-success alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <?php echo $errado ? "Os dados foram inseridos, no entanto, encontramos alguns erros à corrigir. <b>Veja a notificação abaixo.</b>" : "Todos os dados foram ou já estavam atualizados." ?>
        </div>
    </div>
  <?php endif;
   if ($errado): ?>
    <div class="row container-fluid">
        <div class="col-sm-12 alert alert-danger alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            Esses códigos de barras provenientes do arquivo não existem no sistema. <a href="<?php echo $this->base_url; ?>ProdutoAdmin/addProdutoWhere"><b>Adicione manualmente.</b></a><br>
            <?php
            foreach($errado as $value){
            echo "&nbsp&nbsp&nbsp&nbsp&nbsp<i class='fa fa-arrow-right'></i>&nbsp&nbsp&nbsp".$value . "<br>";
            }
            ?>
        </div>
    </div>
  <?php endif; ?>
<?php endif;?>
  <div class="card">
    <div class="card-header d-flex align-items-center ">
      <h3 class="h4">Envio de arquivo para atualização de preço e estoque.</h3>
    </div>
    <div class="card-body">
        <div class="form-group row">
          <div class="card-body">
                      <form class="form-horizontal" enctype="multipart/form-data" method="post" role="form">

                        <div class="line"></div>
                        <div class="form-group row">
                          <label for="fileInput" class="col-sm-3 form-control-label">Arquivo</label>
                          <div class="col-sm-9">
                            <input id="fileInput" type="file" name="arquivo" class="form-control-file">
                          </div>
                        </div>

                        <div class="line"></div>
                        <div class="form-group row">
                          <div class="col-sm-4 offset-sm-3">
                            <button type="submit" name="add" value="true" class="btn btn-primary">Enviar</button>
                          </div>
                        </div>
                      </form>
                    </div>
        </div>

    </div>
  </div>
</div>
</div>
