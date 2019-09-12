<style type="text/css" scoped>
        
        .back-sub:hover {
            font-size: 1.2em;
            transition: all 0.1s ease-in-out;
          }
        .back-sub {
            background:
            linear-gradient(
              rgba(0, 186, 250, 0.7), /*0, 150, 185, 0.5 */
              rgba(0, 220, 255, 0.3)  /*0, 220, 255, 0.5*/
              ),
            url("<?php echo $this->asset;?>img/pattern-dental.jpg");
            background-size: cover;
            background-position: center center;
            background-repeat: no-repeat;
            height: 130px !important;
            border-radius: 15px;
            cursor: pointer;
          } 
</style>
<div class="mainContent clearfix home-v5">
<!-- ORDER -->
<div class="order" style="margin-bottom:50px;">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8 text-center">
        <div class="sectionTitle">
          <h2>Área de pesquisa</h2>
          <div class="">
            <form method="post">
              <input name="texto-psq" type="text" class="form-control" placeholder="Sua pesquisa..." aria-describedby="basic-addon2" <?php if(!$data['texto']=='') echo'value="'.$data['texto'].'"'; ?>>
              <input type="submit" name="pesquisar" value="Pesquisar" class="btn order-btn" id="basic-addon12">
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="container">
<div class="row productListSingle">
  <?php if($data['modelo'] == ''):?>
    <div class="col-sm-12">
      <div class="media flex-wrap productBox">
        <div class="media-body">
          <h4 class="media-heading">Não foi encontrado nenhum produto com este nome!</h4>
        </div>
      </div>
    </div>
  <?php else:
      if ($data['modelo'] == 'SearchDeProduto'):  
        foreach ($data['item'] as $item):
          if($item->getId_subgrupo() != $data['subgrupo']->getId_subgrupo()) continue;
     ?>
  <div class="col-sm-6">
    <div class="media flex-wrap productBox">
      <div class="media-left">
        <a href="<?php echo $this->base_url; ?>Home/viewProduto/<?php echo $item->getId_item(); ?>">
        <div class="productImage clearfix">
          <img src="<?php if($item->getImagem() != "") echo $item->getImagem(); else echo $this->base_url."view/images/produto-sem-imagem.gif"; ?>" alt="products-img">
          <div class="productMasking">
          </div>
        </div>
      </a>
      </div>
      <div class="media-body" onclick="location.href='<?php echo $this->base_url; ?>Home/viewProduto/<?php echo $item->getId_item(); ?>';" style="cursor: pointer;">
        <h4 class="media-heading"><?php echo $data['subgrupo']->getNome(); ?></h4>
        <p><?php echo mb_substr($item->getDescricao(), 0, 100, 'UTF-8')."...";  ?></p>
        <h3>R$ <?php echo  number_format($data['preco_min'.$item->getId_marca()], 2); ?></h3>
      </div>
    </div>
  </div>
<?php endforeach; elseif($data['modelo'] == 'SearchDeSubgrupo'): 
    foreach ($data['subgrupo'] as $subgrupo): ;?>
    <div class="col-md-6 col-lg-4" style="margin-bottom: 50px">
                <div class="productBox">
                    <div class="productImage clearfix back-sub" onclick="location.href='<?php echo $this->base_url."Loja/view/".$subgrupo->getId_subgrupo(); ?>';">
                          <center>
                              <h2 style="font-size: 2.5em; font-wheight: lighter; color: white; padding-top: 30px; font-variant-caps: all-petite-caps;">
                                  <?php echo $subgrupo->getNome(); ?>
                              </h2>
                          </center>
                      </div>
                  </div>
              </div>
    <?php endforeach; endif; endif; ?>
</div>
</div>

</div>
