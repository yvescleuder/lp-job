<?php

require_once('Model.php');

class Cidade extends Model
{
	private $tabela = 'cidade';

	public function __construct()
	{
		$this->open();
	}

	public function listar($estado_id)
	{
		$listar = $this->database->select($this->tabela, "*", ["estado_id" => $estado_id]);

		return $listar;
	}
}