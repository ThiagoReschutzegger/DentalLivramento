<?php
$cat_atual = $data['categoria-atual'][0];
$gp_atual = $data['grupo-atual'];
$ids_aux = []; //pra nao repetir os subgrupos na hora de listar la

?>
<script type="text/javascript">
jQuery(document).ready(function(){
//============================== PRICE SLIDER RANGER =========================
var minimum = <?php echo floor($data['preco_min']); ?>;
var maximum = <?php echo floor($data['preco_max']); ?> + 1;

$( '#price-range' ).slider({
  range: true,
  min: minimum,
  max: maximum,
  values: [ minimum, maximum ],
  slide: function( event, ui ) {
    $( '#price-amount-1' ).val( 'R$' + ui.values[ 0 ] );
    $( '#price-amount-2' ).val( 'R$' + ui.values[ 1 ] );
  }
});

$( '#price-amount-1' ).val( 'R$' + $( '#price-range' ).slider( 'values', 0 ));
$( '#price-amount-2' ).val( 'R$' + $( '#price-range' ).slider( 'values', 1 ));
});
</script>

<style type="text/css" scoped>
.pageHeaderImage{
  position: relative;
  background-image: url(<?php echo $cat_atual->getImagem();?>) !important;
  filter: brightness(50%);
}
.pageHeaderImage::before{ /* tentar colocar somente o fundo da seção com o filtro, background-image com filtro css, sla meu */
  background-image: url(<?php echo $cat_atual->getImagem();?>) !important;
  filter: brightness(50%);
}
</style>

<!-- LIGHT SECTION -->
<section class="lightSection clearfix pageHeaderImage img-adapted">
  <div class="container">
    <div class="tableBlock">
      <div class="row tableInner">
        <div class="col-sm-12">
          <div class="page-title">
            <h2><?php echo $gp_atual->getNome();?></h2>
            <ol class="breadcrumb" >
              <li style="color: white;">
                <a href="<?php echo $this->base_url; ?>">Home</a>
              </li>
              <li class="active" style="color: white;"><b><?php echo $cat_atual->getNome();?></b></li>
            </ol>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- MAIN CONTENT SECTION -->
