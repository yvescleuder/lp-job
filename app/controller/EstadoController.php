<?php

// Importação de Controller
require_once('Controller.php');
// Importação de Model
require_once('../model/Estado.php');

class EstadoController extends Controller
{
	private $estado;

	public function __construct()
	{
		parent::__construct();
		$this->estado = new Estado();
	}

	public function listar()
	{
		return $this->estado->listar();
	}
}