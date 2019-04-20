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
              <img src="<?php echo $this->asset ?>img/home/banner-slider/DentalLivramentoLogo.png" alt="slider-image img-fluid" style=" height: auto; margin-top: 10px;">
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
              <small>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque convallis turpis pharetra pretium nec eu sem.</small>
            </div>
            <!--<div class="tp-caption rs-caption-4 sft"
              data-hoffset="0"
              data-y="310"
              data-x="[15,15,42,15]"
              data-speed="800"
              data-start="3500"
              data-easing="Power4.easeOut"
              data-endspeed="300"
              data-endeasing="Power1.easeIn"
              data-captionhidden="off">
              <span class="page-scroll"><a href="#" class="btn primary-btn">Buy Now<i class="fa fa-chevron-right"></i></a></span>
            </div>-->
          </div>
        </li>
        <?php $i = 0; ?>
        <?php foreach ($data['slider'] as $slider): ?>
          <?php ++$i; ?>
          <?php if($i % 2 != 0): ?>
            <li data-transition="slidehorizontal" data-slotamount="5" data-masterspeed="700"  data-title="Slide 2">
            <img src="<?php echo $slider[0]->getFundo() == null || $slider[0]->getFundo() == ''? $this->asset."img/home/banner-slider/slider-bg0.jpg" : $slider[0]->getFundo() ; ?>" alt="slidebg" data-bgfit="cover" data-bgposition="center center" data-bgrepeat="no-repeat">
            <div class="slider-caption slider-captionV1 container">
              <div class="tp-caption rs-caption-1 sft start"
                data-hoffset="0"
                data-y="0"
                data-x="[15,15,42,15]"
                data-speed="800"
                data-start="1500"
                data-easing="Back.easeInOut"
                data-endspeed="300">
                <img src="<?php echo $slider[0]->getImagem() == null ? "" : $slider[0]->getImagem() ; ?>" alt="slider-image">
              </div>

              <div class="tp-caption rs-caption-2 sft "
                data-hoffset="0"
                data-y="100"
                data-x="600"
                data-speed="800"
                data-start="2000"
                data-easing="Back.easeInOut"
                data-endspeed="300">
                <?php echo $slider[1]->getNome() ; ?>
              </div>

              <div class="tp-caption rs-caption-3 sft"
                data-hoffset="0"
                data-y="175"
                data-x="600"
                data-speed="1000"
                data-start="3000"
                data-easing="Power4.easeOut"
                data-endspeed="300"
                data-endeasing="Power1.easeIn"
                data-captionhidden="off">
                Start From - $259.00 <br>
                <small><?php echo substr($slider[1]->getDescricao(),0,150); if(strlen($slider[1]->getDescricao())>=150) echo "..."; ?></small><br>
              </div>

              <div class="tp-caption rs-caption-4 sft"
                data-hoffset="0"
                data-y="310"
                data-x="600"
                data-speed="800"
                data-start="3500"
                data-easing="Power4.easeOut"
                data-endspeed="300"
                data-endeasing="Power1.easeIn"
                data-captionhidden="off">
                <span class="page-scroll"><a href="<?php echo $this->base_url; ?>viewSub/<?php echo $slider[1]->getId_subgrupo() ; ?>" class="btn primary-btn">Comprar<i class="fa fa-chevron-right"></i></a></span>
              </div>
            </div>
          </li>
          <?php elseif ($i % 2 == 0): ?>
            <li data-transition="slidehorizontal" data-slotamount="5" data-masterspeed="700" data-title="Slide 3">
            <img src="<?php echo $slider[0]->getFundo() == null || $slider[0]->getFundo() == ''? $this->asset."img/home/banner-slider/slider-bg0.jpg" : $slider[0]->getFundo() ; ?>" alt="slidebg1" data-bgfit="cover" data-bgposition="center center" data-bgrepeat="no-repeat">
            <div class="slider-caption slider-captionV1 container">

              <div class="tp-caption rs-caption-1 sft start"
                data-hoffset="0"
                data-x="450"
                data-y="54"
                data-speed="800"
                data-start="1500"
                data-easing="Back.easeInOut"
                data-endspeed="300" >
                <img src="<?php echo $slider[0]->getImagem() == null ? "" : $slider[0]->getImagem() ; ?>" alt="slider-image" style="width: 781px; height: 416px;">
              </div>

              <div class="tp-caption rs-caption-2 sft"
                data-hoffset="0"
                data-y="100"
                data-x="[15,15,42,15]"
                data-speed="800"
                data-start="2000"
                data-easing="Back.easeInOut"
                data-endspeed="300">
                <?php echo $slider[1]->getNome() ; ?>
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
                Start From - $259.00 <br>
                <small><?php echo substr($slider[1]->getDescricao(),0,150); if(strlen($slider[1]->getDescricao())>=150) echo "..."; ?></small>
              </div>
              <div class="tp-caption rs-caption-4 sft"
                data-hoffset="0"
                data-y="310"
                data-x="[15,15,42,15]"
                data-speed="800"
                data-start="3500"
                data-easing="Power4.easeOut"
                data-endspeed="300"
                data-endeasing="Power1.easeIn"
                data-captionhidden="off">
                <span class="page-scroll"><a href="<?php echo $this->base_url; ?>viewSub/<?php echo $slider[1]->getId_subgrupo() ; ?>" class="btn primary-btn">Comprar<i class="fa fa-chevron-right"></i></a></span>
              </div>
            </div>
          </li>
          <?php endif;?>
        <?php endforeach; ?>
      </ul>
    </div>
  </div>
