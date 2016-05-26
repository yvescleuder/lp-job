<?php

require_once('../controller/UsuarioController.php');
require_once('../controller/AgendamentoController.php');

$acao = isset($_POST['acao']) ? $_POST['acao'] : '';

switch($acao)
{
	case "editarPaciente":
	{
		$controller = new UsuarioController();
		return $controller->alterarPaciente();
		break;
	}

	case 'cancelarAgendamento':
	{
		$controller = new AgendamentoController();
		echo json_encode($controller->cancelarAgendamento());
		break;
	}

    default: 
    {
        echo "Operação inválida";
        break;
    }

}