<?php
$produto  = $data['packproduto'][0];
$grupo = $data['grupo'];
$categoria = $data['categoria'];
$marca = $data['marca'];

$espec_aux = [];
$espec_real = [];
$var = false;
$i = 0;

foreach ($data['packproduto'] as $produtos):

  foreach ($espec_aux as $linha){
      if($produtos->getEspecificacao() == $linha){
        $espec_real[] = $produtos->getEspecificacao();
      }
  }
  $espec_aux[] = $produtos->getEspecificacao();
endforeach;
?>
      <!-- LIGHT SECTION -->
      <section class="lightSection clearfix pageHeader">
        <div class="container">
          <div class="row">
            <div class="col-md-6">
              <div class="page-title">
                <h2>Visualizar Produto</h2>
              </div>
            </div>
            <div class="col-md-6">
              <ol class="breadcrumb pull-right">
                <li>
                  <a href="<?php echo $this->base_url; ?>">Home</a>
                </li>
                <li>
                  <a href="<?php echo $this->base_url; ?>Home/viewCategoria/<?php echo $categoria->getId_categoria(); ?>">
                    <?php echo $categoria->getNome(); ?>
                  </a>
                </li>
                <li class="active">
                  <a href="<?php echo $this->base_url; ?>Home/viewGrupo/<?php echo $grupo->getId_grupo(); ?>">
                    <?php echo $grupo->getNome(); ?>
                  </a>
                </li>
              </ol>
            </div>
          </div>
        </div>
      </section>

      <script type="text/javascript">
          function isNumberKey(evt){
          var charCode = (evt.which) ? evt.which : event.keyCode
          if (charCode > 31 && (charCode < 48 || charCode > 57))
              return false;
          return true;
          }
      </script>

      <!-- MAIN CONTENT SECTION -->
      <section class="mainContent clearfix">
        <div class="container">
          <div class="row singleProduct">
            <div class="col-md-12">
              <div class="media flex-wrap">
                <div class="media-left productSlider">
                  <div id="carousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                      <div class="carousel-item active" data-thumb="0">
                        <img style="height: 300px; width: auto;" src="<?php echo $produto->getImagem(); ?>">
                      </div>
                      <div class="carousel-item" data-thumb="1">
                        <img style="height: 300px; width: auto;" src="<?php echo $marca->getImagem(); ?>">
                      </div>
                    </div>
                  </div>
                  <div class="clearfix">
                    <div id="thumbcarousel" class="carousel slide" data-interval="false">
                      <div class="carousel-inner">
                          <div data-target="#carousel" data-slide-to="0" class="thumb"><img src="<?php echo $produto->getImagem(); ?>"></div>
                          <div data-target="#carousel" data-slide-to="1" class="thumb"><img src="<?php echo $marca->getImagem(); ?>"></div>
                      </div>
                      <a class="left carousel-control" href="#thumbcarousel" role="button" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left"></span>
                      </a>
                      <a class="right carousel-control" href="#thumbcarousel" role="button" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right"></span>
                      </a>
                    </div>
                  </div>
                </div>
                <div class="media-body">
                  <ul class="list-inline">
                    <li><a href="<?php echo $this->base_url; ?>Home/viewGrupo/<?php echo $grupo->getId_grupo(); ?>"><i class="fa fa-reply" aria-hidden="true"></i>Continuar Comprando</a></li>
                  </ul>
                  <h2><?php echo $produto->getNome(); ?></h2>
                  <h3 style="margin-bottom:10px;">
                    <small>a partir de: </small>
                    R$<?php echo $data['preco-ate']; ?>
                  </h3>
                  <span style="
                  background-color: transparent;
                  padding: 5px;
                  font-size: 12px;
                  height: 30px;
                  line-height: 30px;
                  font-weight: 400;
                  text-transform: uppercase;
                  <?php echo $data['estoque-msg'];?></span>
                  <hr>                                              <!-- " -->
                  <p><?php echo $produto->getDescricao(); ?></p>
                  <div class="cartListInner">
                  <div class="table-responsive">
                  <form method="post">
                  <div style="max-height:300px; min-height:155px;  overflow:auto;  margin-top:20px; margin-bottom:20px;" >
                  <table class="table">
                      <thead>
                          <tr>
                            <th style="display: none;"></th>
                            <th style="font-weight: 400;">Preço</th>
                            <th style="font-weight: 400;">Nome</th>
                            <th style="font-weight: 400;">Quantidade</th>
                          </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($data['packproduto'] as $produtos):
                          foreach ($espec_real as $linha){
                              if($produtos->getEspecificacao() == $linha){
                                $var = true;
                              }
                          }
                          if($var){
                             $var = false;
                             continue;
                          }
                        ?>
                          <tr>
                            <td style="display: none;"></td>
                  					<td><b>R$<span style="margin:2px"><?php echo $produtos->getPreco(); ?></span></b></td>
                  					<td><?php echo $produtos->getEspecificacao(); ?></td>
                            <td class="count-input">
                              <a class="incr-btn" data-action="decrease" href="#"><i class="fa fa-minus"></i></a>
                                <input class="quantity" name="espec<?php echo $produtos->getId_produto(); ?>" style="margin:0;" type="number" value="0" placeholder="Qtd." onkeypress="return isNumberKey(event)">
                              <a class="incr-btn" data-action="increase" href="#"><i class="fa fa-plus"></i></a>
                            </td>
                  				</tr>
                        <?php endforeach; ?>
                        <?php
                        if($espec_real):
                         foreach ($data['packproduto'] as $produtos):
                           if($i == count($espec_real)) continue;
                            if($produtos->getEspecificacao() == $espec_real[$i]):
                            ?>
                        <tr>
                          <td style="display: none;"></td>
                          <td><b>R$<?php echo $produtos->getPreco(); ?></b></td>
                          <td><?php echo $produtos->getEspecificacao(); ?></td>
                          <td class="count-input">
                            <a class="incr-btn" data-action="decrease" href="#"><i class="fa fa-minus"></i></a>
                              <input class="quantity" name="espec<?php echo $produtos->getId_produto(); ?>" style="margin:0;" type="number" value="0" placeholder="Qtd." onkeypress="return isNumberKey(event)">
                            <a class="incr-btn" data-action="increase" href="#"><i class="fa fa-plus"></i></a>
                          </td>
                        </tr>
                        <?php
                        $i++;
                          endif;
                       endforeach;
                     endif; ?>
                			</tbody>
                		</table>
                  </div>

                  <div class="btn-area text-right">
                    <input type="submit" style="width: 220px;" name="add" class="btn btn-primary btn-default" value='Adicionar ao carrinho'/>
                  </div>
                </form>
              </div>
                </div>
                </div>
              </div>
            </div>
          </div>


          <div class="page-header text-uppercase">
            <h4 class="text-uppercase fonte-e-cor-top">Destaques</h4>
          </div>

          <div class="row featuredProducts featuredProductsSlider margin-bottom mouse-grab">
            <?php foreach($data['prod-destaq'] as $destaque): ?>
                <div class="slide col-md-3">
                  <div class="productImage clearfix">
                    <img src="<?php echo $destaque->getImagem(); ?>">
                    <div class="productMasking">
                      <ul class="list-inline btn-group" role="group">
                        <li><a href="<?php echo $this->base_url; ?>Home/viewProduto/<?php echo $destaque->getId_subgrupo(); ?>" class="btn btn-default"><i class="fa fa-eye"></i></a></li>
                      </ul>
                    </div>
                  </div>
                  <div class="productCaption clearfix">
                    <a href="<?php echo $this->base_url; ?>Home/viewProduto/<?php echo $destaque->getId_subgrupo(); ?>">
                      <h4><?php echo $destaque->getNome(); ?></h4>
                    </a>
                  </div>
                </div>
            <?php endforeach; ?>
          </div>
        </div>
      </section>