</div>

<!-- CONTENT SECTION -->
<section class="content clearfix">
  <div class="container">

    <!-- FEATURE COLLECTION SECTION -->
    <div class="row featuredCollection version2 version3">
      <div class="col-md-6 col-12">
        <div class="slide">
          <div class="productImage productImage1">
          </div>
          <div class="productCaption clearfix text-right">
            <h3><a href="single-product.html">women’s Shoes</a></h3>
            <p>Lorem ipsum dolor sit ameit</p>
            <a href="single-product.html" class="btn btn-border">Shop Now</a>
          </div>
        </div>
      </div>
      <div class="col-md-6 col-12">
        <div class="slide">
          <div class="productImage productImage2">
          </div>
          <div class="productCaption clearfix text-right">
            <h3><a href="single-product.html">Headphone wifi</a></h3>
            <p>Lorem ipsum dolor sit ameit</p>
            <a href="single-product.html" class="btn btn-border">Shop Now</a>
          </div>
        </div>
      </div>
    </div>

    <!-- CATEGORY SECTION -->
    <div class="categorySection">
      <div class="row">
        <div class="col-md-6 col-12">
          <div class="category-content">
            <div class="category-top d-flex justify-content-between">
              <div class="category-menu text-center">
                <h2 class="category-title">Men’s Clothing</h2>
                <ul>
                  <li><a href="product-grid-left-sidebar.html">Down Jackets</a></li>
                  <li><a href="product-grid-left-sidebar.html">T Shirts</a></li>
                  <li><a href="product-grid-left-sidebar.html">Jeans</a></li>
                  <li><a href="product-grid-left-sidebar.html">Casual Pants</a></li>
                  <li><a href="product-grid-left-sidebar.html">Sunglasses</a></li>
                  <li><a href="product-grid-left-sidebar.html">Hoodies</a></li>
                </ul>
              </div>
              <div class="category-Slider">
                <div class="categorySlider">
                  <div class="item">
                    <img src="<?php echo $this->asset ?>img/home/category/category-img3.jpg" alt="Image">
                  </div>
                  <div class="item">
                    <img src="<?php echo $this->asset ?>img/home/category/category-img3.jpg" alt="Image">
                  </div>
                </div>
              </div>
            </div>

            <div class="category-bottom d-md-flex justify-content-md-between">
              <div class="imageBox">
                <div class="productImage clearfix">
                  <a href="single-product.html">
                    <img src="<?php echo $this->asset ?>img/home/category/category-img6.jpg" alt="Image">
                  </a>
                  <div class="productMasking">
                    <ul class="list-inline btn-group" role="group">
                      <li><a class="btn btn-default btn-wishlist"><i class="fa fa-heart-o"></i></a></li>
                      <li><a href="javascript:void(0)" class="btn btn-default" data-toast data-toast-type="success" data-toast-position="topRight" data-toast-icon="icon-circle-check" data-toast-title="Product" data-toast-message="successfuly added to cart!"><i class="fa fa-shopping-basket"></i></a></li>
                      <li><a data-toggle="modal" href=".quick-view" class="btn btn-default"><i class="fa fa-eye"></i></a></li>
                    </ul>
                  </div>
                </div>
                <div class="productCaption clearfix">
                  <h5><a href="single-product.html">Nike Sportswear</a></h5>
                  <h3>$199</h3>
                </div>
              </div>
              <div class="imageBox">
                <div class="productImage clearfix">
                  <a href="single-product.html">
                    <img src="<?php echo $this->asset ?>img/home/category/category-img7.jpg" alt="Image">
                  </a>
                  <span class="sticker">50% off</span>
                  <div class="productMasking">
                    <ul class="list-inline btn-group" role="group">
                      <li><a class="btn btn-default btn-wishlist"><i class="fa fa-heart-o"></i></a></li>
                      <li><a href="javascript:void(0)" class="btn btn-default" data-toast data-toast-type="success" data-toast-position="topRight" data-toast-icon="icon-circle-check" data-toast-title="Product" data-toast-message="successfuly added to cart!"><i class="fa fa-shopping-basket"></i></a></li>
                      <li><a data-toggle="modal" href=".quick-view" class="btn btn-default"><i class="fa fa-eye"></i></a></li>
                    </ul>
                  </div>
                </div>
                <div class="productCaption clearfix">
                  <h5><a href="single-product.html">Nike Sportswear</a></h5>
                  <h3>$199</h3>
                </div>
              </div>
              <div class="imageBox">
                <div class="productImage clearfix">
                  <a href="single-product.html">
                    <img src="<?php echo $this->asset ?>img/home/category/category-img8.jpg" alt="Image">
                  </a>
                  <div class="productMasking">
                    <ul class="list-inline btn-group" role="group">
                      <li><a class="btn btn-default btn-wishlist"><i class="fa fa-heart-o"></i></a></li>
                      <li><a href="javascript:void(0)" class="btn btn-default" data-toast data-toast-type="success" data-toast-position="topRight" data-toast-icon="icon-circle-check" data-toast-title="Product" data-toast-message="successfuly added to cart!"><i class="fa fa-shopping-basket"></i></a></li>
                      <li><a data-toggle="modal" href=".quick-view" class="btn btn-default"><i class="fa fa-eye"></i></a></li>
                    </ul>
                  </div>
                </div>
                <div class="productCaption clearfix">
                  <h5><a href="single-product.html">Nike Sportswear</a></h5>
                  <h3>$199</h3>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-6 col-12">
          <div class="category-content">
            <div class="category-top d-flex justify-content-between">
              <div class="category-menu text-center">
                <h2 class="category-title">woMen’s Clothing</h2>
                <ul>
                  <li><a href="product-grid-left-sidebar.html">Casual Dresses</a></li>
                  <li><a href="product-grid-left-sidebar.html">Sweaters</a></li>
                  <li><a href="product-grid-left-sidebar.html">Coats & Jackets</a></li>
                  <li><a href="product-grid-left-sidebar.html">Cosmetic</a></li>
                  <li><a href="product-grid-left-sidebar.html">T Shirts</a></li>
                  <li><a href="product-grid-left-sidebar.html">Shoes</a></li>
                </ul>
              </div>
              <div class="category-Slider">
                <div class="categorySlider">
                  <div class="item">
                    <img src="<?php echo $this->asset ?>img/home/category/category-img2.jpg" alt="Image">
                  </div>
                  <div class="item">
                    <img src="<?php echo $this->asset ?>img/home/category/category-img2.jpg" alt="Image">
                  </div>
                </div>
              </div>
            </div>

            <div class="category-bottom d-md-flex justify-content-md-between">
              <div class="imageBox">
                <div class="productImage clearfix">
                  <a href="single-product.html">
                    <img src="<?php echo $this->asset ?>img/home/category/category-img9.jpg" alt="Image">
                  </a>
                  <span class="sticker">50% off</span>
                  <div class="productMasking">
                    <ul class="list-inline btn-group" role="group">
                      <li><a class="btn btn-default btn-wishlist"><i class="fa fa-heart-o"></i></a></li>
                      <li><a href="javascript:void(0)" class="btn btn-default" data-toast data-toast-type="success" data-toast-position="topRight" data-toast-icon="icon-circle-check" data-toast-title="Product" data-toast-message="successfuly added to cart!"><i class="fa fa-shopping-basket"></i></a></li>
                      <li><a data-toggle="modal" href=".quick-view" class="btn btn-default"><i class="fa fa-eye"></i></a></li>
                    </ul>
                  </div>
                </div>
                <div class="productCaption clearfix">
                  <h5><a href="single-product.html">Nike Sportswear</a></h5>
                  <h3>$199</h3>
                </div>
              </div>
              <div class="imageBox">
                <div class="productImage clearfix">
                  <a href="single-product.html">
                    <img src="<?php echo $this->asset ?>img/home/category/category-img10.jpg" alt="Image">
                  </a>
                  <div class="productMasking">
                    <ul class="list-inline btn-group" role="group">
                      <li><a class="btn btn-default btn-wishlist"><i class="fa fa-heart-o"></i></a></li>
                      <li><a href="javascript:void(0)" class="btn btn-default" data-toast data-toast-type="success" data-toast-position="topRight" data-toast-icon="icon-circle-check" data-toast-title="Product" data-toast-message="successfuly added to cart!"><i class="fa fa-shopping-basket"></i></a></li>
                      <li><a data-toggle="modal" href=".quick-view" class="btn btn-default"><i class="fa fa-eye"></i></a></li>
                    </ul>
                  </div>
                </div>
                <div class="productCaption clearfix">
                  <h5><a href="single-product.html">Nike Sportswear</a></h5>
                  <h3>$199</h3>
                </div>
              </div>
              <div class="imageBox">
                <div class="productImage clearfix">
                  <a href="single-product.html">
                    <img src="<?php echo $this->asset ?>img/home/category/category-img11.jpg" alt="Image">
                  </a>
                  <div class="productMasking">
                    <ul class="list-inline btn-group" role="group">
                      <li><a class="btn btn-default btn-wishlist"><i class="fa fa-heart-o"></i></a></li>
                      <li><a href="javascript:void(0)" class="btn btn-default" data-toast data-toast-type="success" data-toast-position="topRight" data-toast-icon="icon-circle-check" data-toast-title="Product" data-toast-message="successfuly added to cart!"><i class="fa fa-shopping-basket"></i></a></li>
                      <li><a data-toggle="modal" href=".quick-view" class="btn btn-default"><i class="fa fa-eye"></i></a></li>
                    </ul>
                  </div>
                </div>
                <div class="productCaption clearfix">
                  <h5><a href="single-product.html">Nike Sportswear</a></h5>
                  <h3>$199</h3>
                </div>
              </div>
            </div>
          </div>
        </div>



      </div>
    </div>

  </div>
