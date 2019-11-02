<?php
  if(isset($_SESSION['carrinho']) && $data['itens'] != ''){
    $count = 0;
    foreach ($_SESSION['carrinho'] as $item){
      $count += $item->getPrecoitem();
    }
  }
?>

<script type="text/javascript">
$(document).ready(function(){

    $( "a.scrollLink" ).click(function( event ) {
        event.preventDefault();
        $("html, body").animate({ scrollTop: $($(this).attr("href")).offset().top }, 500);
    });

    if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
     console.log("Usando mobile");
   }else{
     $(".navbar").css('position', 'static', 'important');
     $('#blockclick').click(false);
   }
  
});

</script>
  <body class="body-wrapper version1">

    <!-- Preloader -->
    <?php //if(isset($data['preloader']) && $data['preloader']=="1"): ?>
    <div id="preloader" class="smooth-loader-wrapper">
      <div class="preloader_container">
        <div class="block"></div>
        <div class="block"></div>
        <div class="block"></div>
        <div class="block"></div>
        <div class="block"></div>
        <div class="block"></div>
        <div class="block"></div>
        <div class="block"></div>
        <div class="block"></div>
        <div class="block"></div>
        <div class="block"></div>
        <div class="block"></div>
        <div class="block"></div>
        <div class="block"></div>
        <div class="block"></div>
        <div class="block"></div>
      </div>
    </div>
    <?php //endif;?>

    <div class="main-wrapper">

      <!-- HEADER -->
      <div class="header clearfix">

        <!-- TOPBAR -->
        <div class="topBar">
          <div class="container">
            <div class="row">
              <div class="col-md-2 d-none d-md-block">
                <ul class="list-inline">
                  <li><a target="_blank" href="https://www.facebook.com/DentalLivramento/"><i class="fa fa-facebook"></i></a></li>
                  <li><a target="_blank" href="https://www.instagram.com/dentallivramento/"><i class="fa fa-instagram"></i></a></li>
                </ul>
              </div>
                <div class="col-md-10 " style="text-align: center;">
                  <h1 class="h1-topbar">
                      O maior e mais completo estoque da região!
                  </h1>
              </div>
              
            </div>
          </div>
        </div>

        <!-- NAVBAR -->
        <nav id="menu">
				<div id="panel-menu">
					<ul>
            <?php foreach($data['categoria'] as $categoria): ?>
              <li id="cat-<?php echo $categoria->getId_categoria(); ?>"><span><?php echo $categoria->getNome(); ?></span>
                <ul>
                  <?php foreach($data['grupo'] as $grupo):
                    if($grupo->getId_categoria() == $categoria->getId_categoria()):
                  ?>
                    <li>
                      <span><?php echo $grupo->getNome(); ?></span>
                      <ul>
                        <?php foreach($data['subgrupo-nav'] as $subgrupo):
                          if($subgrupo->getId_grupo() == $grupo->getId_grupo()):
                        ?>
                          <li><a href="<?php echo $this->base_url;?>Loja/view/<?php echo $subgrupo->getId_subgrupo(); ?>"><?php echo $subgrupo->getNome(); ?></a></li>
                        <?php endif; endforeach; ?>
                      </ul>
                    </li>

            <?php endif; endforeach; ?></ul>
            </li>
            <?php endforeach; ?>
					</ul>
				</div>
			</nav>
      <!-- NAV TOP -->
        <div class="navTop text-center">
          <div class="container another-one-bites-the-dust">

              <a class="navbar-brand" href="<?php echo $this->base_url ?>Home" style="margin:-15px 0px 15px 15px">
                <center><img class="logo-pl logo-nav image-fluid" src="<?php echo $this->asset ?>img/DentalLivramentoLogoFinal.png"></center>
              </a>
            
                <div class="navTop-middle search-field-pc">
                  <div class="searchBox">
                    <span class="input-group">
                        <form method="post" action="<?php echo $this->base_url; ?>Loja/search" style="width: 100%;">
                      <input style="width: 100%;" id="searchbox" name="pesquisa" type="text" class="form-control" placeholder="O produto que procura está aqui!" aria-describedby="basic-addon2">
                      <button type="submit" name="go" value="x" class="input-group-addon"><i class="fa fa-search"></i></button>
                    </form>
                    </span>
                  </div>
                </div>
           
            <div class="dropdown cart-dropdown">
              <a href="cart-page.html" class="dropdown-toggle shop-cart" data-toggle="dropdown">
                <i class="fa fa-shopping-cart"></i>
                <span class=" d-md-block">
                  <span class="cart-total">Carrinho</span><br>
                  <span class="cart-price">R$ <?php echo (isset($_SESSION['carrinho']) && $data['itens'] != '')? number_format((float)$count, 2, ',', ''): "0,00" ?></span>
                </span>
              </a>
              <ul class="dropdown-menu dropdown-menu-right">
                <?php if(isset($_SESSION['carrinho']) && $data['itens'] != ''): ?>
                <li><?php echo count($data['itens']) > 1? "Últimos Itens" : "Último Item"?> em seu carrinho</li>
                <?php $data['itens'] = array_reverse($data['itens']); $i = 1; foreach($data['itens'] as $item): if($i > 4) continue; ?>
                <li>
                  <a href="#">
                    <div class="media">
                      <img class="media-left media-object img-fluid" style="max-height:70px;max-width:80px;"
                           src="<?php if($item[0]->getImagem() != "") echo $item[0]->getImagem(); else echo $this->base_url."view/images/produto-sem-imagem.gif"; ?>" alt="cart-Image">
                      <div class="media-body">
                        <h5 class="media-heading"><?php echo $item[0]->getNome(); ?></h5>
                        <span><?php echo $item[0]->getEspecificacao(); ?></span>
                        <br>
                        <h5><span><?php echo $item[1]; ?> X R$ <?php echo number_format((float)$item[0]->getPreco(), 2); ?></span></h5>
                      </div>
                    </div>
                  </a>
                </li>
              <?php $i++; endforeach; ?>
                <li>
                  <div class="btn-group" role="group" aria-label="...">
                    <button type="button" class="btn btn-default" onclick="location.href='<?php echo $this->base_url; ?>Home/viewCart';">Carrinho</button>
                    <button type="button" class="btn btn-default" onclick="location.href='<?php echo $this->base_url; ?>Home/step1';">Finalizar</button>
                  </div>
                </li>
              <?php else: ?>
                <li>Adicione itens ao seu carrinho!</li>
              <?php endif; ?>
              </ul>
            </div>
            
              <div class="navTop-middle search-field-mobile">
                <div class="">
                  <span class="input-group">
                      <form method="post" action="<?php echo $this->base_url; ?>Loja/search" style="width: 100%;">
                    <input style="width: 100%;" id="searchbox" name="pesquisa" type="text" class="form-control" placeholder="O produto que procura está aqui!" aria-describedby="basic-addon2">
                    <button type="submit" name="go" value="x" class="input-group-addon" style="background-color: #00bafa; color: white; display: none;"><i class="fa fa-search"></i></button>
                    </form>
                  </span>
                </div>
             </div>
            
          </div>
        </div>
      <nav class="navbar navbar-main navbar-default navbar-expand-md nav-V3" role="navigation">
        <div class="container">

          <div class="nav-category dropdown">
            <a href='#menu' id="openMenu" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
            <center>Categorias
              <button type="button">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              </center>
            </a>
          </div>

          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".navbar-ex1-collapse" aria-controls="navbar-ex1-collapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="fa fa-bars"></span>
          </button>

          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav">
              <li class="dropdown nav-item">
                  <a href="<?php echo $this->base_url;?>" class="nav-link dropdown-toggle">Home</a>
              </li>
              <?php foreach($data['categoria-dstq'] as $categoria): ?>
              <li class="dropdown nav-item">
                  <a href="" onclick="openCategoria(<?php echo $categoria->getId_categoria(); ?>); return true;" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $categoria->getNome(); ?></a>
              </li>
              <?php endforeach; ?>
              