<section class="mainContent clearfix productsContent sectionPadding">
  <div class="container">
    <div class="row">
      <div class="col-lg-3 col-md-4 sideBar">
        <div class="panel panel-default menuBar">
          <div class="panel-heading">Categorias</div>
          <div class="panel-body">
            <div class="collapse navbar-collapse navbar-ex1-collapse navbar-side-collapse">
              <ul class="nav navbar-nav side-nav">
                <li>
                  <a href="javascript:;" data-toggle="collapse" aria-expanded="true" data-target="#menu_side<?php echo $cat_atual->getId_categoria();?>"><?php echo $cat_atual->getNome();?><i class="fa fa-plus"></i></a>
                  <ul id="menu_side<?php echo $cat_atual->getId_categoria();?>" class="collapse collapseItem show">
                    <?php foreach ($data['grupo'] as $linha):
                      if($linha->getId_categoria() == $cat_atual->getId_categoria()):
                    ?>
                      <li><a href="<?php echo $this->base_url; ?>Loja/view/<?php echo $linha->getId_grupo(); ?>" <?php if($linha->getId_grupo() == $gp_atual->getId_grupo()) echo "style='font-weight: bold !important; text-decoration: underline !important;'"; ?>><i class="fa fa-caret-right" aria-hidden="true"></i><?php echo $linha->getNome(); ?></a></li>
                    <?php endif; endforeach; ?>
                  </ul>
                </li>
                <?php foreach ($data['categoria'] as $categorias):
                    if($categorias->getId_categoria() == $cat_atual->getId_categoria()) continue;
                ?>
                    <li>
                      <a href="javascript:;" data-toggle="collapse" aria-expanded="false" data-target="#menu_side<?php echo $categorias->getId_categoria();?>"><?php echo $categorias->getNome(); ?><i class="fa fa-plus"></i></a>
                      <ul id="menu_side<?php echo $categorias->getId_categoria();?>" class="collapse collapseItem">
                        <?php foreach ($data['grupo'] as $linha):
                          if($linha->getId_categoria() == $categorias->getId_categoria()):
                        ?>
                          <li><a href="<?php echo $this->base_url; ?>Loja/view/<?php echo $linha->getId_grupo(); ?>"><i class="fa fa-caret-right" aria-hidden="true"></i><?php echo $linha->getNome(); ?></a></li>
                          <?php endif; endforeach; ?>
                      </ul>
                    </li>
              <?php endforeach;?>
              </ul>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-2"></div>
          <div class="col-8">
            <a data-toggle="modal" href=".quick-view-drone"  class="btn btn-primary btn-block" style="display: inline-block;">Filtrar</a>
          </div>
        </div><br><br>
      </div>
      <div class="col-lg-9 col-md-8">
        <div class="row filterArea">
          <div class="col-6">
            <span style="color: gray; padding-top: 5px;">Vizualizando 12 de X produtos:</span>
          </div>
          <div class="col-6">
            <div class="float-right">
            <select name="guiest_id1" id="guiest_id1" class="select-drop">
              <option value="0">Ordem Alfabética</option>
              <option value="1">Preço Maior</option>
              <option value="1">Preço Menor</option>
              <option value="2">Mais Novo </option>
            </select>
          </div>
          </div>

        </div>
        <div class="row">
          <?php if($data['packproduto'] == 'password'):?>
            <div class="col-md-6 col-lg-4">
              <div class="productBox">
                <div class="productCaption clearfix">
                    <h5>Este grupo não possui produtos cadastrados!</h5>
                </div>
              </div>
            </div>
          <?php else:
           foreach ($data['packproduto'] as $produtos):
             if(in_array($produtos->getId_subgrupo(), $ids_aux)) continue; else $ids_aux[] = $produtos->getId_subgrupo();
             ?>
              <div class="col-md-6 col-lg-4">
                <div class="productBox">
                  <div class="productImage clearfix">
                    <img src="<?php echo $produtos->getImagem(); ?>" alt="products-img">
                    <div class="productMasking">
                      <ul class="list-inline btn-group" role="group">
                        <li><a href="<?php echo $this->base_url; ?>Home/viewProduto/<?php echo $produtos->getId_subgrupo(); ?>" class="btn btn-lg" style="font-size: 20px;"><i class="fa fa-eye"></i></a></li>
                      </ul>
                    </div>
                  </div>
                  <div class="productCaption clearfix">
                    <a href="<?php echo $this->base_url; ?>Home/viewProduto/<?php echo $produtos->getId_subgrupo(); ?>">
                      <h5><?php echo $produtos->getNome(); ?></h5>
                    </a>
                    <h3>R$ <?php echo $data[$produtos->getId_subgrupo()]; ?></h3>
                  </div>
                </div>
              </div>
        <?php endforeach; endif; ?>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- PORDUCT QUICK VIEW MODAL  -->
<div class="modal fade quick-view-drone" tabindex="-1" role="dialog">
<div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-body">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
      <div class="media flex-wrap">
        <div class="media-body row">
          <div class="modalBig" style="width:25% !important;"></div>
          <div class="sideBar modalBar">
            <form method="post">
            <div class="panel panel-default priceRange">
              <div class="panel-heading">Filtrar por preço</div>
              <div class="panel-body clearfix" style="height: 115px;">
                <div class="price-slider-inner">
                  <span class="amount-wrapper">
                    Preço:<br>
                    <input type="text" name="preco-min" id="price-amount-1" readonly>
                    <strong>-</strong>
                    <input type="text" name="preco-max" id="price-amount-2" readonly>
                  </span>
                  <div id="price-range"></div>
                </div>
                <input class="btn-default" type="submit" name="filtrar" value="Filtrar">
                 <!-- <span class="priceLabel">Price: <strong>$12 - $30</strong></span>-->
              </div>
            </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
