<!-- FOOTER -->
<div class="footer clearfix" id="contato">
<div class="container">
<div class="row">
<div class="col-md-4 col-12" style="padding-top: 50px;">
  <div class="newsletter clearfix" style="float: none;">
    <h4>Alguma dúvida?</h4>
    <h3>Entre em contato</h3>
    <div style="margin-left: 1vw; margin-bottom: 30px">
    <h5 style="color: #5f5f5f; font-size: 1.4em; padding-bottom: 10px; padding-top: 20px; text-align: left;">
      Onde nos Encontrar?
    </h5>
    <ul class="list-unstyled text-left" style="color: #acacac; font-size: 1.2em;">
      <li>Rua Vasco Alves - 1273</li>
      <li>S. do Livramento - RS</li>
      <li>Brasil</li>
    </ul><br>
    <h5 style="color: #5f5f5f; font-size: 1.4em; padding-bottom: 10px; text-align: left;">Contatos</h5>
    <ul class="list-unstyled text-left" style="color: #acacac; font-size: 1.2em;">
      <li><i class="fa fa-phone"></i> (55) 3242-7096</li>
      <li><i class="fa fa-whatsapp"></i> (55) 98435-3393</li>
      <li><i class="fa fa-envelope" style="padding-top: 5px;"></i> <a href="mailto:dentallivramento@gmail.com">dentallivramento@gmail.com</a></li>
    </ul>
  </div>
  </div>
</div>
<iframe class="row col-sm-12 col-md-8 heightiado" height="400px" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3423.6521422284904!2d-55.533062685275446!3d-30.89639078158046!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x95a9fe58e6cd3433%3A0xc257b78d05c8810c!2sDental+LIvramento!5e0!3m2!1spt-BR!2sbr!4v1556052654093!5m2!1spt-BR!2sbr" frameborder="0" style="border:0; margin-left: 0vw;" allowfullscreen></iframe>
</div>
<div class="row" style="margin-top: 30px">
<div class="col-md-4 col-12">
  <div class="footerLink">
    <h5 style="font-size: 18px;">Mande uma mensagem</h5>
    <div class="">
      <form method="get" action="<?php echo $this->base_url; ?>Home/addMensagem">
        <input name="email-msg" type="email" class="form-control" placeholder="Seu e-mail">
        <textarea name="mensagem-msg" class="form-control" placeholder="Escreva a mensagem aqui"></textarea>
        <input type="submit" name="enviar-msg" value="Enviar" class="btn btn-primary-outlined">
      </form>
    </div>
  </div>
</div>
<div class="col-md-4 col-12">
  <div class="footerLink">
    <h5 style="font-size: 18px;">Siga-nos</h5>
    <ul class="list-unstyled" style="letter-spacing: 2px;">
      <li style="padding-top: 10px"><a href="#" style=" font-size: 1.5em;"><i class="fa fa-facebook-square"></i> FACEBOOK</a></li>
      <li style="padding-top: 10px"><a href="#" style=" font-size: 1.5em;"><i class="fa fa-instagram"></i> INSTAGRAM</a></li>
    </ul>
  </div>
</div>
<div class="col-md-4 col-md-offset-3 col-sm-3">
  <div class="footerLink">
    <h5 style="font-size: 18px;">Algum erro?</h5>
      <ul class="list-unstyled" style="color: #acacac; font-size: 1.2em;">
          <li style="line-height: 21px">
              <i class="fa fa-warning"></i> <b>Entre em Contato!</b>
              Estamos trabalhando para proporcionar a você uma ótima experiência.
          </li>
          <li style="padding-top: 5px; line-height: 21px">
            <i class="fa fa-whatsapp"></i> (55) 9 8468-1929 <b>ou</b><br>
            <a href="mailto:contato.webfrontier@gmail.com"><i class="fa fa-envelope"></i> contato.webfrontier@gmail.com</a>
          </li>
      </ul>
    </div>
</div>
</div>
</div>
</div>
<!-- COPY RIGHT -->
<div class="copyRight clearfix">
<div class="container">
<div class="row">
<div class="col-md-5 col-12">
  <ul class="list-inline">
    <li><img src="<?php echo $this->asset ?>img/footer/card1.png"></li>
    <li><img src="<?php echo $this->asset ?>img/footer/card3.png"></li>
    <li><img src="<?php echo $this->asset ?>img/footer/american.png" height="26px"></li>
    <li><img src="<?php echo $this->asset ?>img/footer/diners.jpg" height="26px"></li>
    <li><img src="<?php echo $this->asset ?>img/footer/logo_elo.png" height="26px"></li>
  </ul>
</div>
<div class="col-md-7 col-12">
  <p>&copy; <?php echo date("Y"); ?> Dental Livramento. Desenvolvido por <a target="_blank" href="http://webfrontier.000webhostapp.com/" id="wf" class="fonte-e-cor-top">Web Frontier</a>.</p>
</div>
</div>
</div>
</div>
</div>

