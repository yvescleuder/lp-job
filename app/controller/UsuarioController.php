<?php

// Importação de Controller
require_once('Controller.php');
require_once('EnderecoController.php');
// Importação de Model
require_once('../model/Usuario.php');
// Importação de Classes que não são do projeto
require_once('../../vendor/wixel/gump/gump.class.php');

class UsuarioController extends Controller
{
	private $usuario;
	private $endereco;

	public function __construct()
	{
		parent::__construct();
		$this->usuario = new Usuario();
		$this->endereco = new EnderecoController();
	}

	public function inserir()
	{
		$dados = $this->input->get('usuario');

		if(isset($dados['crm']))
		{
			// Verifica se esses 2 campos (não são obrigátórios), se veio vazio eu removo eles para não irem com valores vazios para o banco.
			if(empty($dados['telefone2']))
			{
				unset($dados['telefone2']);
			}
			if(empty($dados['celular2']))
			{
				unset($dados['celular2']);
			}

			$resultadoInvalido = "";

			// Faz a validação de todos os campos
			$valido = GUMP::is_valid($dados, array(
				'usuario' => 'required|min_len,1|max_len,20',
				'senha' => 'required|min_len,1|max_len,20',
				'crm' => 'required|integer|min_len,1|max_len,10',
				'nome' => 'required|alpha_space|min_len,4|max_len,100',
				'sobrenome' => 'required|alpha_space|min_len,4|max_len,100',
				'telefone1' => 'required|min_len,14|max_len,16',
				'celular1' => 'required|min_len,14|max_len,16',
				'telefone2' => 'min_len,14|max_len,16',
				'celular2' => 'min_len,14|max_len,16',
				'rua' => 'required|min_len,5|max_len,100',
				'numero' => 'required|integer|min_len,1|max_len,10',
				'rua' => 'required|min_len,5|max_len,100',
				'bairro' => 'required|min_len,5|max_len,100',
				'cidade_id' => 'required|integer|min_len,1',
				'estado_id' => 'required|integer|min_len,1',
				'especialidade_id' => 'required|min_len,1|max_len,10',
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
				// Verifica se o valor do campo codigo já existe no banco de dados 
				if($this->usuario->valorExiste('crm', $dados['crm']))
				{
					$this->resposta = ['msg' => ['tipo' => 'e', 'texto' => MensagemController::msg012($dados['crm'])]];
				}
				elseif($this->usuario->valorExiste('usuario', $dados['usuario']))
				{
					$this->resposta = ['msg' => ['tipo' => 'e', 'texto' => MensagemController::msg015($dados['usuario'])]];
				}
				else
				{
					$inserirEndereco = $this->endereco->inserir($dados['rua'], $dados['numero'], $dados['complemento'], $dados['bairro'], $dados['cidade_id']);
					if($inserirEndereco == false)
					{
						$this->resposta = ['msg' => ['tipo' => 'e', 'texto' => MensagemController::msg016()]];
					}
					else
					{
						unset($dados['estado_id']);
						unset($dados['rua']);
						unset($dados['numero']);
						unset($dados['complemento']);
						unset($dados['bairro']);
						unset($dados['cidade_id']);
						$dados['endereco_id'] = $inserirEndereco;
						$dados['senha'] = md5($dados['senha']);
						$dados['perfil_id'] = 2;
						// Insere o paciente no banco de dados
						$resultado = $this->usuario->inserir($dados);

						if($resultado == true)
						{
							$this->resposta = ['msg' => ['tipo' => 's', 'texto' => MensagemController::msg013()]];
						}
						else
						{
							$this->resposta = ['msg' => ['tipo' => 'e', 'texto' => MensagemController::msg014()]];
						}
					}
				}
			}
		}
		elseif(isset($dados['convenio_id']))
		{
			// Verifica se esses 2 campos (não são obrigátórios), se veio vazio eu removo eles para não irem com valores vazios para o banco.
			if(empty($dados['telefone2']))
			{
				unset($dados['telefone2']);
			}
			if(empty($dados['celular2']))
			{
				unset($dados['celular2']);
			}

			$resultadoInvalido = "";

			// Faz a validação de todos os campos
			$valido = GUMP::is_valid($dados, array(
				'usuario' => 'required|min_len,1|max_len,20',
				'senha' => 'required|min_len,1|max_len,20',
				'nome' => 'required|alpha_space|min_len,4|max_len,100',
				'sobrenome' => 'required|alpha_space|min_len,4|max_len,100',
				'telefone1' => 'required|min_len,14|max_len,16',
				'celular1' => 'required|min_len,14|max_len,16',
				'telefone2' => 'min_len,14|max_len,16',
				'celular2' => 'min_len,14|max_len,16',
				'rua' => 'required|min_len,5|max_len,100',
				'numero' => 'required|integer|min_len,1|max_len,10',
				'rua' => 'required|min_len,5|max_len,100',
				'bairro' => 'required|min_len,5|max_len,100',
				'cidade_id' => 'required|integer|min_len,1',
				'estado_id' => 'required|integer|min_len,1',
				'convenio_id' => 'required|min_len,1|max_len,10',
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
				// Verifica se o valor do campo codigo já existe no banco de dados 
				if($this->usuario->valorExiste('usuario', $dados['usuario']))
				{
					$this->resposta = ['msg' => ['tipo' => 'e', 'texto' => MensagemController::msg003($dados['usuario'])]];
				}
				else
				{
					$inserirEndereco = $this->endereco->inserir($dados['rua'], $dados['numero'], $dados['complemento'], $dados['bairro'], $dados['cidade_id']);
					if($inserirEndereco == false)
					{
						$this->resposta = ['msg' => ['tipo' => 'e', 'texto' => MensagemController::msg016()]];
					}
					else
					{
						unset($dados['estado_id']);
						unset($dados['rua']);
						unset($dados['numero']);
						unset($dados['complemento']);
						unset($dados['bairro']);
						unset($dados['cidade_id']);
						$dados['endereco_id'] = $inserirEndereco;
						$dados['senha'] = md5($dados['senha']);
						$dados['perfil_id'] = 4;
						// Insere o paciente no banco de dados
						$resultado = $this->usuario->inserir($dados);

						if($resultado == true)
						{
							$this->resposta = ['msg' => ['tipo' => 's', 'texto' => MensagemController::msg001()]];
						}
						else
						{
							$this->resposta = ['msg' => ['tipo' => 'e', 'texto' => MensagemController::msg002()]];
						}
					}
				}
			}
		}

		echo json_encode($this->resposta);
	}

	public function inserirSecretaria()
	{
		$dados = $this->input->get('usuario');
		// Verifica se esses 2 campos (não são obrigátórios), se veio vazio eu removo eles para não irem com valores vazios para o banco.
		if(empty($dados['telefone2']))
		{
			unset($dados['telefone2']);
		}
		if(empty($dados['celular2']))
		{
			unset($dados['celular2']);
		}

		$resultadoInvalido = "";

		// Faz a validação de todos os campos
		$valido = GUMP::is_valid($dados, array(
			'usuario' => 'required|min_len,1|max_len,20',
			'senha' => 'required|min_len,1|max_len,20',
			'nome' => 'required|alpha_space|min_len,4|max_len,100',
			'sobrenome' => 'required|alpha_space|min_len,4|max_len,100',
			'telefone1' => 'required|min_len,14|max_len,16',
			'celular1' => 'required|min_len,14|max_len,16',
			'telefone2' => 'min_len,14|max_len,16',
			'celular2' => 'min_len,14|max_len,16',
			'rua' => 'required|min_len,5|max_len,100',
			'numero' => 'required|integer|min_len,1|max_len,10',
			'rua' => 'required|min_len,5|max_len,100',
			'bairro' => 'required|min_len,5|max_len,100',
			'cidade_id' => 'required|integer|min_len,1',
			'estado_id' => 'required|integer|min_len,1'
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
			// Verifica se o valor do campo codigo já existe no banco de dados 
			if($this->usuario->valorExiste('usuario', $dados['usuario']))
			{
				$this->resposta = ['msg' => ['tipo' => 'e', 'texto' => MensagemController::msg003($dados['usuario'])]];
			}
			else
			{
				$inserirEndereco = $this->endereco->inserir($dados['rua'], $dados['numero'], $dados['complemento'], $dados['bairro'], $dados['cidade_id']);
				if($inserirEndereco == false)
				{
					$this->resposta = ['msg' => ['tipo' => 'e', 'texto' => MensagemController::msg016()]];
				}
				else
				{
					unset($dados['estado_id']);
					unset($dados['rua']);
					unset($dados['numero']);
					unset($dados['complemento']);
					unset($dados['bairro']);
					unset($dados['cidade_id']);
					$dados['endereco_id'] = $inserirEndereco;
					$dados['senha'] = md5($dados['senha']);
					$dados['perfil_id'] = 3;
					// Insere o paciente no banco de dados
					$resultado = $this->usuario->inserir($dados);

					if($resultado == true)
					{
						$this->resposta = ['msg' => ['tipo' => 's', 'texto' => MensagemController::msg018()]];
					}
					else
					{
						$this->resposta = ['msg' => ['tipo' => 'e', 'texto' => MensagemController::msg019()]];
					}
				}
			}
		}

		echo json_encode($this->resposta);
	}

	public function listarMedico()
	{
		return $this->usuario->listarMedico();
	}

	public function verificarExistePaciente($paciente_usuario)
	{
		return $this->usuario->verificarExistePaciente($paciente_usuario);
	}

	public function verificarExisteMedico($medico_usuario)
	{
		return $this->usuario->verificarExisteMedico($medico_usuario);
	}

	public function buscarPaciente()
	{
		$usuario = $this->input->get("usuario");
		$dados = array('usuario' => $usuario);
		$resultadoInvalido = "";

		// Faz a validação de todos os campos
		$valido = GUMP::is_valid($dados, array(
			'usuario' => 'required|min_len,1|max_len,20'
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
			$buscar = $this->usuario->buscarPaciente($usuario);

			if($buscar == true)
			{
				$this->resposta = ['msg' => ['tipo' => 's', 'texto' => $buscar]];
			}
			else
			{
				$this->resposta = ['msg' => ['tipo' => 'e', 'texto' => MensagemController::msg004($usuario)]];
			}
		}

		return $this->resposta;
	}

	public function alterarPaciente()
	{
		$dados = $this->input->get('usuario');

		// Verifica se esses 2 campos (não são obrigátórios), se veio vazio eu removo eles para não irem com valores vazios para o banco.
		if(empty($dados['telefone2']))
		{
			unset($dados['telefone2']);
		}
		if(empty($dados['celular2']))
		{
			unset($dados['celular2']);
		}

		$resultadoInvalido = "";

		// Faz a validação de todos os campos
		$valido = GUMP::is_valid($dados, array(
				'usuario' => 'required|min_len,1|max_len,20',
				'nome' => 'required|alpha_space|min_len,4|max_len,100',
				'sobrenome' => 'required|alpha_space|min_len,4|max_len,100',
				'telefone1' => 'required|min_len,14|max_len,16',
				'celular1' => 'required|min_len,14|max_len,16',
				'telefone2' => 'min_len,14|max_len,16',
				'celular2' => 'min_len,14|max_len,16',
				'rua' => 'required|min_len,5|max_len,100',
				'numero' => 'required|integer|min_len,1|max_len,10',
				'rua' => 'required|min_len,5|max_len,100',
				'bairro' => 'required|min_len,5|max_len,100'
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
			$usuario = $this->selecionar($dados['usuario']);
			$enderecoAlterar = ['rua' => $dados['rua'], 'bairro' => $dados['bairro'], 'numero' => $dados['numero'], 'complemento' => $dados['complemento'], 'id' => $usuario['endereco_id'], 'cidade_id' => $dados['cidade_id']];
				
			$this->endereco->alterar($enderecoAlterar);

			unset($dados['rua']);
			unset($dados['bairro']);
			unset($dados['numero']);
			unset($dados['complemento']);
			unset($dados['cidade_id']);
			unset($dados['estado_id']);

			$this->usuario->alterar($dados);

			$this->resposta = ['msg' => ['tipo' => 's', 'texto' => MensagemController::msg005()]];

			/*Fazer essa parte caso falhe depois, pois é necessário verificar se algum campo foi alterado.
			$this->resposta = ['msg' => ['tipo' => 'e', 'texto' => MensagemController::msg006()]];*/
		}

		echo json_encode($this->resposta);
	}

	public function selecionar($usuario)
	{
		return $this->usuario->selecionar($usuario);
	}

	public function logar()
	{
		$dados = $this->input->get("usuario");
		if($this->usuario->logar($dados))
		{
			@session_start();
			$dadosUsuario = $this->selecionar($dados['usuario']);
			$_SESSION['usuario'] = $dadosUsuario;
			$this->resposta = ["msg" => ["tipo" => "s", "texto" => '../index.php']];
		}
		else
		{
			$this->resposta = ["msg" => ["tipo" => "e", "texto" => 'Os dados estão incorretos']];
		}

		return $this->resposta;
	}

	public function sair()
	{
		@session_start();
		unset($_SESSION['usuario']);
		$this->resposta = ["msg" => ["tipo" => "s", "texto" => 'http://localhost/trabalho-lp-novo/app/view/login']];
		return $this->resposta;
	}

	public function listarPaciente()
	{
		return $this->usuario->listarPaciente();
	}
}