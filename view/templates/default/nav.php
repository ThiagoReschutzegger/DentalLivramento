<?php
  if(isset($_SESSION['carrinho']) && $data['itens'] != ''){
    $count = 0;
    foreach ($_SESSION['carrinho'] as $item){
      $count += $item->getPrecoitem();
    }
  }
?>
  <body class="body-wrapper version1">

    <!-- Preloader -->
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

    <div class="main-wrapper">

      <!-- HEADER -->
      <div class="header clearfix">

        <!-- TOPBAR -->
        <div class="topBar">
          <div class="container">
            <div class="row">
              <div class="col-md-6 d-none d-md-block">
                <ul class="list-inline">
                  <li><a target="_blank" href="https://www.facebook.com/DentalLivramento/"><i class="fa fa-facebook"></i></a></li>
                  <li><a target="_blank" href="https://www.instagram.com/dentallivramento/"><i class="fa fa-instagram"></i></a></li>
                </ul>
              </div>
              <div class="col-md-6 col-12">
                <ul class="list-inline float-right top-right">
                  <li class="searchBox">
                    <a href="#"><i class="fa fa-search"></i></a>
                    <ul class="dropdown-menu dropdown-menu-right">
                      <li>
                        <form method="post">
                        <span class="input-group">
                            <input type="text" class="form-control" placeholder="Pesquisar…" name="pesquisar" aria-describedby="basic-addon2">
                            <input type="submit" class="input-group-addon" name="vai" value="Vai" />
                        </span>
                        </form>
                      </li>
                    </ul>
                  </li>
                  <li class="dropdown cart-dropdown">
                    <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-shopping-cart"></i>R$ <?php echo (isset($_SESSION['carrinho']) && $data['itens'] != '')? number_format((float)$count, 2, ',', ''): "0,00" ?></a>
                    <ul class="dropdown-menu dropdown-menu-right">
                      <?php if(isset($_SESSION['carrinho']) && $data['itens'] != ''): ?>
                      <li><?php echo count($data['itens']) > 1? "Itens" : "Item"?> em seu carrinho</li>
                      <?php foreach($data['itens'] as $item): ?>
                      <li>
                        <a href="#">
                          <div class="media">
                            <img class="media-left media-object img-fluid" style="max-height:70px;max-width:80px;" src="<?php echo $item[0]->getImagem(); ?>" alt="cart-Image">
                            <div class="media-body">
                              <h5 class="media-heading"><?php echo $item[0]->getNome(); ?></h5>
                              <span><?php echo $item[0]->getEspecificacao(); ?></span>
                              <br>
                              <h5><span><?php echo $item[1]; ?> X R$ <?php echo $item[0]->getPreco(); ?></span></h5>
                            </div>
                          </div>
                        </a>
                      </li>
                    <?php endforeach; ?>
                      <li>
                        <div class="btn-group" role="group" aria-label="...">
                          <button type="button" class="btn btn-default" onclick="location.href='<?php echo $this->base_url; ?>Home/viewCart';">Carrinho</button>
                          <button type="button" class="btn btn-default" onclick="location.href='<?php echo $this->base_url; ?>Home/step1';">Checkout</button>
                        </div>
                      </li>
                    <?php else: ?>
                      <li>Adicione itens ao seu carrinho!</li>
                    <?php endif; ?>
                    </ul>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>

        <!-- NAVBAR -->
        <nav class="navbar navbar-main navbar-default navbar-expand-md" role="navigation">
          <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->

            <a class="navbar-brand" href="<?php echo $this->base_url ?>Home">
              <center><img class="logo-pl logo-nav image-fluid" src="<?php echo $this->asset ?>img/DentalLivramentoLogoFinal.png"></center>
              <!--<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="166px" height="31px">
             <path class="logo-pl" fill-rule="evenodd"  fill="rgb(71, 186, 193)"
              d="M157.432,17.855 L157.573,15.904 L166.011,15.904 L166.011,27.436 C164.581,28.174 163.195,28.687 161.853,28.974 C160.511,29.261 158.921,29.404 157.081,29.404 C155.487,29.404 154.019,29.179 152.678,28.728 C151.336,28.277 150.178,27.646 149.206,26.838 C148.233,26.029 147.410,25.066 146.736,23.946 C146.062,22.827 145.558,21.597 145.224,20.255 C144.890,18.913 144.723,17.492 144.723,15.992 C144.723,13.355 145.216,11.021 146.200,8.987 C147.184,6.954 148.652,5.346 150.603,4.162 C152.554,2.979 154.866,2.387 157.538,2.387 C160.467,2.387 163.069,3.061 165.343,4.408 L164.341,6.219 C163.380,5.633 162.293,5.161 161.080,4.804 C159.867,4.446 158.692,4.268 157.555,4.268 C155.844,4.268 154.318,4.572 152.976,5.182 C151.634,5.791 150.548,6.632 149.716,7.704 C148.883,8.776 148.254,10.010 147.826,11.404 C147.398,12.799 147.184,14.316 147.184,15.957 C147.184,17.703 147.401,19.279 147.835,20.686 C148.268,22.092 148.919,23.308 149.786,24.333 C150.653,25.359 151.766,26.150 153.126,26.706 C154.485,27.263 156.055,27.541 157.837,27.541 C159.676,27.541 161.704,27.102 163.919,26.223 L163.919,17.855 L157.432,17.855 ZM137.244,20.123 L126.398,20.123 L122.917,29.000 L120.685,29.000 L130.898,2.844 L133.060,2.844 L142.904,29.000 L140.583,29.000 L137.244,20.123 ZM131.953,5.111 C131.812,5.627 131.349,6.998 130.564,9.225 C129.779,11.451 129.029,13.549 128.314,15.518 L127.259,18.471 L136.435,18.471 C133.798,10.901 132.304,6.447 131.953,5.111 ZM118.250,17.398 C119.223,18.594 119.709,20.006 119.709,21.635 C119.709,23.944 118.977,25.748 117.512,27.049 C116.047,28.350 113.797,29.000 110.762,29.000 L101.902,29.000 L101.902,2.844 L109.039,2.844 C112.285,2.844 114.655,3.383 116.149,4.461 C117.644,5.539 118.391,7.180 118.391,9.383 C118.391,9.641 118.388,9.834 118.382,9.963 C118.376,10.092 118.350,10.347 118.303,10.728 C118.256,11.108 118.183,11.428 118.083,11.686 C117.983,11.943 117.828,12.263 117.617,12.644 C117.406,13.025 117.151,13.355 116.853,13.637 C116.554,13.918 116.164,14.202 115.684,14.489 C115.203,14.777 114.658,15.014 114.049,15.201 C115.877,15.471 117.277,16.203 118.250,17.398 ZM114.357,13.540 C114.901,13.183 115.312,12.673 115.587,12.011 C115.862,11.349 116.000,10.525 116.000,9.541 C116.000,7.713 115.435,6.445 114.304,5.735 C113.173,5.026 111.383,4.672 108.934,4.672 L104.152,4.672 L104.152,14.498 L110.147,14.498 C111.072,14.498 111.869,14.428 112.537,14.287 C113.205,14.146 113.812,13.898 114.357,13.540 ZM109.162,16.221 L104.152,16.221 L104.152,27.242 L110.182,27.242 C114.928,27.242 117.301,25.373 117.301,21.635 C117.301,19.608 116.644,18.198 115.332,17.407 C114.020,16.616 111.963,16.221 109.162,16.221 Z"/>
             <path class="logo-pm" fill-rule="evenodd"  fill="rgb(51, 51, 51)"
              d="M86.846,18.752 L86.882,15.008 L96.725,15.008 L96.725,27.436 C95.131,28.092 93.623,28.578 92.199,28.895 C90.775,29.211 89.231,29.369 87.567,29.369 C83.641,29.369 80.574,28.186 78.365,25.818 C76.156,23.451 75.051,20.211 75.051,16.098 C75.051,13.485 75.567,11.185 76.598,9.198 C77.629,7.212 79.147,5.662 81.151,4.549 C83.155,3.436 85.522,2.879 88.253,2.879 C91.382,2.879 94.065,3.553 96.303,4.900 L94.757,8.451 C92.624,7.303 90.485,6.729 88.341,6.729 C85.739,6.729 83.694,7.572 82.206,9.260 C80.717,10.947 79.973,13.244 79.973,16.150 C79.973,19.033 80.635,21.313 81.960,22.988 C83.284,24.664 85.223,25.502 87.778,25.502 C89.419,25.502 90.907,25.244 92.243,24.729 L92.243,18.752 L86.846,18.752 ZM65.972,3.248 L70.736,3.248 L70.736,29.000 L65.972,29.000 L65.972,3.248 ZM60.760,17.478 C61.604,18.573 62.025,19.924 62.025,21.529 C62.025,23.955 61.167,25.807 59.450,27.084 C57.733,28.361 55.357,29.000 52.322,29.000 L42.777,29.000 L42.777,3.248 L50.811,3.248 C54.221,3.248 56.763,3.746 58.439,4.742 C60.115,5.738 60.953,7.396 60.953,9.717 C60.953,10.092 60.930,10.461 60.883,10.824 C60.836,11.188 60.730,11.601 60.566,12.063 C60.402,12.527 60.185,12.945 59.916,13.320 C59.646,13.695 59.271,14.062 58.791,14.419 C58.310,14.777 57.748,15.055 57.104,15.254 C58.697,15.641 59.916,16.382 60.760,17.478 ZM54.985,7.502 C54.077,6.998 52.633,6.746 50.652,6.746 L47.541,6.746 L47.541,13.883 L51.619,13.883 C54.771,13.883 56.348,12.682 56.348,10.279 C56.348,8.932 55.893,8.006 54.985,7.502 ZM55.785,18.154 C54.871,17.521 53.459,17.205 51.549,17.205 L47.541,17.205 L47.541,25.555 L51.672,25.555 C55.328,25.555 57.156,24.125 57.156,21.266 C57.156,19.824 56.699,18.787 55.785,18.154 Z"/>
             <path class="logo-pf" fill-rule="evenodd"  opacity="0.6" fill="rgb(71, 186, 193)"
              d="M18.000,9.000 L10.000,9.000 L6.000,9.000 L2.000,9.000 C0.900,9.000 -0.000,9.900 -0.000,11.000 L-0.000,23.000 C-0.000,27.400 3.600,31.000 8.000,31.000 L20.000,31.000 C24.400,31.000 28.000,27.400 28.000,23.000 L28.000,11.000 C28.000,9.900 27.100,9.000 26.000,9.000 L22.000,9.000 L18.000,9.000 ZM22.000,13.000 L24.000,13.000 L24.000,23.000 C24.000,25.206 22.205,27.000 20.000,27.000 L8.000,27.000 C5.794,27.000 4.000,25.206 4.000,23.000 L4.000,13.000 L6.000,13.000 L10.000,13.000 L18.000,13.000 L22.000,13.000 Z"/>
             <path class="logo-pf" fill-rule="evenodd"  opacity="0.6" fill="rgb(71, 186, 193)"
              d="M6.000,10.334 L6.000,14.000 L6.000,16.000 C6.000,17.103 6.896,18.000 8.000,18.000 C9.104,18.000 10.000,17.103 10.000,16.000 L10.000,14.000 L10.000,10.000 L10.000,8.000 C10.000,5.791 11.791,4.000 14.000,4.000 C16.209,4.000 18.000,5.791 18.000,8.000 L18.000,10.000 L18.000,14.000 L18.000,16.000 C18.000,17.103 18.896,18.000 20.000,18.000 C21.103,18.000 22.000,17.103 22.000,16.000 L22.000,14.000 L22.000,10.000 L22.000,8.000 C22.000,3.582 18.418,-0.000 14.000,-0.000 C9.582,-0.000 6.000,3.582 6.000,8.000 L6.000,10.000 "/>
            </svg>-->
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".navbar-ex1-collapse" aria-controls="navbar-ex1-collapse" aria-expanded="false" aria-label="Toggle navigation">
              <span class="fa fa-bars"></span>
            </button>


            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
              <ul class="nav navbar-nav ml-auto">
                <li class="nav-item">
                  <a href="<?php echo $this->base_url; ?>" class="nav-link" role="button" aria-haspopup="true">Home</a>
                </li>
                <li class="nav-item dropdown megaDropMenu ">
                  <a href="javascript:void(0)" class="dropdown-toggle nav-link" data-toggle="dropdown" data-hover="dropdown" data-delay="300" data-close-others="true" aria-expanded="false">Categorias</b></a>
                  <ul class="dropdown-menu row">
                    <?php foreach($data['categoria'] as $categoria): ?>
                    <li class="col-md-3 col-12">
                      <ul class="list-unstyled">
                        <li style="display: none;"></li>
                        <li><a class="title-categoria" href="javascript:;" data-toggle="collapse" aria-expanded="false" data-target="#nav<?php echo $categoria->getId_categoria(); ?>"><?php echo $categoria->getNome(); ?> <i class="fa fa-plus"></i></a></li>
                        <li><ul id="nav<?php echo $categoria->getId_categoria(); ?>" class="collapse collapseItem list-unstyled" style="padding-top:0;">
                          <li style="display: none;"></li>
                          <?php foreach($data['grupo'] as $grupo):
                            if($grupo->getId_categoria() == $categoria->getId_categoria()):
                          ?>
                            <li><a href="<?php echo $this->base_url; ?>Loja/view/<?php echo $grupo->getId_grupo(); ?>"><?php echo $grupo->getNome(); ?></a></li>
                          <?php endif; endforeach; ?>
                        </ul></li>
                      </ul>
                    </li>
                  <?php endforeach; ?>
                  </ul>
                </li>
                <li class="nav-item">
                  <a href="<?php echo $this->base_url; ?>" class="nav-link" role="button" aria-haspopup="true">Contato</a>
                </li>
              </ul>
            </div><!-- /.navbar-collapse -->
            <div class="version2">
              <div class="dropdown cart-dropdown">
                <a href="javascript:void(0)" class="dropdown-toggle shop-cart" data-toggle="dropdown">
                  <i class="fa fa-shopping-cart"></i>
                  <span class="badge"><?php echo (isset($_SESSION['carrinho'])) ? count($_SESSION['carrinho']) : 0; ?></span>
                </a>
                <ul class="dropdown-menu dropdown-menu-right">
                  <?php if(isset($_SESSION['carrinho']) && $data['itens'] != ''): ?>
                  <li><?php echo count($data['itens']) > 1? "Itens" : "Item"?> em seu carrinho</li>
                  <?php foreach($data['itens'] as $item): ?>
                  <li>
                    <a href="#">
                      <div class="media">
                        <img class="media-left media-object img-fluid" style="max-height:70px;max-width:80px;" src="<?php echo $item[0]->getImagem(); ?>" alt="cart-Image">
                        <div class="media-body">
                          <h5 class="media-heading"><?php echo $item[0]->getNome(); ?></h5>
                          <span><?php echo $item[0]->getEspecificacao(); ?></span>
                          <br>
                          <h5><span><?php echo $item[1]; ?> X R$ <?php echo $item[0]->getPreco(); ?></span></h5>
                        </div>
                      </div>
                    </a>
                  </li>
                <?php endforeach; ?>
                  <li>
                    <div class="btn-group" role="group" aria-label="...">
                      <button type="button" class="btn btn-default" onclick="location.href='<?php echo $this->base_url; ?>Home/viewCart';">Carrinho</button>
                      <button type="button" class="btn btn-default" onclick="location.href='<?php echo $this->base_url; ?>Home/step1';">Checkout</button>
                    </div>
                  </li>
                <?php else: ?>
                  <li>Adicione itens ao seu carrinho!</li>
                <?php endif; ?>
                </ul>
              </div>
            </div>
          </div>
        </nav>
      </div>
