<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>SysMedic</title>

<link type="text/css" href="../../assets/css/bootstrap.min.css" rel="stylesheet">
<!-- <link type="text/css" href="../../assets/css/datepicker3.css" rel="stylesheet"> -->
<link type="text/css" href="../../assets/css/styles.css" rel="stylesheet">
<link type="text/css" href="../../assets/css/font-awesome.css" rel="stylesheet">
<link type="text/css" href="../../assets/css/sweetalert.css" rel="stylesheet">
<link type="text/css" href="../../assets/css/customizacao.css" rel="stylesheet">
<script type="text/javascript" src="../../assets/js/jquery-2.2.3.min.js"></script>
<script type="text/javascript" src="../../assets/js/pags/listar-cidades.js"></script>

<?php 
if(!isset($_GET['pagina']) || ($_GET['pagina'] == '') || ($_GET['pagina'] == 'inicio'))
{
echo
'<!-- Funcionalidades do calendário -->
<link rel="stylesheet" href="../../assets/css/AdminLTE.css">
<link rel="stylesheet" href="../../assets/css/fullcalendar.min.css">';
}
?>


<!-- Icons Base do Template -->
<script src="../../assets/js/lumino.glyphs.js"></script>

<!--[if lt IE 9]>
<script src="../../assets/js/html5shiv.js"></script>
<script src="../../assets/js/respond.min.js"></script>
<![endif]-->

</head>

