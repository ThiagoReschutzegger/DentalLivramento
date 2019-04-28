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
                      <form method="POST" class="form-inline">
                          <div class="form-group">
                              <div class="col-sm-12 ">
                                  <span style='color:grey; font-size:15px'>&nbsp&nbsp&nbspOrganizar por:&nbsp&nbsp&nbsp</span>
                                  <select name="organizar" class="form-control">
                                      <option value='2'>Agrup. de produtos</option>
                                      <option value='1'>Produto unitário</option>
                                  </select>
                              </div>
                          </div>
                          <div class="form-group">
                              <label for='inlineFormInput' class="form-control-label">&nbsp&nbsp&nbspCód. de Barras&nbsp&nbsp&nbsp</label>
                              <input id="inlineFormInput" name="codigo" type="text" placeholder="CÓDIGO DE BARRAS" class="mr-1 form-control">
                          </div>
                          <div class="form-group">
                              <label for='inlineFormInputGroup' class="form-control-label">&nbsp&nbsp&nbspNome&nbsp&nbsp&nbsp</label>
                              <input id="inlineFormInputGroup" name="nome" type="text" placeholder="NOME DO PRODUTO" class="mr-1 form-control">
                          </div>
                          <br>
                          <br>
                          <br>
                          <br>
                          <div class="form-group col-lg-12 col-sm-12 col-md-12">
                              <input type="submit" name="buscar" value="Buscar" class="btn btn-primary col-lg-12 col-sm-12 col-md-12">
                          </div>
                      </form>
                  </div>
              </div>
          </div>
          <div class="col-lg-12">
              <div class="card">
                  <div class="card-body">
                      <?php if ($data['resultado'] == 'inicio'): ?>
                          <div class="alert alert-info" role="alert">
                              Insira alguns dos campos.
                          </div>
                      <?php elseif ($data['resultado'] == 'vazio'): ?>
                          <div class="alert alert-warning" role="alert">
                              Não foi encontrado nenhum valor correspondente
                          </div>
                      <?php else: ?>
                        <?php if($data['status'] == '1'): ?>
                          <div class="card-header d-flex align-items-center">
                              <h3 class="h4">Resultado da busca</h3>
                          </div>
                          <div class="card-body">
                              <div class="table-responsive">
                                  <table class="table table-striped table-hover">
                                      <thead>
                                          <tr>
                                              <th>Imagem</th>
                                              <th>Cód. Barras</th>
                                              <th>Nome</th>
                                              <th>Especificação</th>
                                              <th>Visualizar</th>
                                          </tr>
                                      </thead>
                                      <tbody>
                                          <?php foreach ($data['resultado'] as $produto): ?>
                                              <tr>
                                                  <td><center><img height="100" src="<?php echo $produto->getImagem(); ?>"></center></td>
                                          <td><?php echo $produto->getBarcode(); ?></td>
                                          <td><?php echo mb_substr($produto->getNome(), 0, 45, 'UTF-8') . "..."; ?></td>
                                          <td><?php echo mb_substr($produto->getEspecificacao(), 0, 45, 'UTF-8') . "..."; ?></td>
                                          <td>
                                          <center><a href="<?php echo $this->base_url ?>ProdutoAdmin/viewProduto/<?php echo $produto->getId_produto(); ?>"><button type="button" class="btn btn-secondary btn-block"><i class="fa fa-eye"></i></button></a></center>
                                          </td>
                                          </tr>
                                      <?php endforeach; ?>
                                      <tr>
                                          <td colspan="8"><center><a href="<?php echo $this->base_url; ?>ProdutoAdmin/addProdutoWhere" class="btn btn-success btn-lg btn-block"><i class="fa fa-plus"></i></a></center></td>
                                      </tr>
                                      </tbody>
                                  </table>
                              </div>
                          </div>
                        <?php elseif ($data['status'] == '2'): ?>
                          <div class="card-header d-flex align-items-center">
                              <h3 class="h4">Resultado da busca</h3>
                          </div>
                          <div class="card-body">
                              <div class="table-responsive">
                                  <table class="table table-striped table-hover">
                                      <thead>
                                          <tr>
                                              <th>Imagem</th>
                                              <th>Nome</th>
                                              <th>Descrição</th>
                                              <th>Marca</th>
                                              <th>Visualizar</th>
                                          </tr>
                                      </thead>
                                      <tbody>
                                          <?php foreach ($data['resultado'] as $produto): ?>
                                              <tr>
                                                  <td><center><img height="100" src="<?php echo $produto->getImagem(); ?>"></center></td>
                                          <td><?php echo $produto->getNome(); ?></td>
                                          <td><?php echo mb_substr($produto->getDescricao(), 0, 45, 'UTF-8') . "<br>".mb_substr($produto->getDescricao(), 46, 90, 'UTF-8')."..."; ?></td>
                                          <td><?php echo $produto->getId_marca(); ?></td>
                                          <td>
                                          <center><a href="<?php echo $this->base_url ?>ProdutoAdmin/viewSubOf/<?php echo $produto->getId_subgrupo(); ?>"><button type="button" class="btn btn-secondary btn-block"><i class="fa fa-eye"></i></button></a></center>
                                          </td>
                                          </tr>
                                      <?php endforeach; ?>
                                      <tr>
                                          <td colspan="8"><center><a href="<?php echo $this->base_url; ?>ProdutoAdmin/addProdutoWhere" class="btn btn-success btn-lg btn-block"><i class="fa fa-plus"></i></a></center></td>
                                      </tr>
                                      </tbody>
                                  </table>
                              </div>
                          </div>
                        <?php endif;?>
                      <?php endif; ?>

                  </div>
              </div>
          </div>
      </section>
  </div>
