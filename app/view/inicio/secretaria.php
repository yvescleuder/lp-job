<?php
require_once('../controller/PermissaoController.php');
$controller = new PermissaoController();
$controller->secretaria(); 
require_once('header.php');
?>
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#"><i class="fa fa-home" aria-hidden="true"></i></a></li>
				<li class="active">Início</li>
			</ol>
		</div><!--/.row-->
		<section class="content" id="divGeral">
      <div class="row" align="center">
        <div class="col-md-12">
          <h3>
                SysMedic
                <small>Calendário</small>
            </h3>
        </div>
      </div><!--/.row-->

      <div class="row">
        <div class="col-md-3">
          <div class="box box-solid">
            <div class="box-header with-border">
              <h4 class="box-title">Tipo de Agendamento</h4>
            </div>
            <div class="box-body">
              <!-- the events -->
              <div id="external-events">
                <div class="external-event bg-yellow">Retorno</div>
                <div class="external-event bg-blue">Consulta</div>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <div class="box box-solid">
            <div class="box-header with-border">
              <h4 class="box-title">Agendamentos de hoje</h4>
            </div>
            <div class="box-body">
              <!-- the events -->
              <div id="external-events">
                <center>
                  <button id="botaoVisualizarAgendamentoHoje" type="submit" class="btn btn-success">Visualizar</button>
                  <span class="loading hide">
                    <img src="../../assets/img/load.gif" alt="Carregando...">
                  </span>
                </center>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /. box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="box box-primary">
            <div class="box-body no-padding">
              <!-- THE CALENDAR -->
              <div id="calendar"></div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /. box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    
    <section id="divAgendamentoDoDia" class="hidden">
      <div class="row" align="center">
        <div class="col-md-12">
          <h3>
                SysMedic
                <small>Agendamentos de hoje (<?php echo date('d/m/Y')?>)</small>
            </h3>
        </div>
      </div><!--/.row-->
      <div class="row">
        <div class="col-lg-12">
          <div class="panel panel-default">
            <div class="panel-body">
              <table data-toggle="table" data-url="../../app/action/listar.php?acao=listarAgendamentoHoje" data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name" data-sort-order="desc">
                  <thead>
                  <tr>
                      <th data-field="id" data-sortable="true">Nº</th>
                      <th data-field="medico" data-sortable="true">Médico</th>
                      <th data-field="paciente" data-sortable="true">Paciente</th>
                      <th data-field="hora" data-sortable="true">Horário</th>
                      <th data-field="tipoNome" data-sortable="true">Tipo</th>
                  </tr>
                  </thead>
              </table>
            </div>
          </div>
        </div>
      </div><!--/.row-->
    </section>
	</div>	<!--/.main-->
<?php require_once('footer.php'); ?>
  <!-- Funcionalidades para as Tabelas -->
  <link type="text/css" href="../../assets/css/bootstrap-table.css" rel="stylesheet">
  <script type="text/javascript" src="../../assets/js/bootstrap-table.js"></script>

	<script type="text/javascript" src="../../assets/js/pags/inicio/secretaria.js"></script>

  <!-- Funcionalidades para o Calendário -->
  <script src="../../assets/js/jquery-ui.min.js"></script>
  <script src="../../assets/js/moment.min.js"></script>
  <script src="../../assets/js/fullcalendar/fullcalendar.min.js"></script>
</body>
</html>
