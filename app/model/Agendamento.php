<?php

require_once('Model.php');

class Agendamento extends Model
{
	private $tabela = 'agendamento';

	public function __construct()
	{
		$this->open();
	}

	public function inserir($dados)
	{
		$inserir = $this->database->insert($this->tabela, $dados);

        if($inserir == true)
        {
            return $inserir;
        }
    
        $this->mostrarError();
        return false;
	}

	public function verificarDataHora($data, $hora, $medico)
	{
		$verificar = $this->database->has($this->tabela, ['AND' => ['data' => $data, 'hora' => $hora, 'medico_usuario' => $medico]]);

		if($verificar == true)
        {
            return true;
        }
    
        $this->mostrarError();
        return false;			
	}

	public function verificarExiste($id)
	{
		$existe = $this->database->select($this->tabela, "*", ['id' => $id]);
		
		if($existe == true)
		{
			return true;
		}
    
        $this->mostrarError();
        return false;		
	}

	public function buscarPorCodigo($id)
	{
		$buscar = $this->database->query("SELECT
											t1.id,
											date_format(t1.data,'%d/%m/%Y') as data,
											date_format(t1.hora,'%H:%i') as hora,
											CASE t1.tipo
												WHEN 1 THEN 'Consulta'
												WHEN 2 THEN 'Retorno'
											END as tipoAgendamento,
											CONCAT(t2.id, ' - ' ,t2.nome) as nomePaciente,
											CONCAT(t3.crm, ' - ' ,t3.nome) as nomeMedico,
											t4.nome as statusNome
										FROM $this->tabela as t1
										INNER JOIN usuario as t2 ON (t1.paciente_usuario = t2.usuario)
										INNER JOIN usuario as t3 ON (t1.medico_usuario = t3.usuario)
										INNER JOIN status as t4 ON (t1.status_id = t4.id)
										WHERE t1.id = $id")->fetch();

		$this->mostrarError();
		return $buscar;
	}

	public function listarCalendario()
	{
		$resultado = [];

		@session_start();
		if($_SESSION['usuario']['perfil_id'] == 4)
		{
			$listar = $this->database->query("SELECT
											t1.id,
											CONCAT(date_format(t1.data,'%Y-%m-%d'), ' ', date_format(t1.hora,'%H:%i')) as start,
											CONCAT(date_format(t1.data,'%Y-%m-%d'), ' ', date_format(DATE_ADD(t1.hora, INTERVAL 1 HOUR),'%H:%i')) as end,
											CONCAT('Dr(a).', t3.nome) as title,
											CASE t1.tipo
												WHEN 1
													THEN '#0073b7'
												WHEN 2
													THEN '#f39c12'
											END as cor
										FROM $this->tabela as t1
										INNER JOIN usuario as t2 ON (t1.paciente_usuario = t2.usuario)
										INNER JOIN usuario as t3 ON (t1.medico_usuario = t3.usuario)
										WHERE t1.data >= CURDATE() AND status_id = 2 AND t2.usuario = '".$_SESSION['usuario']['usuario']."'")->fetchAll();
		}
		elseif($_SESSION['usuario']['perfil_id'] == 2)
		{
			$listar = $this->database->query("SELECT
											t1.id,
											CONCAT(date_format(t1.data,'%Y-%m-%d'), ' ', date_format(t1.hora,'%H:%i')) as start,
											CONCAT(date_format(t1.data,'%Y-%m-%d'), ' ', date_format(DATE_ADD(t1.hora, INTERVAL 1 HOUR),'%H:%i')) as end,
											CONCAT(t2.nome, ' - Dr(a).', t3.nome) as title,
											CASE t1.tipo
												WHEN 1
													THEN '#0073b7'
												WHEN 2
													THEN '#f39c12'
											END as cor
										FROM $this->tabela as t1
										INNER JOIN usuario as t2 ON (t1.paciente_usuario = t2.usuario)
										INNER JOIN usuario as t3 ON (t1.medico_usuario = t3.usuario)
										WHERE t1.data >= CURDATE() AND status_id = 2 AND t3.usuario = '".$_SESSION['usuario']['usuario']."'")->fetchAll();
		}
		else
		{
			$listar = $this->database->query("SELECT
											t1.id,
											CONCAT(date_format(t1.data,'%Y-%m-%d'), ' ', date_format(t1.hora,'%H:%i')) as start,
											CONCAT(date_format(t1.data,'%Y-%m-%d'), ' ', date_format(DATE_ADD(t1.hora, INTERVAL 1 HOUR),'%H:%i')) as end,
											CONCAT(t2.nome, ' - Dr(a).', t3.nome) as title,
											CASE t1.tipo
												WHEN 1
													THEN '#0073b7'
												WHEN 2
													THEN '#f39c12'
											END as cor
										FROM $this->tabela as t1
										INNER JOIN usuario as t2 ON (t1.paciente_usuario = t2.usuario)
										INNER JOIN usuario as t3 ON (t1.medico_usuario = t3.usuario)
										WHERE t1.data >= CURDATE() AND status_id = 2")->fetchAll();
		}
		

		foreach($listar as $key => $value)
		{
			$linha = ["title" => $value->title, "start" => $value->start, "end" => $value->end, "backgroundColor" => $value->cor, "borderColor" => $value->cor];
			$resultado['dados'][] = $linha;
		}

		$this->mostrarError();
		return $resultado;
	}

	public function listar()
	{
		$listar = $this->database->query("SELECT
											t1.id,
											CONCAT(date_format(t1.data,'%d/%m/%Y'), ' - ', date_format(t1.hora,'%H:%i')) as datahora,
											CASE t1.tipo
												WHEN 1 THEN 'Consulta'
												WHEN 2 THEN 'Retorno'
											END as tipoAgendamento,
											t2.nome as nomePaciente,
											CONCAT(t3.crm, ' - Dr(a).' ,t3.nome) as nomeMedico
										FROM $this->tabela as t1
										INNER JOIN usuario as t2 ON (t1.paciente_usuario = t2.usuario)
										INNER JOIN usuario as t3 ON (t1.medico_usuario = t3.usuario)
										WHERE t1.data >= CURDATE()")->fetchAll();

		$this->mostrarError();
		return $listar;
	}

	public function listarAgendamentoHoje($usuario)
	{
		@session_start();
		if($_SESSION['usuario']['perfil_id'] == 1 || $_SESSION['usuario']['perfil_id'] == 3)
		{
			$listar = $this->database->query("SELECT
												t1.id,
												date_format(t1.hora,'%H:%i') as hora,
												CASE t1.tipo
													WHEN 1
														THEN 'Consulta'
													WHEN 2
														THEN 'Retorno'
												END as tipoNome,
												CONCAT(t2.nome, ' ',t2.sobrenome) as paciente,
												CONCAT(t3.nome, ' ',t3.sobrenome) as medico
											FROM $this->tabela as t1
											INNER JOIN usuario as t2 ON (t1.paciente_usuario = t2.usuario)
											INNER JOIN usuario as t3 ON (t1.medico_usuario = t3.usuario)
											WHERE t1.data = CURDATE() ORDER BY t1.hora ASC")->fetchAll();
		}
		elseif($_SESSION['usuario']['perfil_id'] == 2)
		{	
			$listar = $this->database->query("SELECT
												t1.id,
												date_format(t1.hora,'%H:%i') as hora,
												CASE t1.tipo
													WHEN 1
														THEN 'Consulta'
													WHEN 2
														THEN 'Retorno'
												END as tipoNome,
												CONCAT(t2.nome, ' ',t2.sobrenome) as paciente,
												t2.usuario
											FROM $this->tabela as t1
											INNER JOIN usuario as t2 ON (t1.paciente_usuario = t2.usuario)
											WHERE t1.data = CURDATE() AND t1.medico_usuario = '{$usuario}' ORDER BY t1.hora ASC")->fetchAll();
		}

		$this->mostrarError();
        return $listar;
	}

	public function listarAgendamentoSolicitado()
	{

		$listar = $this->database->query("SELECT
											t1.id,
											date_format(t1.hora,'%H:%i') as hora,
											CASE t1.tipo
												WHEN 1
													THEN 'Consulta'
												WHEN 2
													THEN 'Retorno'
											END as tipoNome,
											CONCAT(t2.nome, ' ',t2.sobrenome) as paciente,
											t2.usuario
										FROM $this->tabela as t1
										INNER JOIN usuario as t2 ON (t1.paciente_usuario = t2.usuario)
										WHERE t1.status_id = 1")->fetchAll();

		if(empty($listar))
		{
			$linha = [];
		}
		else
		{
			foreach($listar as $key => $value)
			{
				$linha[] = 	[
								'id' => $value->id,
								'hora' => $value->hora,
								'tipoNome' => $value->tipoNome,
								'paciente' => $value->paciente,
								'button' => "<button class='btn btn-success' onclick='confirmar(".$value->id.");' title='Confirmar' style='padding: 0px 7px'><i class='fa fa-check'></i></button>&nbsp;<button class='btn btn-danger' onclick='cancelar(".$value->id.");' title='Cancelar' style='padding: 0px 9px'><i class='fa fa-times'></i></button>"
							];
			}
		}
		
		$this->mostrarError();
        return $linha;
	}

	public function listarGraficoQtdAgendamento()
	{
		$meses = [1,2,3,4,5,6,7,8,9,10,11,12];

		$linha = '';

		foreach($meses as $key => $value)
		{
			$listar = $this->database->query("SELECT
												COUNT(*) as qtdAgendamento
											FROM agendamento
											WHERE month(data) = $value AND year(data) = year(CURDATE()) AND status_id = 3")->fetch();
			$linha[] = $listar->qtdAgendamento;
		}
		return $linha;
	}

	public function cancelarAgendamento($id)
	{
		$cancelar = $this->database->update($this->tabela, ['status_id' => 4], ['id' => $id]);

		if($cancelar == true)
		{
			return true;
		}

		$this->mostrarError();
		return false;
	}

	public function confirmarAgendamento($id)
	{
		$confirmar = $this->database->update($this->tabela, ['status_id' => 2], ['id' => $id]);

		if($confirmar == true)
		{
			return true;
		}

		$this->mostrarError();
		return false;
	}

}