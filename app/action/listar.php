<?php

require_once('../controller/ConvenioController.php');
require_once('../controller/UsuarioController.php');
require_once('../controller/EspecialidadeController.php');
require_once('../controller/AgendamentoController.php');
require_once('../controller/EstadoController.php');
require_once('../controller/CidadeController.php');

$acao = isset($_POST['acao']) ? $_POST['acao'] : '';

switch($acao)
{
	case "listarConvenio":
	{
		$controller = new ConvenioController();
		echo json_encode($controller->listar());
		break;
	}

	// Arrumado
	case "buscarPaciente":
	{
		$controller = new UsuarioController();
		echo json_encode($controller->buscarPaciente());
		break;
	}

	// Arrumado
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

	// Arrumado
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

    default: 
    {
        echo "Operação inválida";
        break;
    }

}