<?php

require_once('../controller/AgendamentoController.php');
require_once('../controller/UsuarioController.php');

$acao = isset($_POST['acao']) ? $_POST['acao'] : '';

switch($acao)
{
	// Arrumado
	case "cadastrarPaciente":
	{
		$controller = new UsuarioController();
		return $controller->inserir();
		break;
	}

	// Arrumado
	case "cadastrarMedico":
	{
		$controller = new UsuarioController();
		return $controller->inserir();
		break;
	}

	// Arrumado
	case "cadastrarAgendamento":
	{
		$controller = new AgendamentoController();
		return $controller->inserir();
		break;
	}

    default: 
    {
        echo "Operação inválida";
        break;
    }

}