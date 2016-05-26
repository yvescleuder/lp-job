<?php

require_once('Model.php');

class Usuario extends Model
{
	private $tabela = 'usuario';

	public function __construct()
	{
		$this->open();
	}

	public function inserir($dados)
	{
		$inserir = $this->database->insert($this->tabela, $dados);

        if($inserir == true)
        {
            return true;
        }
    
        $this->mostrarError();
        return false;
	}

	public function valorExiste($campo, $valor)
	{
		$existe = $this->database->has($this->tabela, [$campo => $valor]);

		if($existe == true)
		{
			return true;
		}
    
        $this->mostrarError();
        return false;
	}

	public function listarMedico()
	{
		$listar = $this->database->select($this->tabela, "*", ['perfil_id' => 2]);

		return $listar;
	}

	public function verificarExistePaciente($paciente_usuario)
	{
		$existe = $this->database->has($this->tabela, ['AND' => ["usuario" => $paciente_usuario, "perfil_id" => 4]]);

		if($existe == true)
		{
			return true;
		}

        $this->mostrarError();
        return false;
	}

	public function verificarExisteMedico($medico_usuario)
	{
		$existe = $this->database->has($this->tabela, ['AND' => ["usuario" => $medico_usuario, "perfil_id" => 2]]);

		if($existe == true)
		{
			$this->mostrarError();
			return true;
		}

        $this->mostrarError();
        return false;
	}

	public function buscarPaciente($usuario)
	{
		$buscar = $this->database->query("SELECT
											t1.*,
												t2.id as convenio_id,
												t2.nome as convenio_nome,
												t3.id as endereco_id,
												t3.rua as rua,
												t3.bairro as bairro,
												t3.complemento as complemento,
												t3.numero as numero,
												t4.id as cidade_id,
												t4.nome as cidade_nome,
												t5.id as estado_id,
												t5.nome as estado_nome
										FROM $this->tabela as t1
										INNER JOIN convenio as t2 ON (t1.convenio_id = t2.id)
										INNER JOIN endereco as t3 ON (t1.endereco_id = t3.id)
										INNER JOIN cidade as t4 ON (t3.cidade_id = t4.id)
										INNER JOIN estado as t5 ON (t4.estado_id = t5.id)
										WHERE usuario = '".$usuario."' AND perfil_id = 4")->fetch();
		
		if($buscar == true)
		{
			return $buscar;
		}
    
        $this->mostrarError();
        return false;		
	}

	public function alterar($dados)
	{
		$usuario = $dados['usuario'];
        unset($dados['usuario']);

        $alterar = $this->database->update($this->tabela, $dados, ["usuario" => $usuario]);

        if($alterar == true)
        {
            return true;
        }

        $this->mostrarError();
        return false;
	}

	public function selecionar($usuario)
	{
        $selecionar = $this->database->select($this->tabela, "*", ["usuario" => $usuario]);

        return $selecionar[0];
	}

	public function logar($dados)
	{
		$dados['senha'] = md5($dados['senha']);

		$logar = $this->database->select($this->tabela, ['id', 'usuario', 'nome', 'sobrenome', 'crm', 'telefone1', 'telefone2', 'celular1', 'celular2', 'perfil_id'], ['AND' => ["usuario" => $dados['usuario'], "senha" => $dados['senha']]]);

		if($logar == true)
        {
            return $logar;
        }
    
        $this->mostrarError();
        return false;
	}
}