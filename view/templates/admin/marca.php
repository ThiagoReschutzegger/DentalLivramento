<script language="javascript" type="text/javascript">
function readURL(input, id) {
           if (input.files && input.files[0]) {
               var reader = new FileReader();

               reader.onload = function (e) {
                   $('#'+id)
		.attr('src', e.target.result)
		;
               }

               reader.readAsDataURL(input.files[0]);
           }
       }
</script>
    <!-- Dashboard Counts Section-->
    <section class="tables">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-close">
                            <div class="dropdown">
                                <button type="button" id="closeCard3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-ellipsis-v"></i></button>
                                <div aria-labelledby="closeCard3" class="dropdown-menu dropdown-menu-right has-shadow"><a href="#" class="dropdown-item remove"> <i class="fa fa-times"></i>Close</a><a href="#" class="dropdown-item edit"> <i class="fa fa-gear"></i>Edit</a></div>
                            </div>
                        </div>
                        <div class="card-header d-flex align-items-center">
                            <h3 class="h4">Marcas</h3>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>Marca</th>
                                            <th>Logo</th>
                                            <th>Capa</th>
                                            <th>Descripción</th>
                                            <th>Site</th>
                                            <th>Editar</th>
                                            <th>Excluir</th>
                                            <th>Pág.</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($data as $marca): ?>
                                            <tr>
                                                <td><?php echo $marca->getNome(); ?></td>
                                                <td><center><img height="35" src="<?php echo $this->base_url; ?>view/templates/default/images/<?php echo $marca->getLogo(); ?>"></center></td>
                                        <td><center><img height="45" src="<?php echo $this->base_url; ?>view/templates/default/images/<?php echo $marca->getCapa(); ?>"></center></td>
                                        <td><?php echo substr($marca->getDescricao(), 0, 45) . "..."; ?></td>
                                        <td><a style="color:grey" href="<?php echo $marca->getSite(); ?>"><?php echo substr($marca->getSite(), 0, 20) . "..."; ?></a></td>
                                        <td>
                                            <button type="button" class="btn btn-info btn-circle"  data-toggle="modal" data-target="#edit<?php echo $marca->getId(); ?>"><i class="fa fa-pencil"></i></button>
                                            <div id="edit<?php echo $marca->getId(); ?>" class="modal fade" role="dialog">
                                                <div class="modal-dialog modal-md">
                                                    <!-- Modal content-->
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Editar Marca</h4>
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form method="post" target="_self" action="<?php echo $this->base_url ?>AdminMarcas/updateMarca/<?php echo $marca->getId() ?>" enctype="multipart/form-data">
                                                                <label for="marca" class="form-control-label">Marca</label>
                                                                <input name="marca" type="text" placeholder="<?php echo $marca->getNome(); ?>" value="<?php echo $marca->getNome(); ?>" class="form-control" required>
                                                                <br>
                                                                <br>
                                                                <div class="form-group row">
                                                                    <label for="fileInput" class="col-sm-3 form-control-label">Logo</label>
                                                                    <div class="col-sm-9">
                                                                        <div style="border: 1px solid lightgrey; padding:5px; width: 215px">
                                                                            <center>
                                                                                <img id="mini_foto_new" class="mini_foto" src="<?php echo $this->base_url; ?>view/templates/default/images/<?php echo $marca->getLogo(); ?>" width="200"/>
                                                                            </center>
                                                                        </div>
                                                                        <br>
                                                                        <input id="fileInput" type="file" class="form-control-file" name="logo" onchange="readURL(this,'mini_foto_new');">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <label for="fileInput2" class="col-sm-3 form-control-label">Capa</label>
                                                                    <div class="col-sm-9">
                                                                        <div style="border: 1px solid lightgrey; padding:5px; width: 215px">
                                                                            <center>
                                                                                <img id="mini_foto_he" class="mini_foto" src="<?php echo $this->base_url; ?>view/templates/default/images/<?php echo $marca->getCapa(); ?>" width="200"/>
                                                                            </center>
                                                                        </div>
                                                                        <br>
                                                                        <input id="fileInput2" type="file" class="form-control-file" name="capa" onchange="readURL(this,'mini_foto_he');">
                                                                    </div>
                                                                </div>
                                                                <label>Descripción</label>
                                                                <br>
                                                                <textarea class="form-control" name="texto" placeholder="Descripción de la marca" cols="75" rows="18" required><?php echo $marca->getDescricao(); ?></textarea>
                                                                <br>
                                                                <label for="site" class="form-control-label">URL del sítio</label>
                                                                <input name="site" type="url" placeholder="<?php echo $marca->getSite(); ?>" value="<?php echo $marca->getSite(); ?>" class="form-control" required>
                                                                <br>
                                                                <input type="submit" class="btn btn-info" value="Editar" name="update">
                                                                <input type="reset" class="btn btn-default" data-dismiss="modal" value="Cancelar">
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-danger btn-circle" data-toggle="modal" data-target="#excluir<?php echo $marca->getId() ?>"><i class="fa fa-trash"></i></button>
                                            <div id="excluir<?php echo $marca->getId(); ?>" class="modal fade" role="dialog">
                                                <div class="modal-dialog modal-sm">
                                                    <!-- Modal content-->
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Alerta</h4>
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>Desea excluir al marca <?php echo $marca->getNome() ?>?</p>
                                                            <a href="<?php echo $this->base_url ?>AdminMarcas/deleteMarca/<?php echo $marca->getId() ?>"><button type="button" class="btn btn-danger">Excluir</button></a>
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <a href="<?php echo $this->base_url ?>Marcas/viewMarca/<?php echo $marca->getId(); ?>"><button type="button" class="btn btn-secondary"><i class="fa fa-arrow-right"></i></button></a>
                                        </td>
                                        </tr>
                                    <?php endforeach; ?>
                                        <tr>
                                            <td colspan="8"><center><button type="button" class="btn btn-success btn-lg btn-block"><i class="fa fa-plus"></i></button></center></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- Dashboard Header Section    -->
