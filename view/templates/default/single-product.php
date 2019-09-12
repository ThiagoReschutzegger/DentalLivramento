<?php
$grupo = $data['grupo-prod'];
$categoria = $data['categoria-prod'];
$marca = $data['marca'];
$item = $data['item'];
$subgrupo = $data['subgrupo'];

$espec_aux = [];
$espec_real = [];
$var = false;
$i = 0;

foreach ($data['produto'] as $produtos):

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
                  <a href="<?php echo $this->base_url; ?>Loja/viewSub/<?php echo $grupo->getId_grupo(); ?>">
                    <?php echo $categoria->getNome(); ?>
                  </a>
                </li>
                <li class="active">
                  <a href="<?php echo $this->base_url; ?>Loja/viewSub/<?php echo $grupo->getId_grupo(); ?>">
                    <b><?php echo $grupo->getNome(); ?></b>
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
          };
          $(function(){
            $("#exzoom").exzoom({
              "navBorder": 0,
              "autoPlayTimeout": 4000
            });
          });
          function readMore() {
            var dots = document.getElementById("dots");
            var moreText = document.getElementById("more");
            var btnText = document.getElementById("read");
            var pre = document.getElementById("pre");

            dots.style.display = "none";
            btnText.style.display = "none";
            pre.style.display = "none";
            moreText.style.display = "inline";
          };
      </script>

      <!-- MAIN CONTENT SECTION -->
      <section class="mainContent clearfix">
        <div class="container">
          <div class="row singleProduct">
            <div class="col-md-12">
              <div class="media flex-wrap">
                <div class="media-left productSlider">
                  <div class="exzoom" id="exzoom">
                      <!-- Images -->
                      <div class="exzoom_img_box">
                        <ul class='exzoom_img_ul'>
                          <li><img src="<?php if($item->getImagem() != "") echo $item->getImagem(); else echo $this->base_url."view/images/produto-sem-imagem.gif"; ?>"/></li>
                          <li><img src="<?php echo $marca->getImagem(); ?>"/></li>
                        </ul>
                      </div>
                      <div class="exzoom_nav"></div>
                  </div>
                </div>
                <div class="media-body">
                  <ul class="list-inline">
                    <li><a href="<?php echo $this->base_url; ?>Loja/view/<?php echo $subgrupo->getId_subgrupo(); ?>" style="line-height: 25px"><i class="fa fa-reply" aria-hidden="true"></i>Continuar Comprando</a></li>
                    <li style="margin-right: 0px; float: right;">
                      <a target="_blank" href="<?php echo $marca->getCatalogo(); ?>" class="btn btn-primary" style="font-size: 10px; line-height: 25px; height: 25px; color: white;">
                        <i class="fa fa-file" aria-hidden="true"></i>&nbsp;Catálogo&nbsp;<?php echo $marca->getNome(); ?>
                      </a>
                    </li>
                  </ul>
                  <h2><?php echo $subgrupo->getNome(); ?></h2>
                  <h3 style="margin-bottom:10px;">
                    <small>a partir de: </small>
                    R$<?php echo number_format((float)$data['preco-ate'], 2); ?>
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
                  <p>
                    <?php if(mb_strlen($item->getDescricao()) > 150):?>
                    <span id="pre"><?php echo mb_substr($item->getDescricao(), 0, 150, 'UTF-8'); ?></span>
                    <span id="dots">...</span>
                    <span id="more" style="display: none;"><?php echo $item->getDescricao(); ?></span>
                    <span onclick="readMore()" id="read" style="cursor: pointer; color: #00bafa;"><b>Ler mais</b></span>
                    <?php else:
                        echo $item->getDescricao();
                      endif; ?>
                  <?php if (count($data['produto']) == 1):
                    $produtos = $data['produto'][0];
                  ?>
                  <br><?php echo $produtos->getEspecificacao(); ?></p>
                  <div class="cartListInner">
                  <div class="table-responsive">
                    <form method="post">

                    <table class="table">
                      <thead>
                          <tr>
                            <th style="display: none;"></th>
                          </tr>
                      </thead>
                      <tbody>
                      <tr style="border: 0;">
                        <td style="display: none;"></td>
                        <?php if ($produtos->getEstoque()==0): ?>
                          <td>Indisponível no momento!</td>
                        <?php else: ?>
                        <td class="count-input" style="border: 0; padding-left: 0; color: #797979">
                          <span class="quant-prod">Quantidade:&nbsp;&nbsp;</span>
                          <a class="incr-btn" data-action="decrease" href="#"><i class="fa fa-minus"></i></a>
                            <input class="quantity" name="espec<?php echo $produtos->getId_produto(); ?>" style="margin:0; width: 40px;" type="number" max="<?php echo $produtos->getEstoque()?>" value="0" placeholder="Qtd." onkeypress="return isNumberKey(event)">
                          <a class="incr-btn" data-action="increase" href="#"><i class="fa fa-plus"></i></a>
                        </td>
                        <td class="count-input" style="border: 0; padding-left: 0; color: #797979">
                          <div class="btn-area text-left" style="margin-bottom: 0;">
                            <input type="submit" style="width: 220px;" name="add" class="btn btn-primary btn-default" value='Adicionar ao carrinho'/>
                          </div>
                        </td>
                        <?php endif;?>
                      </tr>
                    </tbody>
                  </table>
              </form>
                  </div>
                </div>
                  <?php else:?>
                    </p>
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
                        <?php foreach ($data['produto'] as $produtos):
                          foreach ($espec_real as $linha){
                              if($produtos->getEspecificacao() == $linha){
                                $var = true;
                              }
                          }
                          if($var){
                             $var = false;
                             continue;
                          }
                          //if($produtos->getEstoque()==0) continue;
                        ?>
                          <tr>
                            <td style="display: none;"></td>
                  					<td><b>R$<span style="margin:2px"><?php echo number_format((float)$produtos->getPreco(), 2) ?></span></b></td>
                  					<td><?php echo $produtos->getEspecificacao(); ?></td>
                            <?php if ($produtos->getEstoque()==0): ?>
                              <td>Indisponível no momento!</td>
                            <?php else: ?>
                            <td class="count-input">
                              <a class="incr-btn" data-action="decrease" href="#"><i class="fa fa-minus"></i></a>
                                <input class="quantity" name="espec<?php echo $produtos->getId_produto(); ?>" style="margin:0; width: 40px;" type="number" max="<?php echo $produtos->getEstoque()?>" value="0" placeholder="Qtd." onkeypress="return isNumberKey(event)">
                              <a class="incr-btn" data-action="increase" href="#"><i class="fa fa-plus"></i></a>
                            </td>
                            <?php endif;?>
                  				</tr>
                        <?php endforeach; ?>
                        <?php
                        if($espec_real):
                         foreach ($data['produto'] as $produtos):
                           if($i == count($espec_real)) continue;
                            if($produtos->getEspecificacao() == $espec_real[$i]):
                            ?>
                        <tr>
                          <td style="display: none;"></td>
                          <td><b>R$<?php echo $produtos->getPreco(); ?></b></td>
                          <td><?php echo $produtos->getEspecificacao(); ?></td>
                          <td class="count-input">
                            <a class="incr-btn" data-action="decrease" href="#"><i class="fa fa-minus"></i></a>
                              <input class="quantity" name="espec<?php echo $produtos->getId_produto(); ?>" style="margin:0; width: 40px;" type="number" value="0" placeholder="Qtd." onkeypress="return isNumberKey(event)">
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
              <?php endif;?>
                </div>
              </div>
            </div>
          </div>

<?php if (count($data['prod-destaq'])>3): ?>
    <div class="page-header text-uppercase">
      <h4 class="text-uppercase fonte-e-cor-top">Destaques</h4>
    </div>
    <div class="row featuredProducts featuredProductsSlider margin-bottom mouse-grab">
      <?php foreach($data['prod-destaq'] as $destaque): ?>
          <div class="slide col-md-3">
            <div class="productImage clearfix">
              <img src="<?php if($destaque->getImagem() != "") echo $destaque->getImagem(); else echo $this->base_url."view/images/produto-sem-imagem.gif"; ?>">
              <div class="productMasking" onclick="location.href='<?php echo $this->base_url; ?>Home/viewProduto/<?php echo $destaque->getId_item(); ?>';" style="cursor: pointer; background-color: inherit !important;">
              </div>
            </div>
            <div class="productCaption clearfix">
              <a href="<?php echo $this->base_url; ?>Home/viewProduto/<?php echo $destaque->getId_item(); ?>">
                <h4><?php echo $data['nome'.$destaque->getId_item()]; ?></h4>
              </a>
            </div>
          </div>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>
        </div>
      </section>
