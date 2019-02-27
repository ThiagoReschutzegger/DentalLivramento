<!-- LIGHT SECTION -->
      <!--<section class="lightSection clearfix pageHeader">
        <div class="container">
          <div class="row">
            <div class="col-md-6">
              <div class="page-title">
                <h2>Single Product</h2>
              </div>
            </div>
            <div class="col-md-6">
              <ol class="breadcrumb pull-right">
                <li>
                  <a href="index.html">Home</a>
                </li>
                <li class="active">Single Product</li>
              </ol>
            </div>
          </div>
        </div>
      </section>-->

      <!-- MAIN CONTENT SECTION -->
      <section class="mainContent clearfix">
        <div class="container">
          <div class="row singleProduct">
            <div class="col-md-12">
              <div class="media flex-wrap">
                <div class="media-left productSlider">
                  <div id="carousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                      <div class="carousel-item active" data-thumb="0">
                          <img src="<?php echo $data->getImagem(); ?>">
                      </div>
                      <!--<div class="carousel-item" data-thumb="1">
                        <img src="<?php //echo $this->asset; ?>img/products/signle-product/product-slide-big-02.jpg">
                      </div>
                      <div class="carousel-item" data-thumb="2">
                        <img src="<?php //echo $this->asset; ?>img/products/signle-product/product-slide-big-03.jpg">
                      </div>
                      <div class="carousel-item" data-thumb="3">
                        <img src="<?php //echo $this->asset; ?>img/products/signle-product/product-slide-big-04.jpg">
                      </div>-->
                    </div>
                  </div>
                  <!--<div class="clearfix">
                    <div id="thumbcarousel" class="carousel slide" data-interval="false">
                      <div class="carousel-inner">
                          <div data-target="#carousel" data-slide-to="0" class="thumb"><img src="<?php //echo $this->asset; ?>img/products/signle-product/product-slide-small-01.jpg"></div>
                          <div data-target="#carousel" data-slide-to="1" class="thumb"><img src="<?php //echo $this->asset; ?>img/products/signle-product/product-slide-small-02.jpg"></div>
                          <div data-target="#carousel" data-slide-to="2" class="thumb"><img src="<?php //echo $this->asset; ?>img/products/signle-product/product-slide-small-03.jpg"></div>
                          <div data-target="#carousel" data-slide-to="3" class="thumb"><img src="<?php //echo $this->asset; ?>img/products/signle-product/product-slide-small-04.jpg"></div>
                      </div>
                      <a class="left carousel-control" href="#thumbcarousel" role="button" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left"></span>
                      </a>
                      <a class="right carousel-control" href="#thumbcarousel" role="button" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right"></span>
                      </a>
                    </div>
                  </div>-->
                </div>
                <div class="media-body">
                  <ul class="list-inline">
                      <li><a href="<?php echo $this->base_url; ?>Home"><i class="fa fa-reply" aria-hidden="true"></i>Continuar comprando</a></li>
                    <!--<li><a href="#"><i class="fa fa-plus" aria-hidden="true"></i>Share This</a></li>-->
                  </ul>
                  <h2><?php echo $data->getNome(); ?></h2>
                  <h3>R$ <?php echo $data->getPreco(); ?></h3>
                  <p><?php echo $data->getDescricao(); ?></p>
                  <span class="quick-drop">
                    <select name="guiest_id3" id="guiest_id3" class="select-drop">
                      <option value="0">Size</option>
                      <option value="1">Small</option>
                      <option value="2">Medium</option>
                      <option value="3">Big</option>
                    </select>
                    <br>
                    <br>
                    <br>
                    
                    <div class="form-group">
                      <input type="number" min='0' max="<?php echo $data->getEstoque(); ?>" class="form-control" id="exampleInputPhone" placeholder="Quantidade">
                    </div>
                  </span>
                  
                  <div class="btn-area">
                    <a href="cart-page.html" class="btn btn-primary btn-default">Add to cart <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                  </div>
                  <!--<div class="tabArea">
                    <ul class="nav nav-tabs bar-tabs">
                      <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#details">details</a></li>
                      <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#about-art">about art</a></li>
                      <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#sizing">sizing</a></li>
                      <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#shipping">shipping</a></li>
                    </ul>
                    <div class="tab-content">
                      <div id="details" class="tab-pane fade show active">
                        <p>LContrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin liter ature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia.</p>
                        <ul class="list-unstyled">
                          <li>Black, Crew Neck</li>
                          <li>75% Cotton, 25% Rayon</li>
                          <li>Waterbased Ink</li>
                          <li>Wash Cold, dry low</li>
                        </ul>
                      </div>
                      <div id="about-art" class="tab-pane fade">
                        <p>Nulla facilisi. Mauris efficitur, massa et iaculis accumsan, mauris velit ultrices purus, quis condimentum nibh dolor ut tortor. Donec egestas tortor quis mattis gravida. Ut efficitur elit vitae dignissim volutpat. </p>
                      </div>
                      <div id="sizing" class="tab-pane fade">
                        <p>Praesent dui felis, gravida a auctor at, facilisis commodo ipsum. Cras eu faucibus justo. Nullam varius cursus nisi, sed elementum sem sagittis at. Nulla tellus massa, vestibulum a commodo facilisis, pulvinar convallis nunc.</p>
                      </div>
                      <div id="shipping" class="tab-pane fade">
                        <p>Mauris lobortis augue ex, ut faucibus nisi mollis ac. Sed volutpat scelerisque ex ut ullamcorper. Cras at velit quis sapien dapibus laoreet a id odio. Sed sit amet accumsan ante, eu congue metus. Aenean eros tortor, cursus quis feugiat sed, vestibulum vel purus.</p>
                      </div>
                    </div>
                  </div>-->
                </div>
              </div>
            </div>
          </div>
          <div class="page-header">
            <h4 class="fonte-e-cor-top">Related Products</h4>
          </div>
          <div class="row productsContent">

            <div class="col-md-3 col-12 ">
              <div class="productBox">
                <div class="productImage clearfix">
                  <img src="<?php echo $this->asset; ?>img/products/products-01.jpg" alt="products-img">
                  <div class="productMasking">
                    <ul class="list-inline btn-group" role="group">
                      <li><a data-toggle="modal" href=".login-modal" class="btn btn-default"><i class="fa fa-heart-o"></i></a></li>
                      <li><a href="cart-page.html" class="btn btn-default"><i class="fa fa-shopping-basket"></i></a></li>
                      <li><a class="btn btn-default" data-toggle="modal" href=".quick-view" ><i class="fa fa-eye"></i></a></li>
                    </ul>
                  </div>
                </div>
                <div class="productCaption clearfix">
                 <h5>Nike Sportswear</h5>
                 <h3>$199</h3>
                </div>
              </div>
            </div>
            <div class="col-md-3 col-12 ">
              <div class="productBox">
                <div class="productImage clearfix">
                  <img src="<?php echo $this->asset; ?>img/products/products-02.jpg" alt="products-img">
                  <div class="productMasking">
                    <ul class="list-inline btn-group" role="group">
                      <li><a data-toggle="modal" href=".login-modal" class="btn btn-default"><i class="fa fa-heart-o"></i></a></li>
                      <li><a href="cart-page.html" class="btn btn-default"><i class="fa fa-shopping-basket"></i></a></li>
                      <li><a class="btn btn-default" data-toggle="modal" href=".quick-view" ><i class="fa fa-eye"></i></a></li>
                    </ul>
                  </div>
                </div>
                <div class="productCaption clearfix">
                 <h5>Dip Dyed Sweater</h5>
                 <h3>$249</h3>
                </div>
              </div>
            </div>
            <div class="col-md-3 col-12 ">
              <div class="productBox">
                <div class="productImage clearfix">
                  <img src="<?php echo $this->asset; ?>img/products/products-03.jpg" alt="products-img">
                  <div class="productMasking">
                    <ul class="list-inline btn-group" role="group">
                      <li><a data-toggle="modal" href=".login-modal" class="btn btn-default"><i class="fa fa-heart-o"></i></a></li>
                      <li><a href="cart-page.html" class="btn btn-default"><i class="fa fa-shopping-basket"></i></a></li>
                      <li><a class="btn btn-default" data-toggle="modal" href=".quick-view" ><i class="fa fa-eye"></i></a></li>
                    </ul>
                  </div>
                </div>
                <div class="productCaption clearfix">
                 <h5>Scarf Ring Corner</h5>
                 <h3>$179</h3>
                </div>
              </div>
            </div>
            <div class="col-md-3 col-12 ">
              <div class="productBox">
                <div class="productImage clearfix">
                  <img src="<?php echo $this->asset; ?>img/products/products-04.jpg" alt="products-img">
                  <div class="productMasking">
                    <ul class="list-inline btn-group" role="group">
                      <li><a data-toggle="modal" href=".login-modal" class="btn btn-default"><i class="fa fa-heart-o"></i></a></li>
                      <li><a href="cart-page.html" class="btn btn-default"><i class="fa fa-shopping-basket"></i></a></li>
                      <li><a class="btn btn-default" data-toggle="modal" href=".quick-view" ><i class="fa fa-eye"></i></a></li>
                    </ul>
                  </div>
                </div>
                <div class="productCaption clearfix">
                 <h5>Sun Buddies</h5>
                 <h3>$149</h3>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>