<!-- LOGIN MODAL -->
<div class="modal fade login-modal" id="login" tabindex="-1" role="dialog">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header justify-content-center">
<h3 class="modal-title">log in</h3>
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
</div>
<div class="modal-body">
<form action="" method="POST" role="form">
  <div class="form-group">
    <label for="">Enter Email</label>
    <input type="email" class="form-control" id="">
  </div>
  <div class="form-group">
    <label for="">Password</label>
    <input type="password" class="form-control" id="">
  </div>
  <div class="checkbox">
    <input id="checkbox-1" class="checkbox-custom form-check-input" name="checkbox-1" type="checkbox" checked>
    <label for="checkbox-1" class="checkbox-custom-label form-check-label">Remember me</label>
  </div>
  <button type="submit" class="btn btn-primary btn-block">log in</button>
  <button type="button" class="btn btn-link btn-block">Forgot Password?</button>
</form>
</div>
</div>
</div>
</div>

<!-- SIGN UP MODAL -->
<div class="modal fade " id="signup" tabindex="-1" role="dialog">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header justify-content-center">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
<h3 class="modal-title">Create an account</h3>
</div>
<div class="modal-body">
<form action="" method="POST" role="form">
  <div class="form-group">
    <label for="">Enter Email</label>
    <input type="email" class="form-control" id="">
  </div>
  <div class="form-group">
    <label for="">Password</label>
    <input type="password" class="form-control" id="">
  </div>
  <div class="form-group">
    <label for="">Confirm Password</label>
    <input type="password" class="form-control" id="">
  </div>
  <button type="submit" class="btn btn-primary btn-block">Sign up</button>
  <button type="button" class="btn btn-link btn-block">New User?</button>
</form>
</div>
</div>
</div>
</div>

<!-- PORDUCT QUICK VIEW MODAL -->
<div class="modal fade quick-view" tabindex="-1" role="dialog">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-body">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
<div class="media flex-wrap">
  <div class="media-left px-0">
    <img class="media-object" src="<?php echo $this->asset ?>img/products/quick-view/quick-view-01.jpg" alt="Image">
  </div>
  <div class="media-body">
    <h2>Old Skool Navy</h2>
    <h3>$149</h3>
    <p>Classic sneaker from Vans. Cotton canvas and suede upper. Textile lining with heel stabilizer and ankle support. Contrasting laces. Sits on a classic waffle rubber sole.</p>
    <span class="quick-drop">
      <select name="guiest_id3" id="guiest_id3" class="select-drop">
        <option value="0">Size</option>
        <option value="1">Size 1</option>
        <option value="2">Size 2</option>
        <option value="3">Size 3</option>
      </select>
    </span>
    <span class="quick-drop resizeWidth">
      <select name="guiest_id4" id="guiest_id4" class="select-drop">
        <option value="0">Qty</option>
        <option value="1">Qty 1</option>
        <option value="2">Qty 2</option>
        <option value="3">Qty 3</option>
      </select>
    </span>
    <div class="btn-area">
      <a href="#" class="btn btn-primary btn-block">Add to cart <i class="fa fa-angle-right" aria-hidden="true"></i></a>
    </div>
  </div>
</div>
</div>
</div>
</div>
</div>

<script src="<?php echo $this->asset ?>plugins/jquery/jquery.min.js"></script>
<script src="<?php echo $this->asset ?>plugins/jquery/jquery-migrate-3.0.0.min.js"></script>
<script src="<?php echo $this->asset ?>plugins/jquery-ui/jquery-ui.js"></script>
<script src="<?php echo $this->asset ?>plugins/bootstrap/js/popper.min.js"></script>
<script src="<?php echo $this->asset ?>plugins/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo $this->asset ?>plugins/rs-plugin/js/jquery.themepunch.tools.min.js"></script>
<script src="<?php echo $this->asset ?>plugins/rs-plugin/js/jquery.themepunch.revolution.min.js"></script>
<script src="<?php echo $this->asset ?>plugins/slick/slick.js"></script>
<script src="<?php echo $this->asset ?>plugins/fancybox/jquery.fancybox.min.js"></script>
<script src="<?php echo $this->asset ?>plugins/iziToast/js/iziToast.js"></script>
<script src="<?php echo $this->asset ?>plugins/prismjs/prism.js"></script>
<script src="<?php echo $this->asset ?>plugins/selectbox/jquery.selectbox-0.1.3.min.js"></script>
<script src="<?php echo $this->asset ?>plugins/countdown/jquery.syotimer.js"></script>
<script src="<?php echo $this->asset ?>plugins/velocity/velocity.min.js"></script>
<script src="<?php echo $this->asset ?>js/custom.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.js"></script>
<script type="text/javascript">
    $( document ).ready(function() {
        $( "#teste" ).click(function() {
            $("#teste2").toggle();
        });
        $('.ddd_tel').mask('(99) 99999-9999');
        $('.cep').mask('99999-999');
    });
</script>

</body>
</html>
