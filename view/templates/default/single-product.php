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
                <h2>Vizualizar Produto</h2>
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
                  <form method="post">
                  <div style="max-height:300px; min-height:155px;  overflow:auto;  margin-top:20px; margin-bottom:20px;" >
                  <table class="table table-espec">
                      <thead>
                          <tr>
                            <th>Preço</th>
                            <th width="600px;">Nome</th>
                            <th>Quantidade</th>
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
                  					<th scope="row">R$<span style="margin:2px"><?php echo $produtos->getPreco(); ?></span></th>
                  					<td><?php echo $produtos->getEspecificacao(); ?></td>
                            <td>
                        				<input name="espec<?php echo $produtos->getId_produto(); ?>" style="width: 100px; height: 30px; margin:0;" type="number" class="form-control" value="0" placeholder="Qtd." onkeypress="return isNumberKey(event)">
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
                          <th scope="row">R$<?php echo $produtos->getPreco(); ?></th>
                          <td><?php echo $produtos->getEspecificacao(); ?></td>
                          <td>
                              <input name="espec<?php echo $produtos->getId_produto(); ?>" style="width: 100px; height: 30px; margin:0;" type="number" class="form-control" value="0" min="0" placeholder="Qtd." onkeypress="return isNumberKey(event)">
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
                  <div class="btn-area text-right table-espec">
                    <input type="submit" style="width: 220px;" name="add" class="btn btn-primary btn-default" value='Adicionar ao carrinho'/>
                  </div>
                </form>
                </div>
              </div>
            </div>
          </div>


          <div class="page-header">
            <h4>Related Products</h4>
          </div>
          <div class="row productsContent">

            <div class="col-md-3 col-12 ">
              <div class="productBox">
                <div class="productImage clearfix">
                  <img src="<?php echo $this->asset;?>img/products/products-01.jpg" alt="products-img">
                  <div class="productMasking">
                    <ul class="list-inline btn-group" role="group">
                      <li><a data-toggle="modal" href=".login-modal" class="btn btn-default"><i class="fa fa-heart-o"></i></a></li>
                      <li><a href="cart-page.html" class="btn btn-default"><i class="fa fa-shopping-basket"></i></a></li>
                      <li><a class="btn btn-default" data-toggle="modal" href=".quick-view" ><i class="fa fa-eye"></i></a></li>
                    </ul>
                  </div>
                </div>
                <div class="productCaption clearfix">
                 <h5>Nike Sportswear</h5>
                 <h3>$199</h3>
                </div>
              </div>
            </div>
            <div class="col-md-3 col-12 ">
              <div class="productBox">
                <div class="productImage clearfix">
                  <img src="<?php echo $this->asset;?>img/products/products-02.jpg" alt="products-img">
                  <div class="productMasking">
                    <ul class="list-inline btn-group" role="group">
                      <li><a data-toggle="modal" href=".login-modal" class="btn btn-default"><i class="fa fa-heart-o"></i></a></li>
                      <li><a href="cart-page.html" class="btn btn-default"><i class="fa fa-shopping-basket"></i></a></li>
                      <li><a class="btn btn-default" data-toggle="modal" href=".quick-view" ><i class="fa fa-eye"></i></a></li>
                    </ul>
                  </div>
                </div>
                <div class="productCaption clearfix">
                 <h5>Dip Dyed Sweater</h5>
                 <h3>$249</h3>
                </div>
              </div>
            </div>
            <div class="col-md-3 col-12 ">
              <div class="productBox">
                <div class="productImage clearfix">
                  <img src="<?php echo $this->asset;?>img/products/products-03.jpg" alt="products-img">
                  <div class="productMasking">
                    <ul class="list-inline btn-group" role="group">
                      <li><a data-toggle="modal" href=".login-modal" class="btn btn-default"><i class="fa fa-heart-o"></i></a></li>
                      <li><a href="cart-page.html" class="btn btn-default"><i class="fa fa-shopping-basket"></i></a></li>
                      <li><a class="btn btn-default" data-toggle="modal" href=".quick-view" ><i class="fa fa-eye"></i></a></li>
                    </ul>
                  </div>
                </div>
                <div class="productCaption clearfix">
                 <h5>Scarf Ring Corner</h5>
                 <h3>$179</h3>
                </div>
              </div>
            </div>
            <div class="col-md-3 col-12 ">
              <div class="productBox">
                <div class="productImage clearfix">
                  <img src="<?php echo $this->asset;?>img/products/products-04.jpg" alt="products-img">
                  <div class="productMasking">
                    <ul class="list-inline btn-group" role="group">
                      <li><a data-toggle="modal" href=".login-modal" class="btn btn-default"><i class="fa fa-heart-o"></i></a></li>
                      <li><a href="cart-page.html" class="btn btn-default"><i class="fa fa-shopping-basket"></i></a></li>
                      <li><a class="btn btn-default" data-toggle="modal" href=".quick-view" ><i class="fa fa-eye"></i></a></li>
                    </ul>
                  </div>
                </div>
                <div class="productCaption clearfix">
                 <h5>Sun Buddies</h5>
                 <h3>$149</h3>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
