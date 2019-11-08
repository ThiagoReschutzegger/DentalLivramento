
<div id="mySidenav" class="sidenav">
  <a href="https://api.whatsapp.com/send?phone=555591717303" id="about"><img width="40" src="https://www.freepnglogos.com/uploads/whatsapp-logo-app-png-4.png"></a>
</div>

<!-- BANNER -->
<!--<div class="bannercontainer bannerV1 mouse-grab" style="overflow:hidden">
  <div class="fullscreenbanner-container">
    <div class="fullscreenbanner">
      <ul>
        <li data-transition="slidehorizontal" data-slotamount="5" data-masterspeed="700" data-title="Slide 1">
          <img src="<?php echo $this->asset ?>img/home/banner-slider/slider-bg.jpg" alt="slidebg1" data-bgfit="cover" data-bgposition="center center" data-bgrepeat="no-repeat">
        </li>
        <li data-transition="slidehorizontal" data-slotamount="5" data-masterspeed="700" data-title="Slide 1">
          <img src="<?php echo $this->asset ?>img/home/banner-slider/slider-bg.jpg" alt="slidebg1" data-bgfit="cover" data-bgposition="center center" data-bgrepeat="no-repeat">
        </li>

      </ul>
    </div>
  </div>
</div>-->
    <div class="slider fullscreen">
        <ul class="slides">
              <?php if($data['slider_1']):
                  foreach ($data['slider_1'] as $slider):  ?>
              <li>
                  <img <?php if($slider->getId_item() != 0): ?>onclick="window.open('<?php echo $this->base_url.'Home/viewProduto/'.$slider->getId_item();?>');"<?php endif; ?> style="cursor: pointer" src="<?php echo $slider->getImagem();?>">
              </li>
              <?php endforeach; endif;?>
        </ul>
    </div>

<!-- MAIN CONTENT SECTION -->
<section class="mainContent clearfix" style="padding-bottom: 10px !important;">
  <div class="container">

    <?php if (count($data['prod-selec'])>3): ?>
      <!-- DEAL SECTION -->
    <div class="page-header text-uppercase">
      <h4 class="text-uppercase fonte-e-cor-top">Produtos Selecionados</h4>
    </div>

    <div class="row dealSlider dealSection">

    <?php foreach($data['prod-selec'] as $selecionado):?>
      <div class="slide col-md-4">
        <div class="imageBox">
          <div class="productDeal clearfix">
              <h3><span><?php echo $data['selec-grupo'.$selecionado->getId_item()]; ?></span></h3>
          </div>
          <div class="productImage clearfix">
            <a href="<?php echo $this->base_url."Home/viewProduto/".$selecionado->getId_item();?>"><img src="<?php echo $selecionado->getImagem(); ?>" alt="Product Image"></a>
          </div>
          <div class="productCaption clearfix text-center">
            <h3><a href="<?php echo $this->base_url."Home/viewProduto/".$selecionado->getId_item();?>"><?php echo $data['selec-nome'.$selecionado->getId_item()]; ?></a></h3>
            <span class="offer-price" style="margin-bottom: 15px;">R$<?php echo number_format((float)$data['preco-selec'.$selecionado->getId_item()], 2); ?></span>
            <a href="<?php echo $this->base_url."Home/viewProduto/".$selecionado->getId_item();?>" class="btn btn-border btn-selec">Comprar<i class="fa fa-angle-right" aria-hidden="true"></i></a>
          </div>
        </div>
      </div>
        <?php endforeach;?></div><?php endif;?>


    

