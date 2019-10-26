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
      <li>Sant'ana do Livramento - RS</li>
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
<div class="row col-sm-12 col-md-8 heightiado" height="400px" style="border:0; margin-left: 0vw; background: url('<?php echo $this->asset; ?>img/maps.png'); background-size: cover; cursor: pointer; background-position: center center;" onclick="window.open('https://goo.gl/maps/YXtkNTJjGjZsRFpM6');"></div>
</div>
<div class="row" style="margin-top: 30px">
<div class="col-md-4 col-12">
  <div class="footerLink">
    <h5 style="font-size: 18px; margin-bottom: 20px;">Mande uma mensagem</h5>
    <div class="">
      <form method="post" action="<?php echo $this->base_url; ?>Home/addMensagem">
        <input name="email-msg" type="email" class="form-control" placeholder="Seu e-mail" style="background-color: #3b3b3b; color: white; border-color: #505050; margin-bottom: 15px;">
        <textarea name="mensagem-msg" class="form-control" placeholder="Escreva a mensagem aqui" style="background-color: #3b3b3b; color: white; border-color: #505050; margin-bottom: 15px;"></textarea>
        <input type="submit" name="enviar-msg" value="Enviar" class="btn btn-primary-outlined">
      </form>
    </div>
  </div>
</div>
<div class="col-md-3 col-lg-2 col-12">
  <div class="footerLink">
    <h5 style="font-size: 18px;">Siga-nos</h5>
    <ul class="list-unstyled" style="letter-spacing: 2px;">
      <li style="padding-top: 10px"><a href="https://www.facebook.com/DentalLivramento/" target="_blank" style=" font-size: 1.2em;"><i class="fa fa-facebook-square"></i> FACEBOOK</a></li>
      <li style="padding-top: 10px"><a href="https://www.instagram.com/dentallivramento/" target="_blank" style=" font-size: 1.2em;"><i class="fa fa-instagram"></i> INSTAGRAM</a></li>
    </ul>
  </div>
</div>
<div class="col-md-2 col-12">
  <div class="footerLink">
    <h5 style="font-size: 18px;">A empresa</h5>
    <div class="footerLink" style="padding-top: 10px;">
      <a data-toggle="modal" href=".view-Empresa"  class="btn btn-primary-outlined" style="font-size: 1em; width: 90px; padding: 0;">Saiba mais</a>
    </div>
  </div>
</div>
<div class="col-md-3 col-lg-4 col-sm-3">
  <div class="footerLink">
    <h5 style="font-size: 18px;">Algum erro?</h5>
      <ul class="list-unstyled" style="color: #acacac; font-size: 1.2em;">
          <li style="line-height: 21px">
              <i class="fa fa-warning"></i> <b>Entre em Contato!</b>
              Estamos trabalhando para proporcionar a você uma ótima experiência.
          </li>
          <li style="padding-top: 5px; line-height: 21px">
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

