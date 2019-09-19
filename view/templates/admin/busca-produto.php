  <div class="content-inner">
      <!-- Page Header-->
      <header class="page-header">
          <div class="container-fluid">
              <h2 class="no-margin-bottom">Busca de produtos</h2>
          </div>
      </header>
      <section>
          <div class="col-lg-12">
              <div class="card">
                  <div class="card-body">
                      <?php if ($data['resultado'] == 'all'): ?>
                      <div class="row">
                          <div class="col-lg-9">
                              <h2 style="padding-top: 10px;">Visualizando todos</h2>
                          </div>
                          <div class="form-group col-lg-3 col-xs-12" style="align: right;">
                              <a href="<?php echo $this->base_url; ?>ProdutoAdmin/buscaProduto" class="btn btn-primary" style="color: white">Voltar a pesquisa &nbsp&nbsp<i class="fa fa-search"></i></a>
                          </div>
                          <br>
                          <br>
                        </div>
                          
                      <?php else : ?>
                      
                      <form method="POST" class="form-inline row">
                          <div class="col-lg-1 col-xs-12">
                              <span style='color:grey; font-size:15px'>Pesquisar:&nbsp&nbsp</span>
                          </div>
                          <div class="form-group col-lg-3 col-xs-12">
                              <input id="inlineFormInput" name="codigo" type="text" placeholder="CÓDIGO DE BARRAS" class="mr-1 form-control">
                          </div>
                          <div class="form-group col-lg-3 col-xs-12">
                              <input id="inlineFormInputGroup" name="nome" type="text" placeholder="NOME DO PRODUTO" class="mr-1 form-control">
                          </div>
                          <div class="col-lg-2"></div>
                          <div class="form-group col-lg-3 col-xs-12" style="align: right;">
                              <a href="<?php echo $this->base_url; ?>ProdutoAdmin/buscaProduto/all" class="btn btn-primary" style="color: white">Visualizar todos &nbsp&nbsp<i class="icon-grid"></i></a>
                          </div>
                          <br>
                          <br>
                          <br>
                          <br>
                          <div class="form-group col-lg-12 col-sm-12 col-md-12">
                              <input type="submit" name="buscar" value="Buscar" class="btn btn-primary col-lg-12 col-sm-12 col-md-12">
                          </div>
                      </form>
                      <?php endif;?>
                  </div>
              </div>
          </div>
          <div class="col-lg-12">
              <div class="card">
                  <div class="card-body">
                      <?php if ($data['resultado'] == 'inicio'): ?>
                          <div class="alert alert-info" role="alert">
                              Insira algum dos campos.
                          </div>
                      <?php elseif ($data['resultado'] == 'vazio'): ?>
                          <div class="alert alert-warning" role="alert">
                              Não foi encontrado nenhum valor correspondente
                          </div>
                      <?php else: ?>
                        <?php if($data['resultado'] == 'SearchDeSub'): ?>
                          <div class="card-header d-flex align-items-center">
                              <h3 class="h4">Resultado da busca - SUBGRUPO</h3>
                          </div>
                          <div class="card-body">
                              
                                <?php foreach ($data['categoria'] as $categoria):?>
                                    <?php $algum = false; ?>
                                    <div class="card-header d-flex align-items-center row" style="border-width: 3px; border-color: #04040457;">
                                        <div class="col-md-2">
                                            <h3 class="h4"><?php echo $categoria->getNome(); ?></h3>
                                        </div>
                                    <div class="container-fluid col-md-10 row">
                                    <?php foreach ($data['grupo'] as $grupo):
                                         if($grupo->getId_categoria() == $categoria->getId_categoria()):
                                     ?>

                                      <div class="col-lg-6">
                                          <div class="card">
                                              <div class="card-header d-flex align-items-center" >
                                              <h3 class="h4">
                                                <a class="btn btn-info" data-toggle="collapse" href="#collapseExample<?php echo $grupo->getId_grupo(); ?>" role="button" aria-expanded="false" aria-controls="collapseExample" style="text-decoration: none;">
                                                  <?php echo $grupo->getNome(); ?>
                                                </a>
                                              </h3>
                                            </div>
                                            <div class="collapse" id="collapseExample<?php echo $grupo->getId_grupo(); ?>">
                                              <div class="card-body">
                                                <div class="table-responsive">
                                                  <table class="table table-striped table-hover">
                                                    <thead>
                                                      <tr>
                                                        <th>Nome do Subgrupo</th>
                                                        <th></th>
                                                      </tr>
                                                    </thead>
                                                    <tbody>

                                                        <?php foreach ($data['subgrupo'] as $subgrupo):
                                                          if ($subgrupo->getId_grupo() == $grupo->getId_grupo()):
                                                              echo '<tr>
                                                              <td>'.$subgrupo->getNome().'</td>
                                                              <td>
                                                              <a class="btn btn-primary" href="'.$this->base_url.'ProdutoAdmin/viewItens/'.$subgrupo->getId_subgrupo().'"><i class="fa fa-angle-double-right"></i></a>
                                                              </td>
                                                              </tr>';
                                                              $algum = true;
                                                          endif;
                                                       endforeach;
                                                       if(!$algum){
                                                         echo '<tr><td colspan="3"><center>Nenhum subgrupo existente nesse grupo.</center></td></tr>';
                                                         $algum = true;
                                                       }
                                                      ?>
                                                    </tbody>
                                                  </table>
                                                </div>
                                              </div>
                                            </div>
                                          </div>
                                      </div>
                                    <?php $algum = false; endif; endforeach; ?>

                                  </div>
                                  </div>
                                <?php endforeach;?>
                              
                          </div>
                        <?php elseif ($data['resultado'] == 'SearchDeProd'): ?>
                        <div class="card-header d-flex align-items-center">
                              <h3 class="h4">Resultado da busca - PRODUTO</h3>
                          </div>
                           
                                    <div class="card-body row" style="border: 0;">
                                        <?php foreach($data['item'] as $item): ?>
                                        <div class="col-lg-12">
                                                <div class="card">
                                                    <div class="card-header d-flex align-items-center row" style="margin: 0;" >
                                                        <div class="col-lg-2">
                                                            <img src="<?php if($item->getImagem() != "") echo $item->getImagem(); else echo $this->base_url."view/images/produto-sem-imagem.gif"; ?>" style="width: 100%;"/>
                                                        </div>
                                                        <div class="col-lg-7">
                                                            <h3 class="h4">
                                                                <?php echo $data['subgrupo']->getNome(); ?> - <span style="color: #ff2929;">
                                                                    <?php echo $data['marca']->getNome(); ?></span>
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
                                                              </thead>
                                                            <tbody>
                                                                <?php foreach ($data['produto'] as $produto):
                                                                  if ($produto->getId_marca() == $item->getId_marca()):?>
                                                                    <tr>
                                                                        <td><?php echo $produto->getEspecificacao(); ?></td>
                                                                        <td>R$ <?php echo number_format($produto->getPreco(), 2); ?></td>
                                                                        <td><?php echo $produto->getEstoque(); ?></td>
                                                                        <td><?php echo $produto->getBarcode(); ?></td>
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
                                
                      
                        <?php elseif ($data['resultado'] == 'all'): ?>
                            
                            <?php foreach ($data['categoria'] as $categoria):?>
                            <?php $algum = false; ?>
                            <div class="card-header d-flex align-items-center row" style="border-width: 3px; border-color: #04040457;">
                                <div class="col-md-2">
                                    <h3 class="h4"><?php echo $categoria->getNome(); ?></h3>
                                </div>
                            <div class="container-fluid col-md-10 row">
                            <?php foreach ($data['grupo'] as $grupo):
                                 if($grupo->getId_categoria() == $categoria->getId_categoria()):
                             ?>

                              <div class="col-lg-6">
                                  <div class="card">
                                      <div class="card-header d-flex align-items-center" >
                                      <h3 class="h4">
                                        <a class="btn btn-info" data-toggle="collapse" href="#collapseExample<?php echo $grupo->getId_grupo(); ?>" role="button" aria-expanded="false" aria-controls="collapseExample" style="text-decoration: none;">
                                          <?php echo $grupo->getNome(); ?>
                                        </a>
                                      </h3>
                                    </div>
                                    <div class="collapse" id="collapseExample<?php echo $grupo->getId_grupo(); ?>">
                                      <div class="card-body">
                                        <div class="table-responsive">
                                          <table class="table table-striped table-hover">
                                            <thead>
                                              <tr>
                                                <th>Nome do Subgrupo</th>
                                                <th></th>
                                              </tr>
                                            </thead>
                                            <tbody>

                                                <?php foreach ($data['subgrupo'] as $subgrupo):
                                                  if ($subgrupo->getId_grupo() == $grupo->getId_grupo()):
                                                      echo '<tr>
                                                      <td>'.$subgrupo->getNome().'</td>
                                                      <td>
                                                      <a class="btn btn-primary" href="'.$this->base_url.'ProdutoAdmin/viewItens/'.$subgrupo->getId_subgrupo().'"><i class="fa fa-angle-double-right"></i></a>
                                                      </td>
                                                      </tr>';
                                                      $algum = true;
                                                  endif;
                                               endforeach;
                                               if(!$algum){
                                                 echo '<tr><td colspan="3"><center>Nenhum subgrupo existente nesse grupo.</center></td></tr>';
                                                 $algum = true;
                                               }
                                              ?>
                                            </tbody>
                                          </table>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                              </div>
                            <?php $algum = false; endif; endforeach; ?>
                            
                          </div>
                          </div>
                        <?php endforeach;?>
                        <?php endif;?>
                      <?php endif; ?>

                  </div>
              </div>
          </div>
      </section>
  </div>
