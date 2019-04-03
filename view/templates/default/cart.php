<?php
  if(isset($_SESSION['carrinho']) && $data['itens'] != ''){
    $count = 0;
    foreach ($_SESSION['carrinho'] as $item){
      $count += $item->getPrecoitem();
    }
  }
?>
<!-- LIGHT SECTION -->
<section class="lightSection clearfix pageHeaderImage">
  <div class="container">
    <div class="tableBlock">
      <div class="row tableInner">
        <div class="col-sm-12">
          <div class="page-title">
            <h2>Seu carrinho</h2>
            <ol class="breadcrumb" >
              <li style="color: white;">
                <a href="<?php echo $this->base_url; ?>">Home</a>
              </li>
              <li class="active" style="color: white;"><b>Carrinho</b></li>
            </ol>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- MAIN CONTENT SECTION -->
<?php if(isset($_SESSION['carrinho']) && $data['itens']):?>
<section class="mainContent clearfix cartListWrapper">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="cartListInner">
          <form action="#">
            <div class="table-responsive">
              <table class="table">
                <thead>
                  <tr>
                    <th></th>
                    <th class="font-table-cart" style="text-transform: uppercase;">Produto</th>
                    <th class="font-table-cart" style="text-transform: uppercase;">Valor</th>
                    <th class="font-table-cart" style="text-transform: uppercase;">Qtd.</th>
                    <th class="font-table-cart" style="text-transform: uppercase;">Sub Total</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $i = 0;
                  foreach ($data['itens'] as $item): ?>
                  <tr>
                    <td class="text-center">
                      <span class="cartImage text-center"><img class="img-fluid" style="max-height:120px;max-width:120px;" src="<?php echo $item[0]->getImagem(); ?>" alt="image"></span>
                    </td>
                    <td class="font-table-cart"><?php echo $item[0]->getNome(); ?><br><span style="color:grey;font-size:12px;"><?php echo $item[0]->getEspecificacao(); ?></span></td>
                    <td class="font-table-cart">R$ <?php echo $item[0]->getPreco(); ?></td>
                    <td class="font-table-cart" style="text-transform: lowercase;"><b><?php echo $item[1]; ?></b> unid.</td>
                    <td class="font-table-cart">R$ <?php echo number_format((float)((float)$item[0]->getPreco() * (float)$item[1]), 2, ',', ''); ?>
                      <a href="<?php echo $this->base_url; ?>Home/viewCart/i.<?php echo $i; ?>" style="color: #00bafa; position: relative; margin-right: 5px; opacity: 1; float: right; font-size: 1.5rem;"><span aria-hidden="true">&times;</span></a>
                    </td>
                  </tr>
                <?php
                $i++;
                endforeach;
                ?>
                </tbody>
              </table>
            </div>
            <div class="row totalAmountArea">
              <div class="col-sm-4 ml-sm-auto">
                <ul class="list-unstyled">
                  <b><li>Preço Total: <span class="grandTotal fonte-e-cor-top" style='font-size:120%;'>R$ <?php echo number_format((float)($count), 2, ',', ''); ?></span></li></b>
                  <li><small style="color: gray;">*impostos já inclusos</small></li>
                </ul>
              </div>
            </div>
            <div class="checkBtnArea">
              <a href="<?php echo $this->base_url; ?>Home/step1" style="background-color:coral !important;border:coral !important;" class="btn btn-primary btn-default">checkout<i class="fa fa-arrow-circle-right" aria-hidden="true"></i></a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
<?php else: ?>
  <section class="mainContent clearfix stepsWrapper">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="innerWrapper clearfix stepsPage">
            <div class="row justify-content-center order-confirm">
              <div class="col-md-8 col-lg-6 text-center">
                <h2>Não há nada em seu carrinho.</h2>
                <span>Adicione itens para poder comprar.</span><br>
                <a href="<?php echo $this->base_url;?>" class="btn btn-primary btn-default">Voltar às Compras</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
<?php endif; ?>
