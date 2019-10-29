
<div id="mySidenav" class="sidenav">
  <a href="#" id="about"><img width="40" src="https://www.freepnglogos.com/uploads/whatsapp-logo-app-png-4.png"></a>
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
              <li>
                <img src="<?php echo $this->asset;?>img/slider-1.jpeg">
              </li>
              <?php if($data['slider_1']):
                  foreach ($data['slider_1'] as $slider):  ?>
              <li>
                  <img onclick="window.open('<?php echo $this->base_url.'Home/viewProduto/'.$slider->getId_item();?>');" style="cursor: pointer" src="<?php echo $slider->getImagem();?>">
              </li>
              <?php endforeach; endif;?>
        </ul>
    </div>

<!-- MAIN CONTENT SECTION -->
<section class="mainContent clearfix">
  <div class="container">

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
                   <ul class="slides" style="height: 35vw;">
                          <li>
                            <img src="<?php echo $this->asset;?>img/slider-1.jpeg">
                          </li>
                          <?php if($data['slider_2']):
                            foreach ($data['slider_2'] as $slider):  ?>
                            <li>
                                <img onclick="window.open('<?php echo $this->base_url.'Home/viewProduto/'.$slider->getId_item();?>');" style="cursor: pointer" src="<?php echo $slider->getImagem();?>">
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
    </style>

    <div class="container">
      <div class="row justify-content-md-end">
        <div class="col-sm-12 ml-auto bannercontainer ">
          <div class="fullscreenbanner-container bannerV4">
            <div class="fullscreenbanner">
                <ul>

                  <script src="https://cdn.lightwidget.com/widgets/lightwidget.js"></script><iframe src="//lightwidget.com/widgets/a3e97b3bbf3a521886bd4b709841ca34.html" scrolling="no" allowtransparency="true" class="lightwidget-widget" style="width:100%;border:0;overflow:hidden;"></iframe>
                   <!-- <script src="https://cdn.lightwidget.com/widgets/lightwidget.js"></script><iframe src="//lightwidget.com/widgets/9dd0a7f3fb2458b1baa16527e4c4e5fe.html" scrolling="no" allowtransparency="true" class="lightwidget-widget" style="width:100%;border:0;overflow:hidden;"></iframe> -->

                </ul>
              <ul>
                <br>
                <center>
                <div class="btn-group" role="group" aria-label="Basic example">
              	  <a href="https://www.instagram.com/dentallivramento/" target="_blank">
                      <button type="button" class="btn btn-primary btn-rounded btn-lg"><i class="fa fa-instagram"></i>&nbspVISITE NOSSO INSTAGRAM</button>
                  </a>
              	</div>
                </center>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
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
