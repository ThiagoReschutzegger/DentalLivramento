<style type="text/css" scoped>
#container {
    background: #DDD;
    max-width: 1400px;
}
.item {
    width: 200px;
    float: left;
}
.item img {
    display: block;
    width: 100%;
}
button {
    font-size: 18px;
}
.container{
    width:100%;
}

/*********************** Demo - 12 *******************/
.box12{position:relative}
.box12 .box-content,.box12:after{position:absolute;transition:all .3s ease 0s}
.box12:after{content:"";width:65%;background:rgba(28,28,28,.8);padding-bottom:65%;opacity:0;top:50%;left:50%;transform:rotate(0) translate(-50%,-50%);transform-origin:0 0 0}
.box12:hover:after{transform:rotate(-45deg) translate(-50%,-50%);opacity:1}
.box12 img{width:100%;height:auto}
.box12 .box-content{width:100%;top:35%;left:0;opacity:0;z-index:1}
.box12:hover .box-content{opacity:1}
.box12 .title{padding:10px 0;color:#fff;margin:0;border-top:2px solid #fff;border-bottom:2px solid #fff}
.box12 .icons{padding:0;margin:12px 0 0;list-style:none}
.box12 .icons li a{display:block;width:35px;height:35px;line-height:35px;font-size:18px;color:#fff;margin-right:10px;transition:all .3s ease 0s}
@media only screen and (max-width:990px){.box12{margin-bottom:20px}
}
</style>

<script type="text/javascript">
function copyInput(id) {
  var copyText = document.getElementById("input"+id);
  copyText.select();
  document.execCommand("copy");
}
</script>

<div class="content-inner">
    <!-- Page Header-->
    <header class="page-header">
        <div class="container-fluid">
            <h2 class="no-margin-bottom">Fotos</h2>
        </div>
    </header>
    <!-- Dashboard Counts Section-->
    <section class="dashboard-counts no-padding-bottom">
        <div class="container-fluid">
            <div class="row bg-white has-shadow">
              <div id="container"></div>
              <div id="images">
                <div class="row"><!-- colocar row ou nao -->
                <div class="item">
                  <center>
                  <div class="item d-flex align-items-center" style="border: 0; padding: 80px; padding-top: 50px;">
                    <a href="<?php echo $this->base_url; ?>FotoAdmin/addFoto">
                      <center>
                        <div class="icon bg-green" style="margin-top: 15px;"><i class="fa fa-plus"></i></div>
                      </center>
                      </a>
                  </div>
                </center>
                </div>

                <?php foreach ($data['fotos'] as $foto): ?>
                  <div class="box12 item" style="text-align: center;">
                      <img src="<?php echo $this->base_url; ?>view/images/<?php echo $foto->getSrc(); ?>">
                      <div class="box-content">
                        <input type="text" class="title" value="localhost<?php echo $this->base_url; ?>view/images/<?php echo $foto->getSrc(); ?>" id="input<?php echo $foto->getId_foto();?>" style="width: 100px; height: 20px; font-size: 10px"/>
                        <ul class="icons"><center>
                            <li><a onclick="copyInput('<?php echo $foto->getId_foto();?>')"><i class="fa fa-copy"></i></a></li>
                        </center></ul>
                      </div>
                  </div>
              <?php endforeach; ?>
            </div>
            </div>

            </div>
        </div>

    </section>
</div>