<?php if (count($data['prod-destaq'])>3): ?>
    <div class="page-header text-uppercase">
      <h4 class="text-uppercase fonte-e-cor-top">Destaques</h4>
    </div>
    <div class="row featuredProducts featuredProductsSlider margin-bottom mouse-grab">
      <?php foreach($data['prod-destaq'] as $destaque): ?>
          <div class="slide col-sm-6 col-md-3">
            <div class="productImage clearfix">
              <img src="<?php if($destaque->getImagem() != "") echo $destaque->getImagem(); else echo $this->base_url."view/images/produto-sem-imagem.gif"; ?>">
              <div class="productMasking" onclick="location.href='<?php echo $this->base_url; ?>Home/viewProduto/<?php echo $destaque->getId_item(); ?>';" style="cursor: pointer; background-color: inherit !important;">
              </div>
            </div>
            <div class="productCaption clearfix">
              <a href="<?php echo $this->base_url; ?>Home/viewProduto/<?php echo $destaque->getId_item(); ?>">
                <h4><?php echo $data['nome'.$destaque->getId_item()]; ?></h4>
                <h3 class="fonte-e-cor-top" style="font-size: 15px; margin-bottom: 5px;"><?php echo $data['marca_dstq'.$destaque->getId_item()]; ?></h3>
              </a>
            </div>
          </div>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>



    <div class="container">
      <div class="row justify-content-md-end">
        <div class="col-sm-12 ml-auto bannercontainer ">
               <div class="slider fullscreen">
                   <ul class="slides" style="height: 45vw;">
                          <?php if($data['slider_2']):
                            foreach ($data['slider_2'] as $slider):  ?>
                            <li>
                                <img <?php if($slider->getId_item() != 0): ?>onclick="window.open('<?php echo $this->base_url.'Home/viewProduto/'.$slider->getId_item();?>');"<?php endif; ?> style="cursor: pointer" src="<?php echo $slider->getImagem();?>">
                            </li>
                          <?php endforeach; endif;?>
                    </ul>
                </div>
            </div>
      </div>
    </div>



    <script>
    function linkSlider(id) {
        window.location.href=<?php echo $this->base_url; ?>+'Loja/view/'+id;
    };
    </script>

    <style type="text/css" scoped>
    .tparrows {
	display: none !important;
    }
    @media (max-width: 500px) {
        .sub-selec{
            height: <?php $count = count($data['ids-selec']); echo (46*$count)+10*$count; ?>vw !important;
        }
        .sub-slide{
            height: 46vw  !important;
        }
        .sub-img{
            height: 46vw  !important;
        }
    }
    
    </style>

    <?php if (count($data['ids-selec'])>0): ?>
     <!-- FEATURE COLLECTION SECTION -->
          <div class="row featuredCollection version2 version3 sub-selec" style='padding: 15px; padding-top: 80px;'>
            <?php foreach ($data['subgrupo-selec'] as $selecionado):
             if(!in_array($selecionado->getId_selecionado(), $data['ids-selec'])) continue;
            ?>
              <div class="col-md-6 col-12" style="padding-bottom: 30px">
                  <div class="slide sub-slide">
                    <div class="productImage productImage1 sub-img"
                         style="
                                background-size: cover;
                                background-position: unset;
                                height: 22vw;
                                background-image: url(<?php echo $selecionado->getImagem();?>) !important;
                         "
                         >
                    </div>
                    <div class="productCaption clearfix text-right">
                      <h3><a style="font-family: GothicBold; color: white;" href="<?php echo $this->base_url.'Loja/view/'.$selecionado->getId_subgrupo(); ?>"><?php echo $data['nome-sub-selec'.$selecionado->getId_selecionado()]; ?></a></h3>
                      <a href="<?php echo $this->base_url.'Loja/view/'.$selecionado->getId_subgrupo(); ?>" class="btn btn-primary-outlined" style="font-family: GothicBold">Comprar</a>
                    </div>
                  </div>
                </div>
            <?php endforeach;?>
          </div>
    <?php endif; ?>
    
  </div>
</section>


<!-- LIGHT SECTION -->
<section class="lightSection clearfix mouse-grab botao-insta" style='filter:grayscale(100%);'>
  <div class="container">
    <div class="owl-carousel partnersLogoSlider">
      <?php foreach ($data['marcaslider'] as $marca) :
        if($marca->getSlider() == 0): continue; else:
      ?>
      <div class="slide">
        <div class="partnersLogo clearfix">
          <img src="<?php echo $marca->getImagem(); ?>" height="60px" alt="partner-img">
        </div>
      </div>
    <?php endif; endforeach; ?>
    </div>
  </div>
</section>
