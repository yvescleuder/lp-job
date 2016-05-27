<?php

require_once('../controller/ConvenioController.php');
require_once('../controller/UsuarioController.php');
require_once('../controller/EspecialidadeController.php');
require_once('../controller/AgendamentoController.php');
require_once('../controller/EstadoController.php');
require_once('../controller/CidadeController.php');

if(isset($_POST['acao']))
{
	$acao = $_POST['acao'];
}
elseif(isset($_GET['acao']))
{
	$acao = $_GET['acao'];
}
else
{
 	$acao = '';
} 

switch($acao)
{
	case "listarConvenio":
	{
		$controller = new ConvenioController();
		echo json_encode($controller->listar());
		break;
	}

	case "buscarPaciente":
	{
		$controller = new UsuarioController();
		echo json_encode($controller->buscarPaciente());
		break;
	}

	case "listarConvenioEditar":
	{
		$controller = new ConvenioController();
		echo json_encode($controller->listarEditar());
		break;
	}

	case "listarEspecialidade":
	{
		$controller = new EspecialidadeController();
		echo json_encode($controller->listar());
		break;
	}

	case "listarMedico":
	{
		$controller = new UsuarioController();
		echo json_encode($controller->listarMedico());
		break;
	}

	case "buscarAgendamento":
	{
		$controller = new AgendamentoController();
		echo json_encode($controller->verificarExiste());
		break;
	}

	case "buscarDadosAgendamento":
	{
		$controller = new AgendamentoController();
		echo json_encode($controller->buscarPorCodigo());
		break;
	}

	case "listarAgendamento":
	{
		$controller = new AgendamentoController();
		echo json_encode($controller->listar());
		break;
	}

	case "listarCalendario":
	{
		$controller = new AgendamentoController();
		echo json_encode($controller->listarCalendario());
		break;
	}

	case "listarEstado":
	{
		$controller = new EstadoController();
		echo json_encode($controller->listar());
		break;		
	}

	case "listarCidade":
	{
		$controller = new CidadeController();
		echo json_encode($controller->listar());
		break;		
	}

	case "logar":
	{
		$controller = new UsuarioController();
		echo json_encode($controller->logar());
		break;		
	}

	case "listarAgendamentoHoje":
	{
		$controller = new AgendamentoController();
		echo json_encode($controller->listarAgendamentoHoje());
		break;		
	}

	case "listarGraficoQtdAgendamento":
	{
		$controller = new AgendamentoController();
		echo json_encode($controller->listarGraficoQtdAgendamento());
		break;		
	}

	case "listarAgendamentoSolicitado":
	{
		$controller = new AgendamentoController();
		echo json_encode($controller->listarAgendamentoSolicitado());
		break;		
	}

	case "listarPaciente":
	{
		$controller = new UsuarioController();
		echo json_encode($controller->listarPaciente());
		break;		
	}	

    default: 
    {
        echo "Operação inválida";
        break;
    }

}