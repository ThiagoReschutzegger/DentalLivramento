<body>
  <div class="page">
    <!-- Main Navbar-->
    <header class="header">
      <nav class="navbar">
        <!-- Search Box-->
        <div class="search-box">
          <button class="dismiss"><i class="icon-close"></i></button>
          <form id="searchForm" action="#" role="search">
            <input type="search" placeholder="What are you looking for..." class="form-control">
          </form>
        </div>
        <div class="container-fluid">
          <div class="navbar-holder d-flex align-items-center justify-content-between">
            <!-- Navbar Header-->
            <div class="navbar-header">
              <!-- Navbar Brand --><a href="index.html" class="navbar-brand d-none d-sm-inline-block">
                <div class="brand-text d-none d-lg-inline-block"><span>Administrador </span><strong>&nbspDental Livramento</strong></div>
                <div class="brand-text d-none d-sm-inline-block d-lg-none"><strong>ADM</strong></div></a>

              <!-- Toggle Button--><a id="toggle-btn" href="#" class="menu-btn active"><span></span><span></span><span></span></a>
            </div>
            <!-- Navbar Menu -->
            <ul class="nav-menu list-unstyled d-flex flex-md-row align-items-md-center">

              <!-- Logout    -->
              <li class="nav-item"><a href="<?php echo $this->base_url ?>Admin/Logout" class="nav-link logout"> <span class="d-none d-sm-inline">Deslogar</span><i class="fa fa-sign-out"></i></a></li>
            </ul>
          </div>
        </div>
      </nav>
    </header>
    <div class="page-content d-flex align-items-stretch">
      <!-- Side Navbar -->
      <nav class="side-navbar">
        <!-- Sidebar Header-->
        <div class="sidebar-header d-flex align-items-center">
          <div class="avatar"><img src="<?php echo $this->asset; ?>img/avatar-1.jpg" alt="..." class="img-fluid rounded-circle"></div>
          <div class="title">
            <h1 class="h4">Admin Guillermo</h1>
          </div>
        </div>
        <!-- Sidebar Navidation Menus--><span class="heading">Main</span>
        <ul class="list-unstyled">
          <li><a href="<?php echo $this->base_url; ?>Admin"> <i class="icon-home"></i>Home </a></li>
          <li><a href="<?php echo $this->base_url; ?>MarcaAdmin"> <i class="fa fa-photo"></i>Marcas </a></li>
          <li><a href="<?php echo $this->base_url; ?>GrupoAdmin"> <i class="icon-grid"></i>Grupos </a></li>
          <li><a href="<?php echo $this->base_url; ?>ProdutoAdmin"> <i class="icon-padnote"></i>Produtos </a></li>
          <li><a href="#exampledropdownDropdown" aria-expanded="false" data-toggle="collapse"> <i class="icon-interface-windows"></i>Example dropdown </a>
            <ul id="exampledropdownDropdown" class="collapse list-unstyled ">
              <li><a href="#">Page</a></li>
              <li><a href="#">Page</a></li>
              <li><a href="#">Page</a></li>
            </ul>
          </li>
          <li><a href="login.html"> <i class="icon-interface-windows"></i>Login page </a></li>
        </ul><!--<span class="heading">Extras</span>
        <ul class="list-unstyled">
          <li> <a href="#"> <i class="icon-flask"></i>Demo </a></li>
          <li> <a href="#"> <i class="icon-screen"></i>Demo </a></li>
          <li> <a href="#"> <i class="icon-mail"></i>Demo </a></li>
          <li> <a href="#"> <i class="icon-picture"></i>Demo </a></li>
        </ul>-->
      </nav>