</section>

<!-- MAIN CONTENT SECTION -->
<section class="mainContent clearfix">
  <div class="container">

    <div class="page-header text-uppercase">
      <h4 class="text-uppercase fonte-e-cor-top">Destaques</h4>
    </div>

    <div class="row featuredProducts featuredProductsSlider margin-bottom mouse-grab">
      <?php foreach($data['prod-destaq'] as $destaque): ?>
          <div class="slide col-md-3">
            <div class="productImage clearfix">
              <img src="<?php echo $destaque->getImagem(); ?>">
              <div class="productMasking">
                <ul class="list-inline btn-group" role="group">
                  <li><a href="<?php echo $this->base_url; ?>Home/viewProduto/<?php echo $destaque->getId_subgrupo(); ?>" class="btn btn-lg" style="font-size: 20px;"><i class="fa fa-eye"></i></a></li>
                </ul>
              </div>
            </div>
            <div class="productCaption clearfix">
              <a href="<?php echo $this->base_url; ?>Home/viewProduto/<?php echo $destaque->getId_subgrupo(); ?>">
                <h4><?php echo $destaque->getNome(); ?></h4>
              </a>
            </div>
          </div>
      <?php endforeach; ?>
    </div>

    <script>
    function linkSlider(id) {
        window.location.href=<?php echo $this->base_url; ?>+'Home/viewCategoria/'+id;
    };
    </script>
    <!-- BANNER -->
    <div class="container">
      <div class="row justify-content-md-end">
        <div class="col-sm-12 ml-auto bannercontainer ">
          <div class="fullscreenbanner-container bannerV4">
            <div class="fullscreenbanner">
              <ul>
                <?php foreach ($data['destaque'] as $destaque):
                 foreach ($data['categoria'] as $categoria):
                    if($destaque->getId_categoria() == $categoria->getId_categoria()){
                      echo "
                      <li data-transition='slidehorizontal' data-slotamount='5 data-masterspeed='700' data-title='Slide 1' onclick='linkSlider(".$destaque->getId_categoria().")' >

                        <img src='".$destaque->getImagem()."' alt='slidebg1' data-bgfit='cover' data-bgposition='center center' data-bgrepeat='no-repeat'>
                        <div class='slider-caption slider-captionV4'>
                          <div  class='tp-caption rs-caption-2 sft'
                            data-hoffset='0'
                            data-x='85'
                            data-y='115'
                            data-speed='800'
                            data-start='2000'
                            data-easing='Back.easeInOut'
                            data-endspeed='300'>
                            <small>Destaque</small><br>
                            <span style='text-shadow: 2px 2px rgba(255,255,255,0.8);'>".$destaque->getNome()."</span>
                          </div>
                        </div>

                      </li>";
                    } endforeach;
                  endforeach;?>

              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!--<div class="page-header">
      <h4>Latest Articles</h4>
    </div>
    <div class="row latestArticles">
      <div class="col-md-4">
        <div class="thumbnail">
          <a href="<?php //echo $this->asset ?>blog-single-right-sidebar.html">
            <img src="<?php //echo $this->asset ?>img/home/articles/articles-01.jpg" alt="article-image">
          </a>
          <div class="date-holder">
            <p>08</p>
            <span>NOV</span>
          </div>
          <h5><a href="<?php //echo $this->asset ?>blog-single-right-sidebar.html">Leo Vitae Nibh Malesuada.</a></h5>
          <span class="meta"> by <a class="pr-1" href="#">Abdus</a> / <a class="pl-1" href="<?php //echo $this->asset ?>blog-single-right-sidebar.html">5 Comments</a></span>
          <div class="caption">
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque convallis nulla sed turpis pharetra pretium nec eu sem.</p>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="thumbnail">
          <a href="<?php //echo $this->asset ?>blog-single-right-sidebar.html">
            <img src="<?php //echo $this->asset ?>img/home/articles/articles-02.jpg" alt="article-image">
          </a>
          <div class="date-holder">
            <p>29</p>
            <span>OCT</span>
          </div>
          <h5><a href="<?php //echo $this->asset ?>blog-single-right-sidebar.html">Malesuada Pulvinar Quis Fring.</a></h5>
          <span class="meta"> by <a class="pr-1" href="#">Abdus</a> / <a class="pl-1" href="<?php //echo $this->asset ?>blog-single-right-sidebar.html">4 Comments</a></span>
          <div class="caption">
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque convallis nulla sed turpis pharetra pretium nec eu sem.</p>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="thumbnail">
          <a href="blog-single-right-sidebar.html">
            <img src="<?php //echo $this->asset ?>img/home/articles/articles-03.jpg" alt="article-image">
          </a>
          <div class="date-holder">
            <p>15</p>
            <span>Sep</span>
          </div>
          <h5><a href="<?php //echo $this->asset ?>blog-single-right-sidebar.html">Proin Lectus Sed Tincidunt Auctor.</a></h5>
          <span class="meta"> by <a class="pr-1" href="#">Abdus</a> / <a class="pl-1" href="<?php //echo $this->asset ?>blog-single-right-sidebar.html">3 Comments</a></span>
          <div class="caption">
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque convallis nulla sed turpis pharetra pretium nec eu sem.</p>
          </div>
        </div>
      </div>
    </div>-->
  </div>
</section>

<!-- LIGHT SECTION -->
<section class="lightSection clearfix mouse-grab" style='filter:grayscale(100%);'>
  <div class="container">
    <div class="owl-carousel partnersLogoSlider">
      <?php foreach ($data['marca'] as $marca) :?>
      <div class="slide">
        <div class="partnersLogo clearfix">
          <img src="<?php echo $marca->getImagem(); ?>" height="60px" alt="partner-img">
        </div>
      </div>
    <?php endforeach; ?>
    </div>
  </div>
</section>
