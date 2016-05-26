<?php

// Importação de Controller
require_once('Controller.php');
require_ONCE('UsuarioController.php');
// Importação de Model
require_once('../model/Agendamento.php');

class AgendamentoController extends Controller
{
	private $agendamento;
	private $usuario;

	public function __construct()
	{
		parent::__construct();
		$this->agendamento = new Agendamento();
		$this->usuario = new UsuarioController();
	}

	public function inserir()
	{
		$dados = $this->input->get('agendamento');
		$dados['data'] = date('Y-m-d', strtotime($dados['data']));
		$resultadoInvalido = "";

		// Faz a validação de todos os campos
		$valido = GUMP::is_valid($dados, array(
			'paciente_usuario' => 'required|min_len,1|max_len,20',
			'data' => 'required|date',
			'hora' => 'required',
			'medico_usuario' => 'required|min_len,1|max_len,20',
			'tipo' => 'required|min_len,1|max_len,1',
		));

		if($valido !== true)
		{
			foreach($valido as $value)
		  	{
		   		$resultadoInvalido .= $value.'<br>';
		  	}
		 	
		 	$this->resposta = ["msg" => ["tipo" => "e", "texto" => $resultadoInvalido]];
		}
		else
		{
			if($this->agendamento->verificarDataHora($dados['data'], $dados['hora']))
			{
				$this->resposta = ['msg' => ['tipo' => 'e', 'texto' => MensagemController::msg007(date('d/m/Y', strtotime($dados['data'])), $dados['hora'])]];
			}
			else
			{
				if($this->usuario->verificarExistePaciente($dados['paciente_usuario']))
				{
					if($this->usuario->verificarExisteMedico($dados['medico_usuario']) == false)
					{
						$this->resposta = ['msg' => ['tipo' => 'e', 'texto' => MensagemController::msg017($dados['medico_usuario'])]];
					}
					else
					{
						@session_start();
						// Se o perfil do usuário for Administrador ou Médico ou Secretária, o agendamento ficará com o status "Agendado".
						if($_SESSION['usuario']['perfil_id'] == 1 || $_SESSION['usuario']['perfil_id'] == 2 || $_SESSION['usuario']['perfil_id'] == 3)
						{
							$dados['status_id'] = 2;
						}
						// Se o perfil do usuário for Paciente, o agendamento ficará com o status "Solicitado".
						else
						{
							$dados['status_id'] = 1;
						}
						// Insere o paciente no banco de dados
						$resultado = $this->agendamento->inserir($dados);

						if($resultado == false)
						{
							$this->resposta = ['msg' => ['tipo' => 'e', 'texto' => MensagemController::msg008()]];
						}
						else
						{
							$this->resposta = ['msg' => ['tipo' => 's', 'texto' => MensagemController::msg009($resultado)]];
						}
					}
					
				}
				else
				{
					$this->resposta = ['msg' => ['tipo' => 'e', 'texto' => MensagemController::msg010($dados['paciente_usuario'])]];
				}
			}
		}

		echo json_encode($this->resposta);
	}

	public function verificarExiste()
	{
		$id = $this->input->get("id");

		if($this->agendamento->verificarExiste($id))
		{
			$this->resposta = ["msg" => ["tipo" => "s", "texto" => $id]];
		}
		else
		{
			$this->resposta = ["msg" => ["tipo" => "e", "texto" => MensagemController::msg011()]];
		}

		return $this->resposta;
	}

	public function buscarPorCodigo()
	{
		$id = $this->input->get("id");

		return $this->agendamento->buscarPorCodigo($id);
	}

	public function listar()
	{
		return $this->agendamento->listar();
	}

	public function listarCalendario()
	{
		return $this->agendamento->listarCalendario();
	}

	public function listarAgendamentoMedico()
	{
		@session_start();
		$usuario = $_SESSION['usuario']['usuario'];
		
		return $this->agendamento->listarAgendamentoMedico($usuario);
	}

	public function listarGraficoQtdAgendamento()
	{
		return $this->agendamento->listarGraficoQtdAgendamento();
	}

	public function listarAgendamentoSolicitado()
	{
		return $this->agendamento->listarAgendamentoSolicitado();
	}

	public function cancelarAgendamento()
	{
		if($this->agendamento->cancelarAgendamento($this->input->get("agendamento_id")))
		{
			$this->resposta = ['msg' => ['tipo' => 's', 'texto' => 'Opaaaaaaaaaaa, deu certo!!!!']];
		}
		else
		{
			$this->resposta = ['msg' => ['tipo' => 'e', 'texto' => 'Ops.. Erro no sistema, contate a equipe.']];
		}

		return $this->resposta;
	}
}