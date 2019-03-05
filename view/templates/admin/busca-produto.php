<div class="content-inner">
    <!-- Page Header-->
    <header class="page-header">
        <div class="container-fluid">
            <h2 class="no-margin-bottom">Busca de produtos</h2>
        </div>
    </header>
    <section>
        <div class="col-lg-12">                           
            <div class="card">
                <div class="card-body">
                    <form method="POST" class="form-inline">
                        <div class="form-group">
                            <div class="col-sm-12 ">
                                <span style='color:grey; font-size:15px'>&nbsp&nbsp&nbspOrganizar por:&nbsp&nbsp&nbsp</span>
                                <select name="organizar" class="form-control">
                                    <option value='1'>Produto unitário</option>
                                    <option value='2'>Agrup. de produtos</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for='inlineFormInput' class="form-control-label">&nbsp&nbsp&nbspCód. de Barras&nbsp&nbsp&nbsp</label>
                            <input id="inlineFormInput" name="codigo" type="text" placeholder="CÓDIGO DE BARRAS" class="mr-1 form-control">
                        </div>
                        <div class="form-group">
                            <label for='inlineFormInputGroup' class="form-control-label">&nbsp&nbsp&nbspNome&nbsp&nbsp&nbsp</label>
                            <input id="inlineFormInputGroup" name="nome" type="text" placeholder="NOME DO PRODUTO" class="mr-1 form-control">
                        </div>
                        <br>
                        <br>
                        <br>
                        <br>
                        <div class="form-group col-lg-12 col-sm-12 col-md-12">
                            <input type="submit" name="buscar" value="Buscar" class="btn btn-primary col-lg-12 col-sm-12 col-md-12">
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
                                            <th>Imagem</th>
                                            <th>Cód. Barras</th>
                                            <th>Nome</th>
                                            <th>Especificação</th>
                                            <th>Editar</th>
                                            <th>Excluir</th>
                                            <th>Pág.</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($data as $produto): ?>
                                            <tr>
                                                <td><center><img height="100" src="<?php echo $produto->getImagem(); ?>"></center></td>
                                        <td><?php echo $produto->getBarcode(); ?></td>
                                        <td><?php echo substr($produto->getNome(), 0, 45) . "..."; ?></td>
                                        <td><?php echo substr($produto->getEspecificacao(), 0, 45) . "..."; ?></td>
                                        <td>
                                            <button type="button" class="btn btn-info btn-circle"><i class="fa fa-pencil"></i></button>

                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-danger btn-circle" data-toggle="modal" data-target="#excluir<?php echo $produto->getId_produto() ?>"><i class="fa fa-trash"></i></button>
                                        </td>
                                        <td>
                                            <a href="<?php echo $this->base_url ?>Home/viewProduto/<?php echo $produto->getId_produto(); ?>"><button type="button" class="btn btn-secondary"><i class="fa fa-eye"></i></button></a>
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