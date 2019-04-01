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
                    <tr>
                      <td>
                        <span class="cartImage"><img src="<?php echo $this->asset; ?>img/products/cart-image1.jpg" alt="image"></span>
                      </td>
                      <td class="font-table-cart">Italian Winter Hat</td>
                      <td class="font-table-cart"><center><b>1</b></center></td>
                      <td class="font-table-cart">R$ 25.00</td>
                    </tr>
                    <tr>
                      <td>
                        <span class="cartImage"><img src="<?php echo $this->asset; ?>img/products/cart-image1.jpg" alt="image"></span>
                      </td>
                      <td class="font-table-cart">Italian Winter Hat</td>
                      <td class="font-table-cart"><center><b>1</b></center></td>
                      <td class="font-table-cart">R$ 25.00</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </form>
          </div>

          <div class="row shipping-info">
            <div class="col-md-4">
              <h5>Dados Pessoais</h5>
              <address>
                Guillermo das Neves <br>
                Vasco Alves - 24 <br>
                Santana do Livramento, RS <br>
                (55) 80085 <br>
                example78@gmail.com <br>
                <a href="<?php echo $this->base_url; ?>Home/step1" style="color: #343434"><b><i class="fa fa-reply" aria-hidden="true"></i> Editar</b></a>
              </address>

            </div>
            <div class="col-md-4">
              <h5>Método de entrega</h5>
              <p>
                <b>Retirada na Loja</b> <br>
                Vasco Alves, nº 123 <br>
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
              <li class="next"><a class="btn btn-primary btn-default float-right" href="<?php echo $this->base_url; ?>Home/step3">Finalizar Pedido <i class="fa fa-angle-right"></i></a></li>
            </ul>
          </div>

        </div>
      </div>
      <div class="col-md-4">
        <div class="summery-box">
          <h4>Dados do Pedido</h4>
          <p>Um pequeno resumo do seu pedido.</p>
          <ul class="list-unstyled">
            <li class="d-flex justify-content-between">
              <span class="tag">Subtotal</span>
              <span class="val">R$ 50.00</span>
            </li>
            <li class="d-flex justify-content-between">
              <span class="tag">Entrega</span>
              <span class="val">R$ 0.00</span>
            </li>
            <li class="d-flex justify-content-between">
              <span class="tag">Total</span>
              <span class="val">R$ 50.00 </span>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</section>
