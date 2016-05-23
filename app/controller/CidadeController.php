<?php

// Importação de Controller
require_once('Controller.php');
// Importação de Model
require_once('../model/Cidade.php');

class CidadeController extends Controller
{
	private $cidade;

	public function __construct()
	{
		parent::__construct();
		$this->cidade = new Cidade();
	}

	public function listar()
	{
		$estado_id = $this->input->get("estado_id");
		return $this->cidade->listar($estado_id);
	}
}