<!-- PORDUCT QUICK VIEW MODAL -->
<div class="modal fade quick-view-drone view-Empresa" tabindex="-1" role="dialog">
<div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-body">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
      <div class="media flex-wrap">
        <div class="media-body">
          <!-- FEATURE -->
          <div class="row features boxes-index">
            <div class="col-12">
              <div class="box text-center box-v2" style="border: solid 1px; border-color: #f5f5f5; background-color: #fff; margin-top: 20px;">
                <i class="fa fa-building" aria-hidden="true"></i>
                <h4>A Empresa </h4>
                <span>Aqui na <b>Dental Livramento</b> nossos clientes vêm em primeiro lugar!
                  Possuímos diversas especialidades, equipamentos e materiais de última geração, além do atendimento capacitado.
                </span>
              </div>
            </div>
            <div class="col-12">
              <div class="box text-center box-v2" style="border: solid 1px; border-color: #f5f5f5; background-color: #fff;">
                <i class="fa fa-flag" aria-hidden="true"></i>
                <h4>As melhores Marcas</h4><br>
                <span>Temos as marcas mais renomadas e conhecidas do mercado.
                      Confira nossos produtos e escolha a sua!<br><br>
                </span>
              </div>
            </div>
            <div class="col-12">
              <div class="box text-center box-v2" style="border: solid 1px; border-color: #f5f5f5; background-color: #fff;">
                <i class="fa fa-desktop" aria-hidden="true"></i>
                <h4>Cara nova</h4>
                <span>A <b>Dental Livramento</b> está sempre pensando em você, por isso está de
                      de cara nova, para proporcinar a você uma experiência ainda melhor!<br>
                      Aproveite e explore as novas facilidades!
                </span>
              </div>
            </div>
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
<script src="<?php echo $this->asset ?>plugins/slider-zoom/jquery.exzoom.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.js"></script>
<script src="<?php echo $this->asset ?>js/mmenu.polyfills.js"></script>
<script src="<?php echo $this->asset ?>js/mmenu.js"></script>
<script>

	new Mmenu(
		document.querySelector('#menu'),
		{
					extensions	: ['theme-black','shadow-page',"pagedim-black"],
          slidingsubmenus: false,
					setSelected	: true,
					counters	: true,
					searchfield : {
						placeholder		: 'Pesquisar no site'
					},
					iconbar		: {
						use 		: '(min-width: 10000px)',
						top 		: [
							'<a href="#/"><span class="fa fa-bars"></span></a>'
						],
						bottom 		: [
							'<a href="https://www.facebook.com/DentalLivramento/"><span class="fa fa-facebook"></span></a>',
							'<a href="https://www.instagram.com/dentallivramento/"><span class="fa fa-instagram"></span></a>'
						]
					},
					sidebar		: {
						collapsed		: {
							use 			: '(min-width: 10000px)',
							hideNavbar		: true,
							hideDivider		: true  
						},
						expanded		: {
							use 			: '(min-width: 10000px)',
                                                        initial                 : 'close'
						}
					},
					navbars		: [
						{
							content		: [ 'searchfield' ]
						}, {
							content		: [ 'prev', 'breadcrumbs', 'close' ]
						}
					]
				}, {
					searchfield : {
						clear 		: true
					},
					navbars		: {
						breadcrumbs	: {
							removeFirst	: true
						}
					}
				}
			);

			document.addEventListener( 'click', function( evnt ) {
				var anchor = evnt.target.closest( 'a[href^="#/"]' );
				if ( anchor ) {
					evnt.preventDefault();
				}
			});
</script>
<script type="text/javascript">

  function eventFire(el, etype){
    if (el.fireEvent) {
      el.fireEvent('on' + etype);
    } else {
      var evObj = document.createEvent('Events');
      evObj.initEvent(etype, true, false);
      el.dispatchEvent(evObj);
    }
  }
  
    function openCategoria(id_categoria){
       eventFire(document.getElementById('openMenu'), 'click');
       setTimeout(function() {
           var element = $(":first-child", document.getElementById('cat-'+id_categoria))[0];
            eventFire(element, 'click');
        },600);
       
   }

    $( document ).ready(function() {
        $( "#teste" ).click(function() {
            $("#teste2").toggle();
        });
        $('.ddd_tel').mask('(99) 99999-9999');
        $('.cep').mask('99999-999');
        $(".eapps-remove-link").css({ 'background-color' : '', 'opacity' : '0' });

        eventFire(document.getElementsByClassName('mm-btn mm-btn_close mm-navbar__btn')[0], 'click');


        
    });


</script>

<!-- Compiled and minified CSS -->
<link rel="stylesheet" href="<?php echo $this->asset ?>plugins/slider_new/default.css">

<!-- Compiled and minified JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>
<script src="<?php echo $this->asset ?>plugins/slider_new/default.js"></script>

</body>
</html>
