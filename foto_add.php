
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Fotos</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#home">Cadastrar Foto</a></li>

            </ul>
            <div class="tab-content">
                <div id="home" class="tab-pane fade in active">
                    <div class="col-lg-13 col-lg-offset-0">
                        <div class="panel-body ">
                            <div class="row">
                                <div class="col-lg-4l LEFT">
                                    <form role="form" method="post" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label>Título</label>
                                            <input class="form-control" type='text' name='titulo' required="true" placeholder="Informe o título" maxlength="30">
                                        </div>
                                        <div class="form-group">
                                            <label>Descrição</label>
                                            <input class="form-control" type='text' name='descricao' required="true" placeholder="Informe a descrição">
                                        </div>
                                        <div class="form-group">
                                            <label>Imagem</label>
                                            <input class="form-control" type="file" class="span7" name="foto" accept="image/*" />
                                        </div>
                                        
                                        <input type="submit" class="btn btn-default" value='Salvar' name='add' >
                                        <input type="reset" class="btn btn-default" value="Limpar">

                                        <?php if ($data['msg']): ?>
                                            <br> <br>
                                            <div class="row">
                                                <div class="alert alert-danger alert-dismissable">
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                                    <?php echo $data['msg'] ?>
                                                </div>
                                            </div>
                                        <?php endif ?>
                                    </form>


                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">

                    </div>

                </div>

            </div>
        </div>
    </div>
</div>
</div>