<!--              <li class="dropdown nav-item megaDropMenu">
                <a href="javascript:void(0)" class="nav-link dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="300" data-close-others="true" aria-expanded="false">Ortodontia</b></a>
                <ul class="dropdown-menu row">
                  <li class="col-md-3 col-12">
                    <ul class="list-unstyled">
                      <li>Products Grid View</li>
                      <li><a href="product-grid-left-sidebar.html">Products Sidebar Left</a></li>
                      <li><a href="product-grid-right-sidebar.html">Products Sidebar Right</a></li>
                      <li><a href="product-grid-3-col-filter.html">Products 3 Columns V1</a></li>
                      <li><a href="product-grid-3-col.html">Products 3 Columns V2</a></li>
                      <li><a href="product-grid-4-col.html">Products 4 Columns</a></li>
                    </ul>
                  </li>
                  <li class="col-md-3 col-12">
                    <ul class="list-unstyled">
                      <li>Products List View</li>
                      <li><a href="product-list-left-sidebar.html">Products Sidebar Left</a></li>
                      <li><a href="product-list-right-sidebar.html">Products Sidebar Right</a></li>
                      <li class="listHeading">Others</li>
                      <li><a href="single-product.html">Single Product</a></li>
                      <li><a href="cart-page.html">Cart Page</a></li>
                    </ul>
                  </li>
                  <li class="col-md-3 col-12">
                    <ul class="list-unstyled">
                      <li>Checkout</li>
                      <li><a href="checkout-step-1.html">Step 1 - Shipping</a></li>
                      <li><a href="checkout-step-2.html">Step 2 - Payment</a></li>
                      <li><a href="checkout-step-3.html">Step 3 - Review</a></li>
                      <li><a href="checkout-step-4.html">Step 4 - Complete</a></li>
                    </ul>
                  </li>
                  <li class="col-md-3 col-12">
                    <a href="#" class="menu-photo"><img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSo5HddTHrF-QFhj0sijBLpiwnGbh81S_R3RQXV0ref6V89VEfY&s" alt="menu-img"></a>
                  </li>
                </ul>
              </li>-->
