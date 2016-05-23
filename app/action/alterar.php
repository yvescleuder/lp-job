<?php

require_once('../controller/UsuarioController.php');

$acao = isset($_POST['acao']) ? $_POST['acao'] : '';

switch($acao)
{
	case "editarPaciente":
	{
		$controller = new UsuarioController();
		return $controller->alterarPaciente();
		break;
	}
    default: 
    {
        echo "Operação inválida";
        break;
    }

}