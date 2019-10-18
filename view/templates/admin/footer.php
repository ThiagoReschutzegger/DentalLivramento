<!-- Page Footer-->
<!--<footer class="main-footer">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-6">
        <p>Your company &copy; 2017-2019</p>
      </div>
      <div class="col-sm-6 text-right">
        <p>Design by <a href="https://bootstrapious.com/p/admin-template" class="external">Bootstrapious</a></p>
        </div>
    </div>
  </div>
</footer>-->
</div>
</div>
</div>
<!-- JavaScript files-->
<script src="<?php echo $this->asset; ?>vendor/jquery/jquery.min.js"></script>
<script src="<?php echo $this->asset; ?>vendor/popper.js/umd/popper.min.js"> </script>
<script src="<?php echo $this->asset; ?>vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo $this->asset; ?>vendor/jquery.cookie/jquery.cookie.js"> </script>
<script src="<?php echo $this->asset; ?>vendor/chart.js/Chart.min.js"></script>
<script src="<?php echo $this->asset; ?>vendor/jquery-validation/jquery.validate.min.js"></script>
<script src="<?php echo $this->asset; ?>js/charts-home.js"></script>
<!-- Main File-->
<script src="<?php echo $this->asset; ?>js/front.js"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
    <script type="text/javascript">
        function sendTXT() {
            Swal.fire({
              imageUrl: 'https://futeinvest.com/wp-content/uploads/carta-novaampulheta.gif',
              title: 'Atualizando... Aguarde!',
              showConfirmButton: false,
              showCloseButton: false,
              imageWidth: 200,
              imageHeight: 200,
              imageAlt: 'loading',
            })
        };
    </script>
</body>
</html>
