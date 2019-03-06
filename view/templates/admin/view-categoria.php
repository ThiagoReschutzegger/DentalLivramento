<?php $categoria = $data['categoria']; ?>
<div class="container-fluid" style="margin-top: 50px">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header d-flex align-items-center">
                <h3 class="h4">Vizualizar Categoria</h3>
            </div>
            <div class="card-body">
                <img class="img-fluid text-right" src="<?php echo $categoria->getImagem(); ?>" heigth="300px" style="float: right;" />
                <div class="col-sm-7 row">
                    <h2><?php echo $categoria->getNome(); ?></h2>
                </div>
                <div class="row">
                    <div class="col-sm-9">
                        <p><?php echo $categoria->getDescricao(); ?></p>
                    </div>
                </div>
                <div class="line"><h4>Grupos selecionados:</h4></div>
                <div class="row">
                    <div class="col-sm-7">
                        <p>
                            <?php
                            foreach ($data['grupo'] as $grupo):
                                if ($grupo->getId_categoria() == $categoria->getId_categoria()) {
                                    echo $grupo->getNome() . "<br>";
                                }
                            endforeach;
                            ?>
                        </p>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-4 offset-sm-3">
                        <a class="btn btn-secondary" href="<?php echo $this->base_url; ?>CategoriaAdmin">Voltar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
