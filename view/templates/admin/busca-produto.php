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
                    <?php if (!isset($data)): ?>
                        <div class="alert alert-info" role="alert">
                            Insira alguns dos campos.
                        </div>
                    <?php elseif (empty($data)): ?>
                        <div class="alert alert-warning" role="alert">
                            Não foi encontrado nenhum valor correspondente
                        </div>
                    <?php else: ?>
                        <div class="card-body">
                            <div class="table-responsive">                       
                                <table class="table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Username</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th scope="row">1</th>
                                            <td>Mark</td>
                                            <td>Otto</td>
                                            <td>@mdo</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">2</th>
                                            <td>Jacob</td>
                                            <td>Thornton</td>
                                            <td>@fat</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">3</th>
                                            <td>Larry</td>
                                            <td>the Bird</td>
                                            <td>@twitter</td>
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