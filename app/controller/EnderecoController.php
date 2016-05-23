<?php

// Importação de Controller
require_once('Controller.php');
// Importação de Model
require_once('../model/Endereco.php');
// Importação de Classes que não são do projeto
require_once('../../vendor/wixel/gump/gump.class.php');

class EnderecoController extends Controller
{
	private $endereco;

	public function __construct()
	{
		parent::__construct();
		$this->endereco = new Endereco();
	}

	public function inserir($rua, $numero, $complemento, $bairro, $cidade_id)
	{
		$inserir = $this->endereco->inserir($rua, $numero, $complemento, $bairro, $cidade_id);
		
		if($inserir == false)
		{
			return false;
		}

		return $inserir;
	}

	public function alterar($dados)
	{
		$alterar = $this->endereco->alterar($dados);

		if($alterar == true)
		{
			return true;
		}
		
		return false;
	}
}