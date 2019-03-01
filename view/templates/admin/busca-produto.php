<script>
    $(document).ready(function () {
        // process the form
        $('form').submit(function (event) {
            
            // get the form data
            // there are many ways to get this data using jQuery (you can use the class or id also)
            var formData = {
                'codigo': $('input[name=codigo]').val(),
                'nome': $('input[name=nome]').val(),
                'buscar': $('input[name=buscar]').val(),
            };

            // process the form
            $.ajax({
                type: 'POST', // define the type of HTTP verb we want to use (POST for our form)
                url: '<?php echo $this->base_url; ?>/ProdutoAdmin/buscaProduto', // the url where we want to POST
                data: formData, // our data object
                dataType: 'json', // what type of data do we expect back from the server
                encode: true
            })
                    // using the done promise callback
                    .success(function (data) {

                        // log data to the console so we can see
                        console.log(data);

                        // here we will handle errors and validation messages
                    });
                    alert("222");
            // stop the form from submitting the normal way and refreshing the page
            event.preventDefault();
        });

    });
</script>

<div class="content-inner">
    <!-- Page Header-->
    <header class="page-header">
        <div class="container-fluid">
            <h2 class="no-margin-bottom">Busca de produtos</h2>
        </div>
    </header>
    <section>
        <div class="col-lg-8">                           
            <div class="card">
                <div class="card-body">
                    <form method="POST" class="form-inline">
                        <div class="form-group">
                            <label for="inlineFormInput" class="sr-only">Name</label>
                            <input id="inlineFormInput" name="codigo" type="text" placeholder="CÓDIGO DE BARRAS" class="mr-5 form-control">
                        </div>
                        <div class="form-group">
                            <label for="inlineFormInputGroup" class="sr-only">Username</label>
                            <input id="inlineFormInputGroup" name="nome" type="text" placeholder="NOME DO PRODUTO" class="mr-5 form-control">
                        </div>
                        <div class="form-group">
                            <input type="submit" name="buscar" value="Buscar" class="btn btn-primary">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-12">                           
            <div class="card">
                <div class="card-body">
                    <?php if ($data == 'inicio'): ?>
                        <div class="alert alert-info" role="alert">
                            Insira alguns dos campos.
                        </div>
                    <?php elseif ($data == 'vazio'): ?>
                        <div class="alert alert-warning" role="alert">
                            Não foi encontrado nenhum valor correspondente
                        </div>
                    <?php else: ?>
                        <div class="card-header d-flex align-items-center">
                            <h3 class="h4">Resultado da busca</h3>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">                       
                                <table class="table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>Nome</th>
                                            <th>Logo</th>
                                            <th>Descripción</th>
                                            <th>Editar</th>
                                            <th>Excluir</th>
                                            <th>Pág.</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($data as $produto): ?>
                                            <tr>
                                                <td><center><img height="100" src="<?php echo $produto->getImagem(); ?>"></center></td>
                                        <td><?php echo $produto->getNome(); ?></td>
                                        <td><?php echo substr($produto->getDescricao(), 0, 45) . "..."; ?></td>
                                        <td>
                                            <button type="button" class="btn btn-info btn-circle"  data-toggle="modal" data-target="#edit<?php echo $produto->getId(); ?>"><i class="fa fa-pencil"></i></button>
                                            <div id="edit<?php echo $produto->getId(); ?>" class="modal fade" role="dialog">
                                                <div class="modal-dialog modal-md">
                                                    <!-- Modal content-->
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Editar Marca</h4>
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form method="post" target="_self" action="<?php echo $this->base_url ?>ProdutoAdmin/updateProduto/<?php echo $produto->getId() ?>" enctype="multipart/form-data">
                                                                <label for="produto" class="form-control-label">Produto</label>
                                                                <input name="produto" type="text" placeholder="<?php echo $produto->getNome(); ?>" value="<?php echo $produto->getNome(); ?>" class="form-control" required>
                                                                <br>
                                                                <br>
                                                                <div class="form-group row">
                                                                    <label for="fileInput" class="col-sm-3 form-control-label">Logo</label>
                                                                    <div class="col-sm-9">
                                                                        <div style="border: 1px solid lightgrey; padding:5px; width: 215px">
                                                                            <center>
                                                                                <img id="mini_foto_new" class="mini_foto" src="<?php echo $this->base_url; ?>view/templates/default/images/<?php echo $produto->getLogo(); ?>" width="200"/>
                                                                            </center>
                                                                        </div>
                                                                        <br>
                                                                        <input id="fileInput" type="file" class="form-control-file" name="logo" onchange="readURL(this, 'mini_foto_new');">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <label for="fileInput2" class="col-sm-3 form-control-label">Capa</label>
                                                                    <div class="col-sm-9">
                                                                        <div style="border: 1px solid lightgrey; padding:5px; width: 215px">
                                                                            <center>
                                                                                <img id="mini_foto_he" class="mini_foto" src="<?php echo $this->base_url; ?>view/templates/default/images/<?php echo $produto->getCapa(); ?>" width="200"/>
                                                                            </center>
                                                                        </div>
                                                                        <br>
                                                                        <input id="fileInput2" type="file" class="form-control-file" name="capa" onchange="readURL(this, 'mini_foto_he');">
                                                                    </div>
                                                                </div>
                                                                <label>Descripción</label>
                                                                <br>
                                                                <textarea class="form-control" name="texto" placeholder="Descripción de la produto" cols="75" rows="18" required><?php echo $produto->getDescricao(); ?></textarea>
                                                                <br>
                                                                <label for="site" class="form-control-label">URL del sítio</label>
                                                                <input name="site" type="url" placeholder="<?php echo $produto->getSite(); ?>" value="<?php echo $produto->getSite(); ?>" class="form-control" required>
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
                                            <button type="button" class="btn btn-danger btn-circle" data-toggle="modal" data-target="#excluir<?php echo $produto->getId_produto() ?>"><i class="fa fa-trash"></i></button>
                                            <div id="excluir<?php echo $produto->getId_produto(); ?>" class="modal fade" role="dialog">
                                                <div class="modal-dialog modal-sm">
                                                    <!-- Modal content-->
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Alerta</h4>
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>Desea excluir al produto <?php echo $produto->getNome() ?>?</p>
                                                            <a href="<?php echo $this->base_url ?>ProdutoAdmin/deleteProduto/<?php echo $produto->getId_produto() ?>"><button type="button" class="btn btn-danger">Excluir</button></a>
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <a href="<?php echo $this->base_url ?>Marcas/viewMarca/<?php echo $produto->getId(); ?>"><button type="button" class="btn btn-secondary"><i class="fa fa-arrow-right"></i></button></a>
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
                    <?php endif; ?>

                </div>
            </div>
        </div>
    </section>
</div>
