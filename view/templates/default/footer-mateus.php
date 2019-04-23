<!-- FOOTER -->
<div class="footer clearfix">
<div class="container">
<div class="row">
<div class="col-md-2 col-12" style="height: 300px;">
  <div class="footerLink">
    <h5>Entre em Contato</h5>
    <ul class="list-unstyled">
      <li><img src="<?php echo $this->asset ?>img/home/footer/face.png" width="60" ></li>
      <li><a target="_blank" href="https://www.facebook.com/DentalLivramento/">FACEBOOK</a></li>
    </ul>
  </div>
</div>
<div class="col-md-2 col-12" style="height: 300px;">
  <div class="footerLink">
    <h5>_</h5>
    <ul class="list-unstyled">
      <li><img src="<?php echo $this->asset ?>img/home/footer/whats.png" width="60" ></li>
      <li><a>(55)98435-3393</a></li>
    </ul>
  </div>
</div>
<div class="col-md-2 col-12" style="height: 300px;">
  <div class="footerLink">
    <h5>_</h5>
    <ul class="list-unstyled">
      <li><img src="<?php echo $this->asset ?>img/home/footer/email.png" width="60" ></li>
      <li><a>dentallivramento@gmail.com</a></li>
    </ul>
  </div>
</div>
<div class="col-md-2 col-12">
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d6847.255580887225!2d-55.53170883201511!3d-30.89707181178859!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x95a9fe5966647503%3A0xdb67081fae703184!2sR.+Vasco+Alves%2C+1273+-+Centro%2C+Santana+do+Livramento+-+RS%2C+97574-230%2C+Brasil!5e0!3m2!1spt-PT!2suy!4v1555877983638!5m2!1spt-PT!2suy" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
</div> 
</div>
</div>
</div>
<!-- COPY RIGHT -->
<div class="copyRight clearfix">
<div class="container">
<div class="row">
<div class="col-md-7 col-12">
  <p>&copy; <?php echo date("Y"); ?> Dental Livramento. Desenvolvido por <a target="_blank" href="http://webfrontier.000webhostapp.com/" id="wf" class="fonte-e-cor-top">Web Frontier</a>.</p>
</div>
<div class="col-md-5 col-12">
  <ul class="list-inline">
    <li><img src="<?php echo $this->asset ?>img/home/footer/card1.png"></li>
    <li><img src="<?php echo $this->asset ?>img/home/footer/card2.png"></li>
    <li><img src="<?php echo $this->asset ?>img/home/footer/card3.png"></li>
    <li><img src="<?php echo $this->asset ?>img/home/footer/card4.png"></li>
  </ul>
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
