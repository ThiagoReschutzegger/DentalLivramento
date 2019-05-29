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
  <?php if($data['packproduto'] == 'password'):?>
    <div class="col-sm-12">
      <div class="media flex-wrap productBox">
        <div class="media-body">
          <h4 class="media-heading">Não foi encontrado nenhum produto com este nome!</h4>
        </div>
      </div>
    </div>
  <?php else:
    $ids_aux = [];
   foreach ($data['packproduto'] as $produtos):
     if(in_array($produtos->getId_subgrupo(), $ids_aux)) continue; else $ids_aux[] = $produtos->getId_subgrupo();
     ?>
  <div class="col-sm-6">
    <div class="media flex-wrap productBox">
      <div class="media-left">
        <a href="<?php echo $this->base_url; ?>Home/viewProduto/<?php echo $produtos->getId_subgrupo(); ?>">
        <div class="productImage clearfix">
          <img src="<?php echo $produtos->getImagem(); ?>" alt="products-img">
          <div class="productMasking">
          </div>
        </div>
      </a>
      </div>
      <div class="media-body" onclick="location.href='<?php echo $this->base_url; ?>Home/viewProduto/<?php echo $produtos->getId_subgrupo(); ?>';" style="cursor: pointer;">
        <h4 class="media-heading"><?php echo $produtos->getNome(); ?></h4>
        <p><?php echo mb_substr($produtos->getDescricao(), 0, 100, 'UTF-8')."...";  ?></p>
        <h3>R$ <?php echo $data[$produtos->getId_subgrupo()]; ?></h3>
      </div>
    </div>
  </div>
<?php endforeach; endif; ?>
</div>
</div>

</div>
