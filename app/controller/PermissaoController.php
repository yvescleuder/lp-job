<?php

define("BASE_URL", "http://localhost/trabalho-lp-novo/");

class PermissaoController
{
	private $usuario;

	public function __construct()
	{
		// Verifica se não tem uma session_start criada, se não tiver cria.
		if(!isset($_SESSION['usuario']))
		{
			@session_start();
		}
		// Verifica se o usuário está logado, se tiver ele seta a session em uma variável para facilitar a nossa vida :), se não ele redireciona para o login.
		if(isset($_SESSION['usuario']))
		{
			$this->usuario = $_SESSION['usuario'];
		}
		else
		{
			header("Location: ".BASE_URL."app/view/login");
		}
	}

	// Este método permite somente o Administrador entrar na página.
	public function administrador()
	{
		if($this->usuario['perfil_id'] != 1)
		{
			return header("Location: ".BASE_URL."app/view/");
		}
	}

	// Este método permite somente o Médico entrar na página.
	public function medico()
	{
		if($this->usuario['perfil_id'] != 2)
		{
			return header("Location: ".BASE_URL."app/view/");
		}
	}

	// Este método permite somente a Secretária entrar na página.
	public function secretaria()
	{
		if($this->usuario['perfil_id'] != 3)
		{
			return header("Location: ".BASE_URL."app/view/");
		}
	}

	// Este método permite somente o Paciente entrar na página.
	public function paciente()
	{
		if($this->usuario['perfil_id'] != 4)
		{
			return header("Location: ".BASE_URL."app/view/");
		}
	}

	public function AdministradorSecretaria()
	{
		if($this->usuario['perfil_id'] != 1 && $this->usuario['perfil_id'] != 3)
		{
			return header("Location: ".BASE_URL."app/view/");
		}
	}
}