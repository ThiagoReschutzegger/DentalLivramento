<div class="content-inner">
    <!-- Page Header-->
    <header class="page-header">
        <div class="container-fluid">
            <h2 class="no-margin-bottom">Administrar pedidos</h2>
        </div>
    </header>
<section class="dashboard-counts no-padding-bottom">
<div class="container-fluid">
  <div class="col-lg-12">
      <div class="card">
        <div class="card-header d-flex align-items-center" style="background-color:#f64747;overflow:hidden;">
          <h3 class="h4"><span style="color:white">Pedidos pendentes</span></h3>
        </div>

        <?php
        if(!empty($data['pedidop'])):
        foreach($data['pedidop'] as $pedido): ?>
        <div class="card-body" style="margin-bottom:-20px;overflow:hidden;">
          <div class="card-header d-flex align-items-center" style="background-color:#b2bec3;overflow:hidden;">
            <h3 class="h4"><span style="color:white">Pedido feito dia &nbsp<?php echo date("d/m/Y", strtotime($pedido->getData()));?>&nbsp por &nbsp<?php echo $pedido->getNome();?></span></h3>
          </div>
          <div class="table-responsive border border-light rounded shadow p-3 mb-5 bg-white" style="overflow:hidden;">
            <div class='container m-3'>
              <strong>Cliente: </strong><?php echo $pedido->getNome();?>
              <br>
              <strong>E-mail: </strong><?php echo $pedido->getEmail();?>
              <br>
              <strong>Telefone: </strong><?php echo $pedido->getTelefone();?>
            </div>
            <?php if($pedido->getEndereco() != ''|| $pedido->getCep() != '' || $pedido->getUf() != '' || $pedido->getCidade() != ''):?>
            <div class='container m-3' style='overflow:hidden;display: inline-block !important;'>
              <?php if($pedido->getEndereco() != ''): ?><strong>Endereço: </strong><?php echo $pedido->getEndereco();?><?php endif; ?>
              &nbsp&nbsp&nbsp<?php if($pedido->getCep() != ''): ?><strong>CEP: </strong><?php echo $pedido->getCep();?><?php endif; ?>
              <br>
              <?php if($pedido->getCidade() != ''): ?><strong>Cidade: </strong><?php echo $pedido->getCidade();?><?php endif; ?>
              &nbsp&nbsp&nbsp<?php if($pedido->getUf() != ''): ?><strong>UF: </strong><?php echo $pedido->getUf();?><?php endif; ?>
            </div>
          <?php endif; ?>
            <?php if($pedido->getMensagem() != ''):?>
            <div class='container m-3' style='overflow:hidden;display: inline-block !important;'>
              <strong>Mensagem:</strong>
              <p><?php echo $pedido->getMensagem();?></p>
            </div>
            <?php endif; ?>

            <table class="table table-striped" style="overflow:hidden;">
              <thead>
                <th>Código de barras</th>
                <th>Produto</th>
                <th>Quantidade</th>
                <th>Preço Unit.</th>
                <th>Preço</th>
              </thead>
              <tbody>
                <?php foreach($data['prods-pendente'.$pedido->getId_pedido()] as $prod): ?>
                  <tr>
                    <td><?php echo $prod->getBarcode(); ?></td>
                    <td>
                      <?php echo $data['sub-nome-pendente'.$prod->getId_produto().$pedido->getId_pedido()]; ?>
                      <br>
                      <i class='fa fa-arrow-right'></i>&nbsp<?php echo $prod->getEspecificacao(); ?>
                    </td>
                    <td><?php echo $data['qtd-pendente'.$prod->getBarcode().$pedido->getId_pedido()] ?></td>
                    <td><?php echo $prod->getPreco() ?></td>
                    <td><?php echo $data['qtd-pendente'.$prod->getBarcode().$pedido->getId_pedido()]*$prod->getPreco() ?></td>

                  </tr>
                <?php endforeach; ?>
                  <tr>
                    <td colspan='5'> <center><strong>PREÇO TOTAL: <?PHP echo $pedido->getPrecototal()?></strong></center></td>
                  </tr>
                  <tr>
                      <td colspan="8"><center><a href="<?php echo $this->base_url; ?>PedidoAdmin/pendenteParaConcluido/<?php echo $pedido->getId_pedido();?>"class="btn btn-success btn-lg btn-block">Concluir pedido</a></center></td>
                  </tr>
              </tbody>
            </table>
          </div>
        </div>

      <?php endforeach; endif; ?>
      </div>
    </div>
