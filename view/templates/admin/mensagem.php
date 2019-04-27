<div class="content-inner">
    <!-- Page Header-->
    <header class="page-header">
        <div class="container-fluid">
            <h2 class="no-margin-bottom">Administrar Mensagens</h2>
        </div>
    </header>
<section class="dashboard-counts no-padding-bottom">
<div class="container-fluid">
  <div class="col-lg-12">
      <div class="card">
        <div class="card-header d-flex align-items-center" style="background-color:skyblue;overflow:hidden;">
          <h3 class="h4"><span style="color:white">Mensagens</span></h3>
        </div>

        <?php foreach($data['mensagem'] as $mensagem): ?>
        <div class="card">
          <div class="card-close">
            <div style="padding-right: 20px; padding-top: 15px;">
                 <a onclick="return confirm('Você deseja deletar esta mensagem?');" href="<?php echo $this->base_url; ?>MensagemAdmin/deleteMensagem/<?php echo $mensagem->getId_mensagem() ?>" style="color: black"><i class='fa fa-2x fa-remove'></i></a>
            </div>
          </div>
        <div class="card-body" style="margin-bottom:-20px;overflow:hidden;">
          <div class="card-header d-flex align-items-center" style="background-color:#b2bec3;overflow:hidden;">
            <h3 class="h4"><span style="color:white">Mensagem feita dia &nbsp<?php echo date("d/m/Y", strtotime($mensagem->getData()));?></span></h3>
          </div>
          <div class="table-responsive border border-light rounded shadow p-3 mb-5 bg-white" style="overflow:hidden;">
            <div class='container m-3'>
              <strong>E-mail: </strong><a href="mailto:<?php echo $mensagem->getEmail();?>"><?php echo $mensagem->getEmail();?></a>
            </div>
            <div class='container m-3' style='overflow:hidden;display: inline-block !important;'>
              <strong>Mensagem:</strong>
              <p><?php echo $mensagem->getMensagem();?></p>
            </div>
          </div>
        </div>
        </div>
      <?php endforeach; ?>
      </div>
    </div>
</div>
</section>
</div>
