<!-- LIGHT SECTION -->
<section class="lightSection clearfix pageHeaderImage">
  <div class="container">
    <div class="tableBlock">
      <div class="row tableInner">
        <div class="col-sm-12">
          <div class="page-title">
            <h2>carrinho</h2>
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
                    <th class="font-table-cart" style="text-transform: uppercase;">Nome</th>
                    <th class="font-table-cart" style="text-transform: uppercase;">Valor</th>
                    <th class="font-table-cart" style="text-transform: uppercase;">Qtd.</th>
                    <th class="font-table-cart" style="text-transform: uppercase;">Sub Total</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td class="">
                      <span class="cartImage"><img src="<?php echo $this->asset;?>img/products/cart-image1.jpg" alt="image"></span>
                    </td>
                    <td class="font-table-cart">Italian Winter Hat</td>
                    <td class="font-table-cart">R$ 10.00</td>
                    <td class="font-table-cart" style="text-transform: lowercase;"><b>5</b> unid.</td>
                    <td class="font-table-cart">R$ 50.00
                      <a href="<?php echo $this->base_url; ?>Home/viewCart" style="color: #00bafa; position: relative; margin-right: 5px; opacity: 1; float: right; font-size: 1.5rem;"><span aria-hidden="true">&times;</span></a>
                    </td>
                  </tr>

                </tbody>
              </table>
            </div>
            <div class="row totalAmountArea">
              <div class="col-sm-4 ml-sm-auto">
                <ul class="list-unstyled">
                  <li>Preço Total <span class="grandTotal">R$ 50.00</span></li>
                  <li><small style="color: gray;">*impostos já inclusos</small></li>
                </ul>
              </div>
            </div>
            <div class="checkBtnArea">
              <a href="<?php echo $this->base_url; ?>Home/step1" class="btn btn-primary btn-default">checkout<i class="fa fa-arrow-circle-right" aria-hidden="true"></i></a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
