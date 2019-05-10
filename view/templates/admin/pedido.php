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

        <?php foreach($data['pedidop'] as $pedido): ?>
        <div class="card-body" style="margin-bottom:-20px;overflow:hidden;">
          <div class="card-header d-flex align-items-center" style="background-color:#b2bec3;overflow:hidden;">
            <h3 class="h4"><span style="color:white">Pedido feito dia &nbsp<?php echo date("d/m/Y", strtotime($pedido[0]->getData()));?>&nbsp por &nbsp<?php echo $pedido[0]->getNome();?></span></h3>
          </div>
          <div class="table-responsive border border-light rounded shadow p-3 mb-5 bg-white" style="overflow:hidden;">
            <div class='container m-3'>
              <strong>Cliente: </strong><?php echo $pedido[0]->getNome();?>
              <br>
              <strong>E-mail: </strong><?php echo $pedido[0]->getEmail();?>
              <br>
              <strong>Telefone: </strong><?php echo $pedido[0]->getTelefone();?>
            </div>
            <?php if($pedido[0]->getEndereco() != ''|| $pedido[0]->getCep() != '' || $pedido[0]->getUf() != '' || $pedido[0]->getCidade() != ''):?>
            <div class='container m-3' style='overflow:hidden;display: inline-block !important;'>
              <?php if($pedido[0]->getEndereco() != ''): ?><strong>Endereço: </strong><?php echo $pedido[0]->getEndereco();?><?php endif; ?>
              &nbsp&nbsp&nbsp<?php if($pedido[0]->getCep() != ''): ?><strong>CEP: </strong><?php echo $pedido[0]->getCep();?><?php endif; ?>
              <br>
              <?php if($pedido[0]->getCidade() != ''): ?><strong>Cidade: </strong><?php echo $pedido[0]->getCidade();?><?php endif; ?>
              &nbsp&nbsp&nbsp<?php if($pedido[0]->getUf() != ''): ?><strong>UF: </strong><?php echo $pedido[0]->getUf();?><?php endif; ?>
            </div>
          <?php endif; ?>
            <?php if($pedido[0]->getMensagem() != ''):?>
            <div class='container m-3' style='overflow:hidden;display: inline-block !important;'>
              <strong>Mensagem:</strong>
              <p><?php echo $pedido[0]->getMensagem();?></p>
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
                <?php foreach($pedido[1] as $k): ?>
                  <tr>
                    <td><?php echo $k["produto"]->getBarcode(); ?></td>
                    <td>
                      <?php echo $k["produto"]->getNome(); ?>
                      <br>
                      <i class='fa fa-arrow-right'></i>&nbsp<?php echo $k["produto"]->getEspecificacao(); ?>
                    </td>
                    <td><?php echo $k["quantidade"] ?></td>
                    <td><?php echo $k["produto"]->getPreco() ?></td>
                    <td><?php echo $k["quantidade"]*$k["produto"]->getPreco() ?></td>

                  </tr>
                <?php endforeach; ?>
                  <tr>
                    <td colspan='5'> <center><strong>PREÇO TOTAL: <?PHP echo $pedido[0]->getPrecototal()?></strong></center></td>
                  </tr>
                  <tr>
                      <td colspan="8"><center><a href="<?php echo $this->base_url; ?>PedidoAdmin/pendenteParaConcluido/<?php echo $pedido[0]->getId_pedido();?>"class="btn btn-success btn-lg btn-block">Concluir pedido</a></center></td>
                  </tr>
              </tbody>
            </table>
          </div>
        </div>

      <?php endforeach; ?>
      </div>
    </div>
</div>
<div class="container-fluid">
  <div class="col-lg-12">
      <div class="card">
        <div class="card-header d-flex align-items-center" style="background-color:#2ecc71;overflow:hidden;">
          <h3 class="h4"><span style="color:white">Pedidos Conclusos</span></h3>
        </div>

        <?php foreach($data['pedidoc'] as $pedido): ?>
        <div class="card">
          <div class="card-close">
            <div style="padding-right: 20px; padding-top: 15px;">
                 <a onclick="return confirm('Você deseja deletar este Pedido?');" href="<?php echo $this->base_url; ?>PedidoAdmin/deletePedido/<?php echo $pedido[0]->getId_pedido() ?>" style="color: black"><i class='fa fa-2x fa-remove'></i></a>
            </div>
          </div>
        <div class="card-body" style="margin-bottom:-20px;overflow:hidden;">
          <div class="card-header d-flex align-items-center" style="background-color:#b2bec3;overflow:hidden;">
            <h3 class="h4"><span style="color:white">Pedido feito dia &nbsp<?php echo date("d/m/Y", strtotime($pedido[0]->getData()));?>&nbsp por &nbsp<?php echo $pedido[0]->getNome();?></span></h3>
          </div>
          <div class="table-responsive border border-light rounded shadow p-3 mb-5 bg-white" style="overflow:hidden;">
            <div class='container m-3'>
              <strong>Cliente: </strong><?php echo $pedido[0]->getNome();?>
              <br>
              <strong>E-mail: </strong><?php echo $pedido[0]->getEmail();?>
              <br>
              <strong>Telefone: </strong><?php echo $pedido[0]->getTelefone();?>
            </div>
            <?php if($pedido[0]->getEndereco() != ''|| $pedido[0]->getCep() != '' || $pedido[0]->getUf() != '' || $pedido[0]->getCidade() != ''):?>
            <div class='container m-3' style='overflow:hidden;display: inline-block !important;'>
              <?php if($pedido[0]->getEndereco() != ''): ?><strong>Endereço: </strong><?php echo $pedido[0]->getEndereco();?><?php endif; ?>
              &nbsp&nbsp&nbsp<?php if($pedido[0]->getCep() != ''): ?><strong>CEP: </strong><?php echo $pedido[0]->getCep();?><?php endif; ?>
              <br>
              <?php if($pedido[0]->getCidade() != ''): ?><strong>Cidade: </strong><?php echo $pedido[0]->getCidade();?><?php endif; ?>
              &nbsp&nbsp&nbsp<?php if($pedido[0]->getUf() != ''): ?><strong>UF: </strong><?php echo $pedido[0]->getUf();?><?php endif; ?>
            </div>
          <?php endif; ?>
            <?php if($pedido[0]->getMensagem() != ''):?>
            <div class='container m-3' style='overflow:hidden;display: inline-block !important;'>
              <strong>Mensagem:</strong>
              <p><?php echo $pedido[0]->getMensagem();?></p>
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
                <?php foreach($pedido[1] as $k): ?>
                  <tr>
                    <td>
                      <?php echo $k["produto"]->getNome(); ?>
                      <br>
                      <i class='fa fa-arrow-right'></i>&nbsp<?php echo $k["produto"]->getEspecificacao(); ?>
                    </td>
                    <td><?php echo $k["produto"]->getBarcode(); ?></td>
                    <td><?php echo $k["quantidade"] ?></td>
                    <td><?php echo $k["produto"]->getPreco() ?></td>
                    <td><?php echo $k["quantidade"]*$k["produto"]->getPreco() ?></td>

                  </tr>
                <?php endforeach; ?>
                  <tr>
                    <td colspan='5'> <center><strong>PREÇO TOTAL: <?PHP echo $pedido[0]->getPrecototal()?></strong></center></td>
                  </tr>
              </tbody>
            </table>
          </div>
        </div>
        </div>
      <?php endforeach; ?>
      </div>
    </div>
</div>
