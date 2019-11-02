<?php
  if(isset($_SESSION['carrinho']) && $data['itens'] != ''){
    $count = 0;
    foreach ($_SESSION['carrinho'] as $item){
      $count += $item->getPrecoitem();
    }
  }
?>
<!-- LIGHT SECTION -->
<section class="lightSection clearfix pageHeader">
  <div class="container">
    <div class="row">
      <div class="col-md-6">
        <div class="page-title">
          <h2>Checkout</h2>
        </div>
      </div>
      <div class="col-md-6">
        <ol class="breadcrumb">
          <li>
            <a href="<?php echo $this->base_url; ?>">Home</a>
          </li>
          <li>
            <a href="#">Carrinho</a>
          </li>
          <li class="active"><b>Checkout</b></li>
        </ol>
      </div>
    </div>
  </div>
</section>

<!-- MAIN CONTENT SECTION -->
<section class="mainContent clearfix stepsWrapper">
  <div class="container">
    <div class="row">
      <div class="col-md-8">
        <div class="innerWrapper clearfix stepsPage">
          <div class="row progress-wizard" style="border-bottom:0;">

            <div class="col-6 progress-wizard-step active">
              <div class="text-center progress-wizard-stepnum">Dados do Cliente</div>
              <div class="progress"><div class="progress-bar"></div></div>
              <a disabled="true" class="progress-wizard-dot"></a>
            </div>

            <div class="col-6 progress-wizard-step disabled">
              <div class="text-center progress-wizard-stepnum">Revisão</div>
              <div class="progress"><div class="progress-bar"></div></div>
              <a disabled="true" class="progress-wizard-dot"></a>
            </div>

          </div>

          <form class="row" method="POST" role="form">
            <div class="col-12">
              <div class="page-header">
                <h4>DADOS DO CLIENTE</h4>
              </div>
            </div>
            <div class="form-group col-12">
              <label for="">Nome Completo: <span style='color:red'><b>*</b></span></label>
              <input type="text" name="nome" class="form-control" required>
            </div>
            <div class="form-group col-12">
              <label for="">Endereço:</label>
              <input type="text" name="endereco" class="form-control" >
            </div>
            <div class="form-group col-md-8 col-12">
              <label for="">Cidade:</label>
              <input type="text" name="cidade" class="form-control">
            </div>
            <div class="form-group col-md-8 col-12">
              <label for="">CEP:</label>
              <input type="text" name="cep" class="form-control cep">
            </div>
            <div class="form-group col-md-4 col-12">
              <label for="">UF:</label>
              <div class="form-group row">
                <div class="quick-drop col-12 selectOptions ">
                  <select name="uf" class="form-control select-drop">
                      <option>Selecione o Estado</option>
                  		<option value="Ac">Acre</option>
                  		<option value="Al">Alagoas</option>
                  		<option value="Am">Amazonas</option>
                  		<option value="Ap">Amapá</option>
                  		<option value="Bh">Bahia</option>
                  		<option value="Ce">Ceará</option>
                  		<option value="DF">Distrito Federal</option>
                  		<option value="ES">Espírito Santo</option>
                  		<option value="Go">Goiás</option>
                  		<option value="Ma">Maranhão</option>
                  		<option value="MG">Mato Grosso</option>
                  		<option value="MS">Mato Grosso do Sul</option>
                  		<option value="MG">Minas Gerais</option>
                  		<option value="Pa">Pará</option>
                  		<option value="Pb">Paraíba</option>
                  		<option value="Pr">Paraná</option>
                  		<option value="Pe">Pernambuco</option>
                  		<option value="Pi">Piauí</option>
                  		<option value="RJ">Rio de Janeiro</option>
                  		<option value="RN">Rio Grande do Norte</option>
                  		<option value="RS">Rio Grande do Sul</option>
                  		<option value="Ro">Rondônia</option>
                  		<option value="Rr">Roraima</option>
                  		<option value="SC">Santa Catarina</option>
                  		<option value="Se">Sergipe</option>
                  		<option value="SP">São Paulo</option>
                  		<option value="To">Tocantins</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="form-group col-md-6 col-12">
              <label for="">Email:</label>
              <input type="email" name="email" class="form-control">
            </div>
            <div class="form-group col-md-6 col-12">
              <label for="">Celular: <span style='color:red'><b>*</b></span></label>
              <input name="telefone" type="number" class="form-control" required>
            </div>
            <div class="form-group col-12">
              <label for="">Mensagem:</label>
              <textarea name="mensagem" class="form-control"></textarea>
            </div>
            <div class="col-12">
              <div class="well well-lg clearfix">
                <ul class="pager">
                  <li class="next "><input type="submit" name="add" class="btn btn-primary btn-default float-right" value="Continuar"></li>
                </ul>
              </div>
            </div>
          </form>
        </div>
      </div>
      <br>
      <div class="col-md-4">
        <div class="summery-box">
          <h4>Dados do Pedido</h4>
          <p>Um pequeno resumo do seu pedido.</p>
          <ul class="list-unstyled">
            <?php foreach ($data['itens'] as $key): ?>
              <li class="d-flex justify-content-between">
                <span class="tag"><?php echo $key[0]->getNome();?><br><span style="font-size:11px;" ><?php echo $key[0]->getEspecificacao();?></span></span>
                <span class="val">R$ <?php echo $key[0]->getPreco(); ?></span>
              </li>
            <?php endforeach; ?>
            <li class="d-flex justify-content-between">
              <span class="tag">Total</span>
              <span class="val">R$ <?php echo number_format((float)($count), 2, ',', ''); ?> </span>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</section>
