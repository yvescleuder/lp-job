<?php
require_once('../controller/PermissaoController.php');
$controller = new PermissaoController();
$controller->AdministradorSecretaria(); 
require_once('header.php');
?>
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#"><i class="fa fa-home" aria-hidden="true"></i></a></li>
				<li class="active">Agendamentos Solicitados</li>
			</ol>
		</div><!--/.row-->
		<form id="formProximosAgendamentos" action="../action/listar.php" method="POST">
			<input type="hidden" name="acao" value="listarAgendamento">
		</form>

					
		<div class="row" id="divAgendamentoSolicitado">
	        <div class="col-xs-12">
	          <div class="panel panel-default">
	            <div class="panel-body">
	              <table id="tabelaAgendamentoSolicitado" data-toggle="table" data-url="../../app/action/listar.php?acao=listarAgendamentoSolicitado" data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name" data-sort-order="desc">
	                  <thead>
	                  <tr>
	                      <th data-field="id" data-sortable="true">Nº</th>
	                      <th data-field="paciente" data-sortable="true">Paciente</th>
	                      <th data-field="hora" data-sortable="true">Horário</th>
	                      <th data-field="tipoNome" data-sortable="true">Tipo</th>
	                      <th data-field="button" data-sortable="true">Ação</th>
	                  </tr>
	                  </thead>
	              </table>
	            </div>
	          </div>
	        </div>
		</div><!--/.row-->
	</div>	<!--/.main-->
<?php require_once('footer.php'); ?>
	<!-- Funcionalidades para as Tabelas -->
	<link type="text/css" href="../../assets/css/bootstrap-table.css" rel="stylesheet">
	<script type="text/javascript" src="../../assets/js/bootstrap-table.js"></script>
	<script type="text/javascript" src="../../assets/js/pags/agendamento-solicitado.js"></script>
</body>
</html>