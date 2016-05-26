<?php
require_once('../controller/PermissaoController.php');
$controller = new PermissaoController();

// Verifica qual é o perfil para atribuir a página início
switch($_SESSION['usuario']['perfil_id'])
{
	case 1:
	{
		$inicio = 'inicio/administrador.php';
		break;
	}

	case 2:
	{
		$inicio = 'inicio/medico.php';
		break;
	}

	case 3:
	{
		$inicio = 'inicio/secretaria.php';
		break;
	}

	case 4:
	{
		$inicio = 'inicio/paciente.php';
		break;
	}
}

if(!isset($_GET['pagina']))
{
	require_once("$inicio");
}
elseif(empty($_GET['pagina']))
{
	require_once("$inicio");
}
else
{
	switch($_GET['pagina'])
	{
		case 'inicio':
		{
			require_once("$inicio");
			break;
		}

		case 'paciente/cadastrar':
		{
			require_once('paciente-cadastrar.php');
			break;
		}

		case "paciente/editar":
		{
			require_once('paciente-editar.php');
			break;
		}
		
		case "agendamento/cadastrar":
		{
			require_once('agendamento-cadastrar.php');
			break;
		}

		case "agendamento/visualizar":
		{
			require_once('agendamento-visualizar.php');
			break;
		}

		case "medico/cadastrar":
		{
			require_once('medico-cadastrar.php');
			break;
		}

		case "agendamentos":
		{
			require_once('agendamentos.php');
			break;
		}

		case "agendamento/solicitado":
		{
			require_once('agendamento-solicitado.php');
			break;
		}
		
		default:
		{
			echo 'pagina não existe';
			break;
		}
	}
}