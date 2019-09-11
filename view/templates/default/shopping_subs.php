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

        .back-sub:hover {
            font-size: 1.2em;
            transition: all 0.1s ease-in-out;
          }
        .back-sub {
            background:
            linear-gradient(
              rgba(0, 186, 250, 0.7), /*0, 150, 185, 0.5 */
              rgba(0, 220, 255, 0.3)  /*0, 220, 255, 0.5*/
              ),
            url("<?php echo $this->asset;?>img/pattern-dental.jpg");
            background-size: cover;
            background-position: center center;
            background-repeat: no-repeat;
            height: 130px !important;
            border-radius: 15px;
            cursor: pointer;
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
          <div class="col-5 Vizualizando">
            <span style="color: gray; padding-top: 5px;">Vizualizando
              <?php echo $data['total-sub']; ?>
                produtos:</span>
          </div>
        </div>
        <div class="row">
          <?php if(empty($data['subgrupo'])):?>
            <div class="col-md-6 col-lg-4">
              <div class="productBox">
                <div class="productCaption clearfix">
                    <h5>Este grupo não possui produtos cadastrados!</h5>
                </div>
              </div>
            </div>
          <?php else:
           foreach ($data['subgrupo'] as $subgrupo): ?>
              <div class="col-md-6 col-lg-4">
                <div class="productBox">
                    <div class="productImage clearfix back-sub" onclick="location.href='<?php echo $this->base_url."Loja/view/".$subgrupo->getId_subgrupo(); ?>';">
                          <center>
                              <h2 style="font-size: 2.5em; font-wheight: lighter; color: white; padding-top: 30px; font-variant-caps: all-petite-caps;">
                                  <?php echo $subgrupo->getNome(); ?>
                              </h2>
                          </center>
                      </div>
                  </div>
              </div>
        <?php endforeach; endif; ?>
        </div>
      </div>
    </div>
  </div>
</section>
