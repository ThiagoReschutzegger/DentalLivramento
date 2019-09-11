<div class="content-inner">
    <!-- Page Header-->
    <header class="page-header">
        <div class="container-fluid">
            <h2 class="no-margin-bottom">Produtos</h2>
        </div>
    </header>
    <!-- Dashboard Counts Section-->
    <section class="dashboard-counts no-padding-bottom">
        <div class="container-fluid">
            <div class="row bg-white has-shadow">
                <!-- Item -->
                <div class="col-sm-3">
                    <div class="item d-flex align-items-center">
                        <div class="icon bg-violet"><i class="icon-search"></i></div>
                        <a href="<?php echo $this->base_url; ?>ProdutoAdmin/buscaProduto">
                            <div class="title"><span>Buscar<br>produto</span>
                                <div class="progress">
                                    <div role="progressbar" style="width: 100%; height: 4px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" class="progress-bar bg-violet"></div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <!-- Item -->
                <div class=" col-sm-3">
                    <div class="item d-flex align-items-center">
                        <div class="icon bg-orange"><i class="fa fa-upload"></i></div>
                        <a href="<?php echo $this->base_url; ?>ProdutoAdmin/uploadTxt/">
                            <div class="title"><span>Atualizar produtos</span>
                                <div class="progress">
                                    <div role="progressbar" style="width: 100%; height: 4px;" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" class="progress-bar bg-orange"></div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </section>
</div>
