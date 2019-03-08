<div class="content-inner">
    <!-- Page Header-->
    <header class="page-header">
        <div class="container-fluid">
            <h2 class="no-margin-bottom">Painel de Controle</h2>
        </div>
    </header>
<section class="dashboard-counts no-padding-bottom">
        <div class="container-fluid">
            <div class="row bg-white has-shadow">
                <!-- Item -->
                <div class="col-xl-6 col-sm-6">
                    <div class="item d-flex align-items-center">
                        <div class="icon bg-red"><i class="icon-home"></i></div>
                        <div class="title"><a class="linkDash" href="<?php echo $this->base_url; ?>"><span>Pantalla Inicial</span></a>
                            <!--<div class="progress">
                                <div role="progressbar" style="width: 25%; height: 4px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" class="progress-bar bg-violet"></div>
                            </div>-->
                        </div>
                        <!--<div class="number"><strong>25</strong></div>-->
                    </div>
                </div>
                <!-- Item -->
                <div class="col-xl-6 col-sm-6">
                    <div class="item d-flex align-items-center">
                        <div class="icon bg-yellow"><i class="icon-picture"></i></div>
                        <div class="title"><a class="linkDash" href="<?php echo $this->base_url . "HomeAdmin"; ?>"><span>Personalizar<br></span></a>
                            <!--<div class="progress">
                                <div role="progressbar" style="width: 25%; height: 4px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" class="progress-bar bg-violet"></div>
                            </div>-->
                        </div>
                        <!--<div class="number"><strong>25</strong></div>-->
                    </div>
                </div>
            </div>
            <div class="row bg-white has-shadow">
                <!-- Item -->
                <div class="col-xl-6 col-sm-6">
                    <div class="item d-flex align-items-center">
                        <div class="icon bg-green"><i class="icon-interface-windows"></i></div>
                        <div class="title"><a class="linkDash" href="<?php echo $this->base_url . "AdminMarcas"; ?>"><span>Marcas<br></span></a>

                        </div>

                    </div>
                </div>
                <!-- Item -->
                <div class="col-xl-6 col-sm-6">
                    <div class="item d-flex align-items-center">
                        <div class="icon bg-orange"><i class="icon-interface-windows"></i></div>
                        <div class="title"><a class="linkDash" href="<?php echo $this->base_url . "AdminProductos"; ?>"><span>Productos<br></span></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row bg-white has-shadow">
                <!-- Item -->
                <div class="col-xl-6 col-sm-6">
                    <div class="item d-flex align-items-center">
                        <div class="icon bg-violet"><i class="icon-interface-windows"></i></div>
                        <div class="title"><a class="linkDash" href="<?php echo $this->base_url . "AdminTemporadas"; ?>"><span>Temporadas<br></span></a>

                        </div>

                    </div>
                </div>
                <!-- Item -->
                <div class="col-xl-6 col-sm-6">
                    <div class="item d-flex align-items-center">
                        <div class="icon bg-blue"><i class="icon-mail"></i></div>
                        <div class="title"><a class="linkDash" href="<?php echo $this->base_url . "AdminContacto"; ?>"><span>Contacto<br></span></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Dashboard Header Section    -->
    <section class="dashboard-header" id="desaparecer">
        <div class="container-fluid">
            <div class="row">
                <!-- Statistics -->
                <!--<div class="statistics col-lg-3 col-12">
                    <div class="statistic d-flex align-items-center bg-white has-shadow">
                        <div class="icon bg-red"><i class="fa fa-tasks"></i></div>
                        <div class="text"><strong>234</strong><br><small>Applications</small></div>
                    </div>
                    <div class="statistic d-flex align-items-center bg-white has-shadow">
                        <div class="icon bg-green"><i class="fa fa-calendar-o"></i></div>
                        <div class="text"><strong>152</strong><br><small>Interviews</small></div>
                    </div>
                    <div class="statistic d-flex align-items-center bg-white has-shadow">
                        <div class="icon bg-orange"><i class="fa fa-paper-plane-o"></i></div>
                        <div class="text"><strong>147</strong><br><small>Forwards</small></div>
                    </div>
                </div>-->
                <!-- Line Chart            -->
                <div class="col-lg-12">
                    <div class="articles card">
                        <div class="card-close">
                            <div class="dropdown">
                                <button type="button" id="closeCard4" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-ellipsis-v"></i></button>
                                <div aria-labelledby="closeCard4" class="dropdown-menu dropdown-menu-right has-shadow"><a href="#" class="dropdown-item remove"> <i class="fa fa-times"></i>Close</a><!--<a href="#" class="dropdown-item edit"> <i class="fa fa-gear"></i>Edit</a>--></div>
                            </div>
                        </div>
                        <div class="card-header d-flex align-items-center">
                            <h2 class="h3">Visualización</h2>
                            <!--<div class="badge badge-rounded bg-green">4 New       </div>-->
                        </div>
                        <div class="card-body no-padding">
                            <iframe src="<?php echo $this->base_url; ?>" id="siteView" frameborder="0" height="700">
                                <strong>Erro.</strong> Tente outro navegador.
                            </iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="dashboard-header">
        <div class="container-fluid">
            <div class="row">
                <!-- Statistics -->
                <!--<div class="statistics col-lg-3 col-12">
                    <div class="statistic d-flex align-items-center bg-white has-shadow">
                        <div class="icon bg-red"><i class="fa fa-tasks"></i></div>
                        <div class="text"><strong>234</strong><br><small>Applications</small></div>
                    </div>
                    <div class="statistic d-flex align-items-center bg-white has-shadow">
                        <div class="icon bg-green"><i class="fa fa-calendar-o"></i></div>
                        <div class="text"><strong>152</strong><br><small>Interviews</small></div>
                    </div>
                    <div class="statistic d-flex align-items-center bg-white has-shadow">
                        <div class="icon bg-orange"><i class="fa fa-paper-plane-o"></i></div>
                        <div class="text"><strong>147</strong><br><small>Forwards</small></div>
                    </div>
                </div>-->
                <!-- Line Chart            -->

                <div class="col-lg-12">
                    <div class="client card">
                        <div class="card-close">
                            <div class="dropdown">
                                <button type="button" id="closeCard2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-ellipsis-v"></i></button>
                                <div aria-labelledby="closeCard2" class="dropdown-menu dropdown-menu-right has-shadow"><a href="#" class="dropdown-item remove"> <i class="fa fa-times"></i>Close</a></div>
                            </div>
                        </div>
                        <div class="card-body text-center">
                            <div class="client-avatar"><img src="<?php echo $this->asset; ?>img/avatar-2.png" alt="Web Frontier" class="img-fluid rounded-circle">
                                <!--<div class="status bg-green"></div>-->
                            </div>
                            <div class="client-title">
                                <h3>Web Frontier</h3><span>Desenvolvimento Web</span>
                            </div>
                            <div class="client-info">
                                <div class="row">
                                    <div class="col-12">Algum problema com o site?<br>Contate-nos via Facebook:
                                      <div class="client-title">
                                        <a href="https://www.facebook.com/Web-Frontier-254973305404391/" target="_blank"><i class="fa fa-facebook"></i> Web Frontier</a><br>
                                        <a href="https://webfrontier.000webhostapp.com  " target="_blank">webfrontier.com</a></div><br>
                                  </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
