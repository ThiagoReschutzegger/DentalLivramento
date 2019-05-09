<?php $categoria = $data['categoria']; ?>
<div class="container-fluid" style="margin-top: 50px">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header d-flex align-items-center">
                <h3 class="h4">Vizualizar Categoria</h3>
            </div>
            <div class="card-body">
                <div style="margin:10px">
                  <div class="row">
                      <div class="float-left">
                          <img class="image-fluid border border-light rounded shadow p-3 mb-5 bg-white" style="margin:15px;max-width:300px" src="<?php echo $categoria->getImagem(); ?>">
                      </div>

                      <div class="float-right text-left" style='margin-left:20px;'>
                        <br>
                          <h1><span class='text-blue'><?php echo $categoria->getNome(); ?></span></h1>
                          <br>
                          <p class="row">*A imagem será utilizada no fundo da vizualização dos grupos desta categoria no site.</p>
                          <p class="row"><b>Grupos da Categoria:</b>
                            <a href="<?php echo $this->base_url; ?>GrupoAdmin">
                              <span class='text-blue' style='margin-left: 10px'>
                              <?php
                              foreach ($data['grupo'] as $grupo):
                                  if ($grupo->getId_categoria() == $categoria->getId_categoria()) {
                                      echo $grupo->getNome() . "<br>";
                                  }
                              endforeach;
                              ?>
                            </span>
                           </a>
                          </p>
                          <div class="form-group row">
                            <a class="btn btn-primary col-sm-4 offset-sm-2" style="margin-right: 10px;" href="<?php echo $this->base_url; ?>CategoriaAdmin">Voltar</a>
                          </div>
                      </div>




                  </div>
                  <!-- <a class="btn btn-secondary btn-block" style="margin-top:20px" href="<?php echo $this->base_url; ?>ProdutoAdmin/buscaProduto"><i class="fa fa-long-arrow-left"></i>&nbsp&nbspVoltar</a> -->
                </div>
            </div>
        </div>
    </div>
</div>
