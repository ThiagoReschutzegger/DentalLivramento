<?php
$cat_atual = $data['categoria-atual'][0];
$gp_atual = $data['grupo-atual'];
$ids_prod = []; //pra nao repetir os subgrupos na hora de listar la
$ids_prod[] = 0;
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
  background:
      linear-gradient(
        rgba(0, 186, 250, 0.5), /*0, 150, 185, 0.5 */
        rgba(0, 220, 255, 0.5)  /*0, 220, 255, 0.5*/
        ),
      url("<?php echo $cat_atual->getImagem();?>") ;
  background-size: cover;
  background-position: center center;
  background-repeat: no-repeat;
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
<form method="post">
<!-- MAIN CONTENT SECTION -->
<section class="mainContent clearfix productsContent sectionPadding">
  <div class="container">
    <div class="row">
      <div class="col-lg-3 col-md-4">
        <div class="sideBar menuBar">
        <div class="panel panel-default">
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
        </div>

        <div class="sideBar">
          <div class="panel panel-default">
            <div class="panel-heading">Filtrar por Marca</div>
            <div class="panel-body clearfix">
              <label for="">Selecione a Marca: </label>
              <?php if($data['packproduto'] == 'password'):?>
                <p>Nenhum produto!</p>
              <?php else:?>
              <div class="collapse navbar-collapse navbar-ex1-collapse navbar-side-collapse">
              <ul class="nav navbar-nav side-nav">
                <li>
                  <ul class="collapse collapseItem show">
                    <?php $ids_aux = []; $ids_aux[] = 0; ?>
                    <?php if ($data['link'] == 0):
                      foreach ($data['marca'] as $marca):
                      if(in_array($marca->getId_marca(), $ids_aux)) continue;
                    ?>
                      <li><a href="<?php echo $this->base_url."Loja/view/".$gp_atual->getId_grupo().".1.".$marca->getId_marca();?>" ><i class="fa fa-caret-right" aria-hidden="true"></i><?php echo $marca->getNome(); ?></a></li> <!--  if($linha->getId_grupo() == $gp_atual->getId_grupo()) echo "style='font-weight: bold !important; text-decoration: underline !important;'"; -->
                    <?php $ids_aux[] = $marca->getId_marca(); endforeach;
                      else:
                        foreach ($data['marca'] as $marca):
                          if($data['link'] == $marca->getId_marca()): ?>
                            <li><a disabled="true" ><b><u><i class="fa fa-caret-right" aria-hidden="true"></i><?php echo $marca->getNome(); ?></u></b></a></li>
                            <li><small>Esta marca está selecionada.<br>Redefina caso queira outra.</small></li>
                    <?php endif; break; endforeach; endif; ?>
                  </ul>
                </li>
              </ul>
            </div>
          <?php endif;?>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-2"></div>
          <div class="col-8">
            <a href="<?php echo $this->base_url; ?>Loja/view/<?php echo $gp_atual->getId_grupo(); ?>"  class="btn btn-inverse-outlined btn-sm btn-block" style="display: inline-block;">Redefiinr</a>
          </div>
        </div><br><br>


      </div>
      <div class="col-lg-9 col-md-8">
        <div class="row filterArea">
          <div class="col-5 Vizualizando">
            <span style="color: gray; padding-top: 5px;">Vizualizando
              <?php if($data['total_prod'] < 12) echo $data['total_prod']; else echo  $data['total_prod_atual']; ?>
               de
                <?php echo $data['total_prod'];?>
                produtos:</span>
          </div>
          <div class="col-md-7 col-sm-12">
            <div class="float-right select-shop">
            <select name="guiest_id1" id="guiest_id1" class="select-drop">
              <option value="new">Mais Novo </option>
              <option value="alfa">Ordem Alfabética</option>
              <option value="maior">Preço Maior</option>
              <option value="menor">Preço Menor</option>
            </select><input class="btn btn-primary" type="submit" name="filter" value="Go!" style="height: 35px; line-height: 0px;"/>
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
             if(in_array($produtos->getId_subgrupo(), $ids_prod)) continue; else $ids_prod[] = $produtos->getId_subgrupo();
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
        <center><div class="btn-group row" role="group" aria-label="Basic example" style="margin:0"><center>
          <?php if ($data['paginador_atual'] > 1 ): ?>
            <a href="<?php echo $this->base_url; ?>Loja/view/<?php echo $gp_atual->getId_grupo();?>.<?php echo $data['paginador_atual']-1; if($data['link'] != 0) echo ".".$data['link']; ?>" class="btn btn-primary-outlined" style="margin-top: 10px;">Anterior</a>
          <?php endif; ?>
          <?php if ($data['paginador_atual'] < $data['paginador_max'] ): ?>
            <a href="<?php echo $this->base_url; ?>Loja/view/<?php echo $gp_atual->getId_grupo();?>.<?php echo $data['paginador_atual']+1; if($data['link'] != 0) echo ".".$data['link']; ?>" class="btn btn-primary-outlined" style="margin-top: 10px;">Próxima</a>
          <?php endif; ?>
        </center></div></center>
      </div>
    </div>
  </div>
</section>
