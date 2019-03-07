  <div class="container-fluid" style="margin-top: 50px">
      <div class="col-lg-12">
          <div class="card">
              <div class="card-header d-flex align-items-center">
                  <h3 class="h4">Vizualizar Item</h3>
              </div>
              <div class="card-body">
                  <div style="margin:10px">
                    <div class="row">
                        <div class="float-left">
                            <img class="image-fluid border border-light rounded shadow p-3 mb-5 bg-white" style="margin:15px;max-width:300px" src="<?php echo $data->getImagem(); ?>">
                        </div>

                        <div class="float-right text-left" style='margin-left:20px;'>
                          <br>
                            <h1><span class='text-blue'><?php echo $data->getNome(); ?></span>
                            <br><span style="color:lightgrey; font-size:15px; font-weight:normal">Verificar especificações do produto para informações acerca <b>deste</b> item</span>
                            </h1>
                            <br>
                            <p>Especificações:<span class='text-blue' style='margin-left: 10px'><?php echo $data->getEspecificacao(); ?></span></p>
                            <p>Código de barras:<span class='text-blue' style='margin-left: 10px'><?php echo $data->getBarcode(); ?></span></p>
                            <p>Preço atual:<span class='text-blue' style='margin-left: 10px'>R$ <?php echo (float)$data->getPreco(); ?></span></p>
                            <p>Estoque:<span class='text-blue' style='margin-left: 10px'><?php echo (float)$data->getEstoque(); ?> un.</span></p>
                            <div class="text-center">
                              <a href="<?php echo $this->base_url; ?>ProdutoAdmin/viewSubOf/<?php echo $data->getId_subgrupo(); ?>"><button type="button" class="btn btn-primary btn-lg">Visualizar itens semelhantes</button></a>
                            </div>
                        </div>
                    </div>
                    <!-- <a class="btn btn-secondary btn-block" style="margin-top:20px" href="<?php echo $this->base_url; ?>ProdutoAdmin/buscaProduto"><i class="fa fa-long-arrow-left"></i>&nbsp&nbspVoltar</a> -->
                  </div>
              </div>
          </div>
      </div>
  </div>
