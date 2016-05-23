<?php

require_once('Model.php');

class Endereco extends Model
{
	private $tabela = 'endereco';

	public function __construct()
	{
		$this->open();
	}

	public function inserir($rua, $numero, $complemento, $bairro, $cidade_id)
	{
		$dados = ['rua' => $rua, 'numero' => $numero, 'complemento' => $complemento, 'bairro' => $bairro, 'cidade_id' => $cidade_id];

		$inserir = $this->database->insert($this->tabela, $dados);

        if($inserir == false)
        {
            $this->mostrarError();
        	return false;
        }

        return $inserir;        
	}

	public function alterar($dados)
	{
		$id = $dados['id'];
		unset($dados['id']);

		$alterar = $this->database->update($this->tabela, $dados, ["id" => $id]);

		if($alterar == true)
        {
           return true; 
        }

        $this->mostrarError();
        return false;
	}
}
