  <div class="content-inner">
      <!-- Page Header-->
      <header class="page-header" style="padding-bottom: 0;">
          <div class="container-fluid row">
              <div class="col-lg-9">    
                  <h2 class="no-margin-bottom" style="padding-top: 10px;">Subgrupo: <span style="color: skyblue;"><?php echo $data['subgrupo']->getNome(); ?></span></h2>
                </div>
                <div class="form-group col-lg-3 col-xs-12" style="align: right;">
                    <a href="<?php echo $this->base_url; ?>ProdutoAdmin/buscaProduto/all" class="btn btn-primary" style="color: white">Visualizar todos &nbsp&nbsp<i class="icon-grid"></i></a>
                </div>
          </div>
      </header>
      <section>
            <div class="col-lg-12">
                <div class="card" style="box-shadow: none;">
                    <div class="card-body row" style="border: 0; background-color: #eef5f9;">
                        <?php foreach($data['item'] as $item): ?>
                        <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header d-flex align-items-center row" style="margin: 0;" >
                                        <div class="col-lg-2">
                                            <img src="<?php if($item->getImagem() != "") echo $item->getImagem(); else echo $this->base_url."view/images/produto-sem-imagem.gif"; ?>" style="width: 100%;"/>
                                        </div>
                                        <div class="col-lg-7">
                                            <h3 class="h4">
                                                <?php echo $data['subgrupo']->getNome(); ?> - <span style="color: #ff2929;"><?php foreach ($data['marca'] as $marca) if($marca->getId_marca() == $item->getId_marca()) echo $marca->getNome(); ?></span>
                                            </h3><br>
                                            <a style=" padding: 2px 30px;
                                                                border-radius: 40px;
                                                                <?php if($item->getDestaque() == 1) echo "background: #54e69d;"; else echo "background: #ff2929;"; ?>
                                                                color: #fff;
                                                                margin-top: 5px;
                                                                font-size: 0.9em;
                                                                text-decoration: none;" disabled="true">
                                                <?php if($item->getDestaque() == 1) echo "Dentro dos destaques"; else echo "Fora dos Destaques"; ?>
                                            </a>
                                        </div>
                                        <div class="col-lg-3">
                                            <a href="<?php echo $this->base_url; ?>ProdutoAdmin/updateItem/<?php echo $item->getId_item(); ?>" class="btn btn-primary" style="color: white">Editar &nbsp&nbsp<i class="fa fa-edit"></i></a>
                                        </div>
                                    </div>
                                      <div class="card-body">
                                          
                                        <div class="table-responsive">
                                          <table class="table table-striped table-hover">
                                              <thead>
                                              <th>Produtos</th>
                                              <th>Preço</th>
                                              <th>Estoque</th>
                                              <th>Cód. Barras</th>
                                              <th>Linha</th>
                                              </thead>
                                            <tbody>
                                                <?php foreach ($data['produto'] as $produto):
                                                  if ($produto->getId_marca() == $item->getId_marca() && $produto->getTipo() == $item->getTipo()):?>
                                                    <tr>
                                                        <td><?php echo $produto->getEspecificacao(); ?></td>
                                                        <td>R$ <?php echo number_format($produto->getPreco(), 2); ?></td>
                                                        <td><?php echo $produto->getEstoque(); ?></td>
                                                        <td><?php echo $produto->getBarcode(); ?></td>
                                                        <td><?php echo $produto->getTipo(); ?></td>
                                                    </tr>
                                                <?php endif;
                                               endforeach;
                                              ?>
                                            </tbody>
                                          </table>
                                        </div>
                                      </div>
                                    </div>
                                  
                              </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
      </section>
  </div>

          