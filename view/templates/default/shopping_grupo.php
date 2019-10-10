<?php
$cat_atual = $data['categoria-atual'];
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
              rgba(0, 220, 255, 0.5)  /*0, 220, 255, 0.5*/
              );
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
            <h2><?php echo $cat_atual->getNome();?></h2>
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
      <div class="col-md-12">
        <div class="row filterArea">
          <div class="col-12">
            <span style="color: gray; padding-top: 5px;">Vizualizando os grupos desta categoria</span>
          </div>
        </div>
        <div class="row">
          <?php if(empty($data['grupo'])):?>
            <div class="col-md-6 col-lg-4">
              <div class="productBox">
                <div class="productCaption clearfix">
                    <h5>Esta categoria não possui grupos cadastrados!</h5>
                </div>
              </div>
            </div>
          <?php else:
           foreach ($data['grupo'] as $grupo): ?>
              <div class="col-md-6 col-lg-4">
                <div class="productBox">
                    <div class="productImage clearfix back-sub" onclick="location.href='<?php echo $this->base_url."Loja/viewSub/".$grupo->getId_grupo(); ?>';">
                          <center>
                              <h2 style="font-size: 2.5em; font-wheight: lighter; color: white; padding-top: 30px; font-variant-caps: all-petite-caps;">
                                  <?php echo $grupo->getNome(); ?>
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
