<?php

require_once('Model.php');

class Estado extends Model
{
	private $tabela = 'estado';

	public function __construct()
	{
		$this->open();
	}

	public function listar()
	{
		$listar = $this->database->select($this->tabela, "*");

		return $listar;
	}
}