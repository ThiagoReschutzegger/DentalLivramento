<?php
  if(isset($_SESSION['carrinho']) && $data['itens'] != ''){
    $count = 0;
    foreach ($_SESSION['carrinho'] as $item){
      $count += $item->getPrecoitem();
    }
  }
?>
<script type="text/javascript">
    function isNumberKey(evt){
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
    return true;
    };

    function readMore() {
      var dots = document.getElementById("dots");
      var moreText = document.getElementById("more");
      var btnText = document.getElementById("read");
      var pre = document.getElementById("pre");

      dots.style.display = "none";
      btnText.style.display = "none";
      pre.style.display = "none";
      moreText.style.display = "inline";
    };
</script>
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
          <form method="post" action="#">
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
                      <span class="cartImage text-center"><img class="img-fluid" style="max-height:120px;max-width:120px;" src="<?php if($item[0]->getImagem() != "") echo $item[0]->getImagem(); else echo $this->base_url."view/images/produto-sem-imagem.gif"; ?>" alt="image"></span>
                    </td>
                    <td class="font-table-cart"><?php echo $item[0]->getNome(); ?><br><span style="color:grey;font-size:12px;"><?php echo $item[0]->getEspecificacao(); ?></span></td>
                    <td class="font-table-cart">R$ <?php echo number_format((float)$item[0]->getPreco(), 2); ?></td>
                    <td class="font-table-cart count-input" style="text-transform: lowercase;">
                      <div style="min-width:90px;">
                        <a class="incr-btn" data-action="decrease" href="#">
                          <i class="fa fa-minus"></i>
                        </a>
                        <input class="quantity" name="espec<?php echo $item[0]->getId_produto(); ?>" style="margin:0; width: 40px;" type="number" min="1" max="<?php echo $item[0]->getEstoque()?>" value="<?php echo $item[1]; ?>" placeholder="Qtd." onkeypress="return isNumberKey(event)">
                        <a class="incr-btn" data-action="increase" href="#">
                          <i class="fa fa-plus"></i>
                        </a>
                      </div>
                      unid.
                    </td>
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
            <div class="checkBtnArea text-right">
              <a href="<?php echo $this->base_url; ?>Home/descartar" style="letter-spacing: 1px; font-weight: 700;" class="btn btn-danger-outlined btn-default">descartar&nbsp;&nbsp;<i class="fa fa-trash" aria-hidden="true"></i></a>
              <button style="letter-spacing: 1px; font-weight: 700;" type="submit" name="add" value="x" class="btn btn-primary-outlined btn-default btn-finalizar" id="mudar">atualizar e finalizar&nbsp;&nbsp;<i class="fa fa-arrow-circle-right" aria-hidden="true"></i></button>
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