<body>
	<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#"><span>SysMedic</a></span>
			</div>
							
		</div><!-- /.container-fluid -->
	</nav>
		
	<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
		<form role="search">
		</form>
		<ul class="nav menu">
		<?php
		@session_start();
		switch($_SESSION['usuario']['perfil_id'])
		{
			case 1:
			{
				echo "<li "; echo (!isset($_GET['pagina']) || empty($_GET['pagina']) || $_GET['pagina'] == 'inicio') ? 'class="active"' : '';
				echo "><a href='index'><i class='fa fa-home' aria-hidden='true'></i> Início</a></li>";
				
				echo "<li "; echo (isset($_GET['pagina']) && ($_GET['pagina'] == 'medico/cadastrar')) ? 'class="active"' : '';
				echo "><a href='index?pagina=medico/cadastrar'><i class='fa fa-plus' aria-hidden='true'></i> Cadastrar Médico</a></li>";
				
				echo "<li "; echo (isset($_GET['pagina']) && ($_GET['pagina'] == 'paciente/cadastrar')) ? 'class="active"' : '';
				echo "><a href='index?pagina=paciente/cadastrar'><i class='fa fa-user-plus' aria-hidden='true'></i> Cadastrar Paciente</a></li>";
				
				echo "<li "; echo (isset($_GET['pagina']) && ($_GET['pagina'] == 'paciente/editar')) ? 'class="active"' : '';
				echo "><a href='index?pagina=paciente/editar'><i class='fa fa-pencil-square-o' aria-hidden='true'></i> Editar Paciente</a></li>";

				echo "<li "; echo (isset($_GET['pagina']) && ($_GET['pagina'] == 'secretaria/cadastrar')) ? 'class="active"' : '';
				echo "><a href='index?pagina=secretaria/cadastrar'><i class='fa fa-user-plus' aria-hidden='true'></i> Cadastrar Secretária</a></li>";
				
				echo "<li "; echo (isset($_GET['pagina']) && ($_GET['pagina'] == 'agendamento/cadastrar')) ? 'class="active"' : '';
				echo "><a href='index?pagina=agendamento/cadastrar'><i class='fa fa-calendar-plus-o' aria-hidden='true'></i> Cadastrar Agendamento</a></li>";
				
				echo "<li "; echo (isset($_GET['pagina']) && ($_GET['pagina'] == 'agendamento/visualizar')) ? 'class="active"' : '';
				echo "><a href='index?pagina=agendamento/visualizar'><i class='fa fa-search' aria-hidden='true'></i> Visualizar Agendamento</a></li>";
				
				echo "<li "; echo (isset($_GET['pagina']) && ($_GET['pagina'] == 'agendamentos')) ? 'class="active"' : '';
				echo "><a href='index?pagina=agendamentos'><i class='fa fa-search' aria-hidden='true'></i> Agendamentos</a></li>";
				
				echo "<li "; echo (isset($_GET['pagina']) && ($_GET['pagina'] == 'agendamento/solicitado')) ? 'class="active"' : '';
				echo "><a href='index?pagina=agendamento/solicitado'><i class='fa fa-search' aria-hidden='true'></i> Agendamentos Solicitados</a></li>";
				break;
			}

			case 2:
			{
				echo "<li "; echo (!isset($_GET['pagina']) || empty($_GET['pagina']) || $_GET['pagina'] == 'inicio') ? 'class="active"' : '';
				echo "><a href='index'><i class='fa fa-home' aria-hidden='true'></i> Início</a></li>";
				
				echo "<li "; echo (isset($_GET['pagina']) && ($_GET['pagina'] == 'agendamento/cadastrar')) ? 'class="active"' : '';
				echo "><a href='index?pagina=agendamento/cadastrar'><i class='fa fa-calendar-plus-o' aria-hidden='true'></i> Cadastrar Agendamento</a></li>";
				
				echo "<li "; echo (isset($_GET['pagina']) && ($_GET['pagina'] == 'agendamento/visualizar')) ? 'class="active"' : '';
				echo "><a href='index?pagina=agendamento/visualizar'><i class='fa fa-search' aria-hidden='true'></i> Visualizar Agendamento</a></li>";
				
				echo "<li "; echo (isset($_GET['pagina']) && ($_GET['pagina'] == 'agendamentos')) ? 'class="active"' : '';
				echo "><a href='index?pagina=agendamentos'><i class='fa fa-search' aria-hidden='true'></i> Agendamentos</a></li>";
				break;
			}

			case 3:
			{
				echo "<li "; echo (!isset($_GET['pagina']) || empty($_GET['pagina']) || $_GET['pagina'] == 'inicio') ? 'class="active"' : '';
				echo "><a href='index'><i class='fa fa-home' aria-hidden='true'></i> Início</a></li>";
				
				echo "<li "; echo (isset($_GET['pagina']) && ($_GET['pagina'] == 'paciente/cadastrar')) ? 'class="active"' : '';
				echo "><a href='index?pagina=paciente/cadastrar'><i class='fa fa-user-plus' aria-hidden='true'></i> Cadastrar Paciente</a></li>";
				
				echo "<li "; echo (isset($_GET['pagina']) && ($_GET['pagina'] == 'paciente/editar')) ? 'class="active"' : '';
				echo "><a href='index?pagina=paciente/editar'><i class='fa fa-pencil-square-o' aria-hidden='true'></i> Editar Paciente</a></li>";
				
				echo "<li "; echo (isset($_GET['pagina']) && ($_GET['pagina'] == 'agendamento/cadastrar')) ? 'class="active"' : '';
				echo "><a href='index?pagina=agendamento/cadastrar'><i class='fa fa-calendar-plus-o' aria-hidden='true'></i> Cadastrar Agendamento</a></li>";
				
				echo "<li "; echo (isset($_GET['pagina']) && ($_GET['pagina'] == 'agendamento/visualizar')) ? 'class="active"' : '';
				echo "><a href='index?pagina=agendamento/visualizar'><i class='fa fa-search' aria-hidden='true'></i> Visualizar Agendamento</a></li>";
				
				echo "<li "; echo (isset($_GET['pagina']) && ($_GET['pagina'] == 'agendamentos')) ? 'class="active"' : '';
				echo "><a href='index?pagina=agendamentos'><i class='fa fa-search' aria-hidden='true'></i> Agendamentos</a></li>";
				
				echo "<li "; echo (isset($_GET['pagina']) && ($_GET['pagina'] == 'agendamento/solicitado')) ? 'class="active"' : '';
				echo "><a href='index?pagina=agendamento/solicitado'><i class='fa fa-search' aria-hidden='true'></i> Agendamentos Solicitados</a></li>";
				break;
			}

			case 4:
			{
				echo "<li "; echo (!isset($_GET['pagina']) || empty($_GET['pagina']) || $_GET['pagina'] == 'inicio') ? 'class="active"' : '';
				echo "><a href='index'><i class='fa fa-home' aria-hidden='true'></i> Início</a></li>";

				echo "<li "; echo (isset($_GET['pagina']) && ($_GET['pagina'] == 'agendamento/cadastrar')) ? 'class="active"' : '';
				echo "><a href='index?pagina=agendamento/cadastrar'><i class='fa fa-calendar-plus-o' aria-hidden='true'></i> Cadastrar Agendamento</a></li>";
				
				echo "<li "; echo (isset($_GET['pagina']) && ($_GET['pagina'] == 'agendamento/visualizar')) ? 'class="active"' : '';
				echo "><a href='index?pagina=agendamento/visualizar'><i class='fa fa-search' aria-hidden='true'></i> Visualizar Agendamento</a></li>";
				
				echo "<li "; echo (isset($_GET['pagina']) && ($_GET['pagina'] == 'agendamentos')) ? 'class="active"' : '';
				echo "><a href='index?pagina=agendamentos'><i class='fa fa-search' aria-hidden='true'></i> Agendamentos</a></li>";
				break;
			}
			
			default:
				# code...
				break;
		}
		?>	
			<li><a href='javascript:sair();'><i class='fa fa-search' aria-hidden='true'></i> Sair</a></li>

			<form id="formSair" action="../action/excluir.php" method="POST" accept-charset="utf-8">
				<input type="hidden" name="acao" value="sair">
			</form>
		</ul>

	</div><!--/.sidebar-->
	