<?php
  $subgrupo = $data['sub'];
  $item = $data['prod'];
  $grupo = $data['grupo'][0];
  $marca = $data['marca'];
  $categoria = $data['cat'][0];
  //echo '<pre>';var_dump($subgrupo);echo "<br>";var_dump($item);die;
?>

  <div class="container-fluid" style="margin-top: 50px">
      <div class="col-lg-12">
          <div class="card">
              <div class="card-header d-flex align-items-center">
                  <h3 class="h4">Vizualizar agrupamento de itens semelhantes</h3>
              </div>
              <div class="card-body">
                  <div style="margin:10px">
                    <div class='row'>
                      <div class="mx-auto text-center">
                          <img class="image-fluid border border-light rounded shadow p-3 mb-5 bg-white" style="margin:15px;max-width:300px" src="<?php echo $subgrupo->getImagem(); ?>">
                      </div>
                    </div>
                    <div class="text-center">


                        <div class="text-left" style='margin-left:20px;'>
                          <br>
                            <h1 class='text-center'>
                              <span class='text-blue'><?php echo $subgrupo->getNome(); ?></span>
                              <br>
                              <br>
                              <span style="color:lightgrey; font-size:15px; font-weight:normal">Aqui se encontram todos os itens que são semelhantes, <br>porém diferem em <b>preço</b>, <b>estoque</b> e <b>especificação</b></span>
                              <br>
                              <br>
                              <a href="#"><button class='btn btn-outline-primary' style="font-size:20px; font-weight:normal"><i class="fa fa-flag"></i>&nbsp&nbsp<?php echo $marca->getNome() ?></button></a>
                              <br>
                              <br>
                              <div style="border:1px solid royalblue;display: inline-block" class='rounded'>
                                <a href="#"><button class='btn btn-outline-primary' style="font-size:20px; font-weight:normal;margin:5px"><i class="fa fa-list"></i>&nbsp&nbsp<?php echo $categoria->getNome() ?></button></a>
                                <i class='fa fa-long-arrow-right text-blue'></i>
                                <a href="#"><button class='btn btn-outline-primary' style="font-size:20px; font-weight:normal;margin:5px"><i class="icon-grid"></i>&nbsp&nbsp<?php echo $grupo->getNome() ?></button></a>
                              </div>
                            </h1>
                            <br>
                            <p><b>Descrição do produto:</b><br><br><span class='text-blue' style='margin-left: 10px'>&emsp;&emsp;<?php echo $subgrupo->getDescricao(); ?></span></p>
                            <br>
                            <div class="table-responsive">
                                <table class="table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>Código de Barras</th>
                                            <th>Especificação</th>
                                            <th>Preço</th>
                                            <th>Estoque</th>
                                            <th>Visualizar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($item as $produto): ?>
                                          <tr>
                                            <td><?php echo $produto->getBarcode(); ?></td>
                                            <td><?php echo substr($produto->getEspecificacao(), 0, 100) . "..."; ?></td>
                                            <td><?php echo $produto->getPreco(); ?></td>
                                            <td><?php echo $produto->getEstoque(); ?></td>
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
