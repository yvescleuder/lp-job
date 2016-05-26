<?php

require_once('../controller/UsuarioController.php');

$acao = isset($_POST['acao']) ? $_POST['acao'] : '';

switch($acao)
{
	case 'sair':
	{
		$controller = new UsuarioController();
		echo json_encode($controller->sair());
		break;
	}

    default: 
    {
        echo "Operação inválida";
        break;
    }

}