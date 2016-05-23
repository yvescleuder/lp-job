<?php require_once('header.php'); ?>
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></li>
				<li class="active">Editar Paciente</li>
			</ol>
		</div><!--/.row-->			
		
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">Editar Paciente</div>
						<!-- Form Busca Codigo Paciente-->
						<div class="panel-body" id="divBuscarPaciente">
							<form id="formBuscarPaciente" action="../action/listar.php" method="POST">
								<input type="hidden" name="acao" value="buscarPaciente">
								<div class="col-md-6">
									<div class="form-group">
										<label>Nome de Usuário</label>
										<input type="text" class="form-control" placeholder="Nome de Usuário" name="usuario" maxlength="20">
									</div>
								</div>

								<div class="col-md-12">
									<button type="submit" id="botaoBuscarPaciente" class="btn btn-primary btn-disabled">Buscar</button>
									<span class="loading hide">
										<img src="../../assets/img/load.gif" alt="Carregando...">
									</span>
								</div>
							</form>
						</div>
						<!-- Fim Form Busca Codigo Paciente-->
						<form id="formBuscarConvenio" action="../action/listar.php" method="POST">
							<input type="hidden" name="acao" value="listarConvenioEditar">
							<input type="hidden" id="paciente_id_editar" name="convenio_id" value="">
						</form>
						<!-- Inicio Form de edição de Paciente-->
						<div class="panel-body hidden" id="divDadosPaciente">
							<form id="formDadosPaciente" action="../action/alterar.php" method="POST">
								<input type="hidden" name="acao" value="editarPaciente">
								<input type="hidden" id="paciente_usuario" name="usuario[usuario]" value="">
								<div class="col-md-6">
								<div class="form-group">
									<label>Usuário</label>
									<input type="text" id="usuario" class="form-control" placeholder="Usuário" maxlength="20" disabled="disabled">
								</div>
																
								<div class="form-group">
									<label>Nome</label>
									<input type="text" id="nome" class="form-control" name="usuario[nome]" placeholder="Primeiro Nome" maxlength="100">
								</div>
																
								<div class="form-group">
									<label>Telefone 1</label>
									<input type="text" id="telefone1" class="form-control" name="usuario[telefone1]" placeholder="(99) # 9999-9999" maxlength="16">
								</div>
																
								<div class="form-group">
									<label>Celular 1</label>
									<input type="text" id="celular1" class="form-control" name="usuario[celular1]" placeholder="(99) # 9999-9999" maxlength="16">
								</div>
																
								<div class="form-group">
									<label>Rua</label>
									<input type="text" id="rua" class="form-control" name="usuario[rua]" placeholder="Sua rua" maxlength="100">
								</div>
																
								<div class="form-group">
									<label>Bairro</label>
									<input type="text" id="bairro" class="form-control" name="usuario[bairro]" placeholder="Seu bairro" maxlength="100">
								</div>
							</div>
							
							<div class="col-md-6">
								<div class="form-group">
									<label>Convênio</label>
									<select class="form-control" id="listarConvenio" name="usuario[convenio_id]">
										<option id="convenio_id" value="">-- Selecione</option>
									</select>
								</div>
																
								<div class="form-group">
									<label>Sobrenome</label>
									<input type="text" id="sobrenome" class="form-control" name="usuario[sobrenome]" placeholder="Sobrenome" maxlength="100">
								</div>
																
								<div class="form-group">
									<label>Telefone 2</label>
									<input type="text" id="telefone2" class="form-control" name="usuario[telefone2]" placeholder="(99) # 9999-9999" maxlength="16">
								</div>
																
								<div class="form-group">
									<label>Celular 2</label>
									<input type="text" id="celular2" class="form-control" name="usuario[celular2]" placeholder="(99) # 9999-9999" maxlength="16">
								</div>
																
								<div class="form-group">
									<label>Número</label>
									<input type="number" id="numero" class="form-control" name="usuario[numero]" placeholder="Número" maxlength="10">
								</div>
							</div>

							<div class="col-md-12">								
								<div class="form-group">
									<label>Complemento</label>
									<input type="text" id="complemento" class="form-control" name="usuario[complemento]" placeholder="Complemento" maxlength="100">
								</div>
							</div>

							<div class="col-md-6">
								<div class="form-group">
									<label>Estado</label>
									<input type="text" id="estado_nome" class="form-control" placeholder="Estado" maxlength="100" disabled="disabled">
								</div>
							</div>

							<div class="col-md-6">
								<div class="form-group">
									<label>Cidade</label>
									<input type="text" id="cidade_nome" class="form-control" placeholder="Cidade" maxlength="100" disabled="disabled">
								</div>
							</div>

								<div class="col-md-12">
									<button type="submit" id="botaoSalvarAlteracoes" class="btn btn-success btn-disabled">Salvar alterações</button>
									<span class="loading hide">
										<img src="../../assets/img/load.gif" alt="Carregando...">
									</span>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div><!-- /.col-->
		</div><!-- /.row -->
		
	</div><!--/.main-->
<?php require_once('footer.php'); ?>
	<script type="text/javascript" src="../../assets/js/pags/paciente-editar.js"></script>