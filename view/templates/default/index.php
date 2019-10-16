<!-- BANNER -->
<div class="bannercontainer bannerV1 mouse-grab" style="overflow:hidden">
  <div class="fullscreenbanner-container">
    <div class="fullscreenbanner">
      <ul>
        <li data-transition="slidehorizontal" data-slotamount="5" data-masterspeed="700" data-title="Slide 1">
          <img src="<?php echo $this->asset ?>img/home/banner-slider/slider-bg.jpg" alt="slidebg1" data-bgfit="cover" data-bgposition="center center" data-bgrepeat="no-repeat">
          <div class="slider-caption slider-captionV1 container">

            <div class="tp-caption rs-caption-1 sft start"
              data-hoffset="0"
              data-x="700"
              data-y="0"
              data-speed="800"
              data-start="1500"
              data-easing="Back.easeInOut"
              data-endspeed="300" >
              <img src="<?php echo $this->asset ?>img/logo-dental-square.png" alt="slider-image img-fluid" class="img-slider" style=" height: auto; width: 70%; margin-top: 100px;">
            </div>

            <div class="tp-caption rs-caption-2 sft fonte-e-cor-top"
              data-hoffset="0"
              data-y="100"
              data-x="[15,15,42,15]"
              data-speed="800"
              data-start="2000"
              data-easing="Back.easeInOut"
              data-endspeed="300">
              Dental Livramento<!--sempre que quiser, adiciona a class "fonte-e-cor-top"-->
            </div>

            <div class="tp-caption rs-caption-3 sft"
              data-hoffset="0"
              data-y="175"
              data-x="[15,15,42,15]"
              data-speed="1000"
              data-start="3000"
              data-easing="Power4.easeOut"
              data-endspeed="300"
              data-endeasing="Power1.easeIn"
              data-captionhidden="off">
              <small>Os melhores produtos da fornteira você encontra aqui.<br>Conheça nossa Loja Virtual, agora com mais facilidades, ainda mais perto de você! </small>
            </div>
          </div>
        </li>
        <?php $i = 0; ?>
        <?php foreach ($data['slider'] as $slider): ?>
            <li data-transition="slidehorizontal" data-slotamount="5" data-masterspeed="700"  data-title="Slide 2">
            <img src="<?php if($slider->getFundo() != '') echo $slider->getFundo(); else echo $this->asset."img/home/banner-slider/slider-bg.jpg"; ?>" alt="slidebg" data-bgfit="cover" data-bgposition="center center" data-bgrepeat="no-repeat">
            <div class="slider-caption slider-captionV1 container">
              <div class="tp-caption rs-caption-1 sft start"
                data-hoffset="0"
                data-y="0"
                data-x="[15,15,42,15]"
                data-speed="800"
                data-start="1500"
                data-easing="Back.easeInOut"
                data-endspeed="300">
              </div>

              <div class="tp-caption rs-caption-2 sft "
                data-hoffset="0"
                data-y="100"
                data-x="100"
                data-speed="800"
                data-start="2000"
                data-easing="Back.easeInOut"
                data-endspeed="300">
                <?php echo $data['nome'.$slider->getId_slider()]; ?>
              </div>

              <div class="tp-caption rs-caption-3 sft"
                data-hoffset="0"
                data-y="175"
                data-x="100"
                data-speed="1000"
                data-start="3000"
                data-easing="Power4.easeOut"
                data-endspeed="300"
                data-endeasing="Power1.easeIn"
                data-captionhidden="off">
                <b>A partir de - R$<?php echo number_format((float)$data['preco_min'.$slider->getId_slider()], 2);?></b> <br>
                <small><?php echo substr($data['descricao'.$slider->getId_slider()],0,150); if(strlen($data['descricao'.$slider->getId_slider()])>=150) echo "..."; ?></small><br>
              </div>

              <div class="tp-caption rs-caption-4 sft"
                data-hoffset="0"
                data-y="310"
                data-x="100"
                data-speed="800"
                data-start="3500"
                data-easing="Power4.easeOut"
                data-endspeed="300"
                data-endeasing="Power1.easeIn"
                data-captionhidden="off">
                <span class="page-scroll"><a href="<?php echo $this->base_url; ?>Home/viewProduto/<?php echo $data['id_sub'.$slider->getId_slider()]; ?>" class="btn primary-btn">Comprar<i class="fa fa-chevron-right"></i></a></span>
              </div>
            </div>
          </li>
        <?php endforeach; ?>
      </ul>
    </div>
  </div>
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
          <div class="slide col-md-3">
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
    
    <!-- BANNER -->
    <?php if(!empty($data['destaque'])): ?>
    <div class="container">
      <div class="row justify-content-md-end">
        <div class="col-sm-12 ml-auto bannercontainer ">
          <div class="fullscreenbanner-container bannerV4">
            <div class="fullscreenbanner">
              <ul>
                <?php
                $num = count($data['destaque']);
                $i = 1;
                foreach ($data['destaque'] as $destaque):
                 foreach ($data['grupo'] as $grupo):
                    if($destaque->getId_grupo() == $grupo->getId_grupo()):?>
                      <li data-transition='slidehorizontal' data-slotamount='5' data-masterspeed='700' data-title='Slide <?php echo $i; ?>' id="<?php echo $i; ?>" onclick='linkSlider(<?php echo $destaque->getId_grupo(); ?>)' data-plugin-options='{"gridwidth": 500, "gridheight": 500, "navigation": { "arrows": { "enable": false } }}' style="cursor: pointer;" >

                        <img src='<?php echo $destaque->getImagem(); ?>' alt='slidebg1' data-bgfit='cover' data-bgposition='center center' data-bgrepeat='no-repeat'>
                        <div class='slider-caption slider-captionV4'>
                          <div  class='tp-caption rs-caption-2 sft'
                            data-hoffset='0'
                            data-x='85'
                            data-y='115'
                            data-speed='800'
                            data-start='2000'
                            data-easing='Back.easeInOut'
                            data-endspeed='300'>
                          </div> <div class="tp-caption rs-caption-3 sft"
                            data-hoffset="0"
                            data-x="85"
                            data-y="240"
                            data-speed="1000"
                            data-start="3000"
                            data-easing="Power4.easeOut"
                            data-endspeed="300"
                            data-endeasing="Power1.easeIn"
                            data-captionhidden="off">
                          </div>
                          <div class="tp-caption rs-caption-4 sft"
                            data-hoffset="0"
                            data-x="85"
                            data-y="300"
                            data-speed="800"
                            data-start="3500"
                            data-easing="Power4.easeOut"
                            data-endspeed="300"
                            data-endeasing="Power1.easeIn"
                            data-captionhidden="off">
                          </div>
                        </div>

                      </li>
                      <?php
                      $i++;
                    endif;
                   endforeach;
                  endforeach;?>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php endif;?>

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
              	  <a href="https://www.instagram.com/dentallivramento/" target="_blank"><button type="button" class="btn btn-primary btn-rounded btn-lg"><i class="fa fa-instagram"></i>&nbspVISITE NOSSO INSTAGRAM</button></a>
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
<section class="lightSection clearfix mouse-grab" style='filter:grayscale(100%);'>
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
