<?php
  if(isset($_SESSION['carrinho']) && $data['itens'] != ''){
    $count = 0;
    foreach ($_SESSION['carrinho'] as $item){
      $count += $item->getPrecoitem();
    }
  }
  //echo "<pre>";var_dump($data['dados']);echo "</pre>";die;
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

            <div class="col-6 progress-wizard-step complete fullBar">
              <div class="text-center progress-wizard-stepnum">Dados do Cliente</div>
              <div class="progress"><div class="progress-bar"></div></div>
              <a disabled="true" class="progress-wizard-dot"></a>
            </div>

            <div class="col-6 progress-wizard-step active">
              <div class="text-center progress-wizard-stepnum">Revisão</div>
              <div class="progress"><div class="progress-bar"></div></div>
              <a disabled="true" class="progress-wizard-dot"></a>
            </div>

          </div>

          <div class="page-header mb-4">
            <h4>Revisão do Pedido</h4>
          </div>

          <div class="cartListInner review-inner row">
              <div class="table-responsive">
                <table class="table">
                  <thead>
                    <tr>
                      <th></th>
                      <th class="font-table-cart" style="text-transform: uppercase;">Nome</th>
                      <th class="font-table-cart" style="text-transform: uppercase;"><center>Quantidade</center></th>
                      <th class="font-table-cart" style="text-transform: uppercase;">Sub Total</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach($data['itens'] as $item): ?>
                    <tr>
                      <td>
                        <span class="cartImage"><img class="img-fluid" style="max-height:120px;max-width:120px;" src="<?php if($item[0]->getImagem() != "") echo $item[0]->getImagem(); else echo $this->base_url."view/images/produto-sem-imagem.gif"; ?>" alt="image"></span>
                      </td>
                      <td class="font-table-cart"><?php echo $item[0]->getNome();?>
                      <br><span style="font-size:11px;" ><?php echo $item[0]->getEspecificacao();?></span>
                      </td>
                      <td class="font-table-cart"><center><b><?php echo $item[1]; ?></b></center></td>
                      <td class="font-table-cart">R$ <?php echo number_format((float)$item[0]->getPreco(), 2); ?></td>
                    </tr>
                  <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
            </form>
          </div>

          <div class="row shipping-info">
            <div class="col-md-4">
              <h5>Dados Pessoais</h5>
              <address>
                <?php
                  foreach ($data['dados'] as $dado) {
                      echo ($dado != '')? $dado."<br>" : '';
                  }
                ?>
                <a href="<?php echo $this->base_url; ?>Home/step1" style="color: #343434"><b><i class="fa fa-reply" aria-hidden="true"></i> Editar</b></a>
              </address>

            </div>
            <div class="col-md-4">
              <h5>Método de entrega</h5>
              <p>
                <b><span class="badge" style='background-color:blue; font-size:125%;'>Retirada na Loja</span></b> <br>
                Vasco Alves, nº 1273 <br>
                Santana do Livramento - RS
              </p>
            </div>
            <div class="col-md-4">
              <h5>Método de Pagamento</h5>
              <p>
                A combinar com o vendedor.
              </p>
            </div>
          </div>
          <div class="well well-lg clearfix">
            <ul class="pager">
              <li class="next"><a class="btn btn-primary btn-default float-right" href="<?php echo $this->base_url; ?>Home/finalProd/<?php foreach ($data['dados'] as $dado) {echo ($dado != '')? $dado : 0;echo ";";}?>">Finalizar Pedido <i class="fa fa-angle-right"></i></a></li>
            </ul>
          </div>

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
                <span class="val">R$ <?php echo number_format((float)$item[0]->getPreco(), 2); ?></span>
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