</div>
<div class="container-fluid">
  <div class="col-lg-12">
      <div class="card">
        <div class="card-header d-flex align-items-center" style="background-color:#2ecc71;overflow:hidden;">
          <h3 class="h4"><span style="color:white">Pedidos Conclusos</span></h3>
        </div>

        <?php
        if(!empty($data['pedidoc'])):
        foreach($data['pedidoc'] as $pedido): ?>
        <div class="card">
          <div class="card-close">
            <div style="padding-right: 20px; padding-top: 15px;">
                 <a onclick="return confirm('Você deseja deletar este Pedido?');" href="<?php echo $this->base_url; ?>PedidoAdmin/deletePedido/<?php echo $pedido->getId_pedido() ?>" style="color: black"><i class='fa fa-2x fa-remove'></i></a>
            </div>
          </div>
        <div class="card-body" style="margin-bottom:-20px;overflow:hidden;">
          <div class="card-header d-flex align-items-center" style="background-color:#b2bec3;overflow:hidden;">
            <h3 class="h4"><span style="color:white">Pedido feito dia &nbsp<?php echo date("d/m/Y", strtotime($pedido->getData()));?>&nbsp por &nbsp<?php echo $pedido->getNome();?></span></h3>
          </div>
          <div class="table-responsive border border-light rounded shadow p-3 mb-5 bg-white" style="overflow:hidden;">
            <div class='container m-3'>
              <strong>Cliente: </strong><?php echo $pedido->getNome();?>
              <br>
              <strong>E-mail: </strong><?php echo $pedido->getEmail();?>
              <br>
              <strong>Telefone: </strong><?php echo $pedido->getTelefone();?>
            </div>
            <?php if($pedido->getEndereco() != ''|| $pedido->getCep() != '' || $pedido->getUf() != '' || $pedido->getCidade() != ''):?>
            <div class='container m-3' style='overflow:hidden;display: inline-block !important;'>
              <?php if($pedido->getEndereco() != ''): ?><strong>Endereço: </strong><?php echo $pedido->getEndereco();?><?php endif; ?>
              &nbsp&nbsp&nbsp<?php if($pedido->getCep() != ''): ?><strong>CEP: </strong><?php echo $pedido->getCep();?><?php endif; ?>
              <br>
              <?php if($pedido->getCidade() != ''): ?><strong>Cidade: </strong><?php echo $pedido->getCidade();?><?php endif; ?>
              &nbsp&nbsp&nbsp<?php if($pedido->getUf() != ''): ?><strong>UF: </strong><?php echo $pedido->getUf();?><?php endif; ?>
            </div>
          <?php endif; ?>
            <?php if($pedido->getMensagem() != ''):?>
            <div class='container m-3' style='overflow:hidden;display: inline-block !important;'>
              <strong>Mensagem:</strong>
              <p><?php echo $pedido->getMensagem();?></p>
            </div>
            <?php endif; ?>

            <table class="table table-striped" style="overflow:hidden;">
              <thead>
                <th>Código de barras</th>
                <th>Produto</th>
                <th>Quantidade</th>
                <th>Preço Unit.</th>
                <th>Preço</th>
              </thead>
              <tbody>
                <?php foreach($data['prods-concluso'.$pedido->getId_pedido()] as $prod): ?>
                  <tr>
                    <td><?php echo $prod->getBarcode(); ?></td>
                    <td>
                      <?php echo $data['sub-nome-concluso'.$prod->getId_produto().$pedido->getId_pedido()]; ?>
                      <br>
                      <i class='fa fa-arrow-right'></i>&nbsp<?php echo $prod->getEspecificacao(); ?>
                    </td>
                    <td><?php echo $data['qtd-concluso'.$prod->getBarcode().$pedido->getId_pedido()] ?></td>
                    <td><?php echo $prod->getPreco() ?></td>
                    <td><?php echo $data['qtd-concluso'.$prod->getBarcode().$pedido->getId_pedido()]*$prod->getPreco() ?></td>

                  </tr>
                <?php endforeach; ?>
                  <tr>
                    <td colspan='5'> <center><strong>PREÇO TOTAL: <?PHP echo $pedido->getPrecototal()?></strong></center></td>
                  </tr>
                  <tr>
                      <td colspan="8"><center><a href="<?php echo $this->base_url; ?>PedidoAdmin/txtPedidoConcluido/<?php echo $pedido->getId_pedido();?>"class="btn btn-info btn-lg btn-block">Baixar arquivo para sistema</a></center></td>
                  </tr>
              </tbody>
            </table>
          </div>
        </div>
        </div>
      <?php endforeach; endif; ?>
      </div>
    </div>
</div>