<!--              <li class="dropdown nav-item megaDropMenu">
                <a href="javascript:void(0)" class="nav-link dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="300" data-close-others="true" aria-expanded="false">Dentística</b></a>
                <ul class="dropdown-menu row">
                  <li class="col-md-3 col-12">
                    <ul class="list-unstyled">
                      <li>Products Grid View</li>
                      <li><a href="product-grid-left-sidebar.html">Products Sidebar Left</a></li>
                      <li><a href="product-grid-right-sidebar.html">Products Sidebar Right</a></li>
                      <li><a href="product-grid-3-col-filter.html">Products 3 Columns V1</a></li>
                      <li><a href="product-grid-3-col.html">Products 3 Columns V2</a></li>
                      <li><a href="product-grid-4-col.html">Products 4 Columns</a></li>
                    </ul>
                  </li>
                  <li class="col-md-3 col-12">
                    <ul class="list-unstyled">
                      <li>Products List View</li>
                      <li><a href="product-list-left-sidebar.html">Products Sidebar Left</a></li>
                      <li><a href="product-list-right-sidebar.html">Products Sidebar Right</a></li>
                      <li class="listHeading">Others</li>
                      <li><a href="single-product.html">Single Product</a></li>
                      <li><a href="cart-page.html">Cart Page</a></li>
                    </ul>
                  </li>
                  <li class="col-md-3 col-12">
                    <ul class="list-unstyled">
                      <li>Checkout</li>
                      <li><a href="checkout-step-1.html">Step 1 - Shipping</a></li>
                      <li><a href="checkout-step-2.html">Step 2 - Payment</a></li>
                      <li><a href="checkout-step-3.html">Step 3 - Review</a></li>
                      <li><a href="checkout-step-4.html">Step 4 - Complete</a></li>
                    </ul>
                  </li>
                  <li class="col-md-3 col-12">
                    <a href="#" class="menu-photo"><img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSo5HddTHrF-QFhj0sijBLpiwnGbh81S_R3RQXV0ref6V89VEfY&s" alt="menu-img"></a>
                  </li>
                </ul>
              </li>-->
<!--              <li class="dropdown nav-item megaDropMenu">
                <a href="javascript:void(0)" class="nav-link dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="300" data-close-others="true" aria-expanded="false">Equipamentos</b></a>
                <ul class="dropdown-menu row">
                  <li class="col-md-3 col-12">
                    <ul class="list-unstyled">
                      <li>Products Grid View</li>
                      <li><a href="product-grid-left-sidebar.html">Products Sidebar Left</a></li>
                      <li><a href="product-grid-right-sidebar.html">Products Sidebar Right</a></li>
                      <li><a href="product-grid-3-col-filter.html">Products 3 Columns V1</a></li>
                      <li><a href="product-grid-3-col.html">Products 3 Columns V2</a></li>
                      <li><a href="product-grid-4-col.html">Products 4 Columns</a></li>
                    </ul>
                  </li>
                  <li class="col-md-3 col-12">
                    <ul class="list-unstyled">
                      <li>Products List View</li>
                      <li><a href="product-list-left-sidebar.html">Products Sidebar Left</a></li>
                      <li><a href="product-list-right-sidebar.html">Products Sidebar Right</a></li>
                      <li class="listHeading">Others</li>
                      <li><a href="single-product.html">Single Product</a></li>
                      <li><a href="cart-page.html">Cart Page</a></li>
                    </ul>
                  </li>
                  <li class="col-md-3 col-12">
                    <ul class="list-unstyled">
                      <li>Checkout</li>
                      <li><a href="checkout-step-1.html">Step 1 - Shipping</a></li>
                      <li><a href="checkout-step-2.html">Step 2 - Payment</a></li>
                      <li><a href="checkout-step-3.html">Step 3 - Review</a></li>
                      <li><a href="checkout-step-4.html">Step 4 - Complete</a></li>
                    </ul>
                  </li>
                  <li class="col-md-3 col-12">
                    <a href="#" class="menu-photo"><img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSo5HddTHrF-QFhj0sijBLpiwnGbh81S_R3RQXV0ref6V89VEfY&s" alt="menu-img"></a>
                  </li>
                </ul>
              </li>-->

            </ul>
          </div><!-- /.navbar-collapse -->


        </div>
      </nav>
      </div>
