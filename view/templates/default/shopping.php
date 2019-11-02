<?php
$cat_atual = $data['categoria-atual'][0];
$gp_atual = $data['grupo-atual'];
$ids_prod = []; //pra nao repetir os subgrupos na hora de listar la
$ids_prod[] = 0;
?>

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
                <ul class="nav navbar-nav side-nav" style="background-color: white;">
                <li>
                  <a href="javascript:;" data-toggle="collapse" aria-expanded="true" data-target="#menu_side<?php echo $cat_atual->getId_categoria();?>"><?php echo $cat_atual->getNome();?><i class="fa fa-plus"></i></a>
                  <ul id="menu_side<?php echo $cat_atual->getId_categoria();?>" class="collapse collapseItem show">
                    <?php foreach ($data['grupo'] as $linha):
                      if($linha->getId_categoria() == $cat_atual->getId_categoria()):
                    ?>
                      <li><a href="<?php echo $this->base_url; ?>Loja/viewSub/<?php echo $linha->getId_grupo(); ?>" <?php if($linha->getId_grupo() == $gp_atual->getId_grupo()) echo "style='font-weight: bold !important; text-decoration: underline !important;'"; ?>><i class="fa fa-caret-right" aria-hidden="true"></i><?php echo $linha->getNome(); ?></a></li>
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
                          <li><a href="<?php echo $this->base_url; ?>Loja/viewSub/<?php echo $linha->getId_grupo(); ?>"><i class="fa fa-caret-right" aria-hidden="true"></i><?php echo $linha->getNome(); ?></a></li>
                          <?php endif; endforeach; ?>
                      </ul>
                    </li>
              <?php endforeach;?>
              </ul>
            </div>
          </div>
        </div>
        </div>

      </div>
      <div class="col-lg-9 col-md-8">
        <div class="row filterArea">
            <div class="col-5 Vizualizando" style="padding-top: 10px;">
                <a style="color: grey; font-size: 15px;" href="<?php echo $this->base_url; ?>Loja/viewSub/<?php echo $gp_atual->getId_grupo(); ?>" style="line-height: 25px"><i class="fa fa-reply" aria-hidden="true"></i>&nbsp;&nbsp;Ver mais</a>
          </div>
          <div class="col-md-7 col-sm-12">
            <div class="float-right select-shop">
            <select name="guiest_id1" id="guiest_id1" class="select-drop">
              <option <?php if($data['ordem'] == "new") echo "selected"; ?> value="new">Mais Novo </option>
              <option <?php if($data['ordem'] == "maior") echo "selected"; ?> value="maior">Preço Maior</option>
              <option <?php if($data['ordem'] == "menor") echo "selected"; ?> value="menor">Preço Menor</option>
            </select><input class="btn btn-primary" type="submit" name="filter" value="Go!" style="height: 35px; line-height: 0px;"/>
          </div>
          </div>

        </div>
        <div class="row">
          <?php if(empty($data['item'])):?>
            <div class="col-md-6 col-lg-4">
              <div class="productBox">
                <div class="productCaption clearfix">
                    <h5>Este subgrupo não possui produtos cadastrados!</h5>
                </div>
              </div>
            </div>
          <?php else:
             if($data['ordem'] != "new"):
              foreach ($data['ordem_precos'] as $ordem):
              foreach ($data['item'] as $item): 
               if($item->getId_marca()."-".$item->getTipo() == $ordem): //$produto->getId_marca()."-".$produto->getTipo() 
              ?>
              <div class="col-sm-6 col-lg-4 produto-box">
                <div class="productBox">

                  <div class="productImage clearfix">
                    <img src="<?php if($item->getImagem() != "") echo $item->getImagem(); else echo $this->base_url."view/images/produto-sem-imagem.gif"; ?>" alt="products-img">
                    <div class="productMasking" onclick="location.href='<?php echo $this->base_url; ?>Home/viewProduto/<?php echo $item->getId_item(); ?>';" style="cursor: pointer; background-color: inherit !important;">
                    </div>

                  </div>

                  <div class="productCaption clearfix">
                    <a href="<?php echo $this->base_url; ?>Home/viewProduto/<?php echo $item->getId_item(); ?>">
                        <h5 style="margin-bottom: 5px;"><?php echo $data['subgrupo']->getNome(); ?></h5>
                        <h3 class="fonte-e-cor-top" style="font-size: 15px; margin-bottom: 5px;">
                            <?php foreach ($data['marca'] as $marca):
                                if($marca->getId_marca() == $item->getId_marca()) echo $marca->getNome();
                            endforeach; ?>
                        </h3>
                    </a>
                    <h3>R$ <?php echo  number_format($data['preco_min'.$item->getId_marca()."-".$item->getTipo()], 2); ?><a href="<?php echo $this->base_url; ?>Home/viewProduto/<?php echo $item->getId_item(); ?>"  class="btn btn-primary-outlined btn-compra">Comprar</a></h3>
                  </div>
                </div>
              </div>
        <?php endif; endforeach; endforeach; else: 
          foreach ($data['item'] as $item): 
          ?>
             
            <div class="col-sm-6 col-lg-4 produto-box">
                <div class="productBox">

                  <div class="productImage clearfix">
                    <img src="<?php if($item->getImagem() != "") echo $item->getImagem(); else echo $this->base_url."view/images/produto-sem-imagem.gif"; ?>" alt="products-img">
                    <div class="productMasking" onclick="location.href='<?php echo $this->base_url; ?>Home/viewProduto/<?php echo $item->getId_item(); ?>';" style="cursor: pointer; background-color: inherit !important;">
                    </div>
                  </div>

                  <div class="productCaption clearfix">
                    <a href="<?php echo $this->base_url; ?>Home/viewProduto/<?php echo $item->getId_item(); ?>">
                        <h5 style="margin-bottom: 5px;"><?php echo $data['subgrupo']->getNome(); ?></h5>
                        <h3 class="fonte-e-cor-top" style="font-size: 15px; margin-bottom: 5px;">
                            <?php foreach ($data['marca'] as $marca):
                                if($marca->getId_marca() == $item->getId_marca()) echo $marca->getNome();
                            endforeach; ?>
                        </h3>
                    </a>
                    <h3>R$ <?php echo  number_format($data['preco_min'.$item->getId_marca()."-".$item->getTipo()], 2); ?><a href="<?php echo $this->base_url; ?>Home/viewProduto/<?php echo $item->getId_item(); ?>"  class="btn btn-primary-outlined btn-compra" >Comprar</a></h3>
                  </div>
                </div>
              </div>
            <?php endforeach; endif; endif; ?>
        </div>
      </div>
    </div>
  </div>
</section>
