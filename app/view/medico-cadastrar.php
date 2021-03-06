<?php require_once('header.php'); ?>
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#"><i class="fa fa-plus" aria-hidden="true"></i></a></li>
				<li class="active">Cadastrar Médico</li>
			</ol>
		</div><!--/.row-->			
		
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">Cadastrar Médico</div>
					<div class="panel-body">
						<div id="resposta"></div>
						<form id="formCadastrarMedico" action="../action/inserir.php" method="POST">
							<input type="hidden" name="acao" value="cadastrarMedico">
							<div class="col-md-6">
								<div class="form-group">
									<label>Usuário</label>
									<input type="text" class="form-control" placeholder="Usuário" name="usuario[usuario]" maxlength="20">
								</div>

								<div class="form-group">
									<label>CRM</label>
									<input type="number" class="form-control" placeholder="CRM" name="usuario[crm]" maxlength="10">
								</div>
																
								<div class="form-group">
									<label>Nome</label>
									<input type="text" class="form-control" name="usuario[nome]" placeholder="Primeiro Nome" maxlength="100">
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

								<div class="form-group">
									<label>Estado</label>
									<select class="form-control" id="listarEstado" name="usuario[estado_id]" onchange="listarCidades();">
										<option value="">-- Selecione</option>
									</select>
								</div>
							</div>

							<div class="col-md-6">
								<div class="form-group">
									<label>Senha</label>
									<input type="password" class="form-control" placeholder="Senha" name="usuario[senha]" maxlength="20">
								</div>

								<div class="form-group">
									<label>Especialidade</label>
									<select class="form-control" id="listarEspecialidade" name="usuario[especialidade_id]">
										<option value="">-- Selecione</option>
									</select>
								</div>
																
								<div class="form-group">
									<label>Sobrenome</label>
									<input type="text" class="form-control" name="usuario[sobrenome]" placeholder="Sobrenome" maxlength="100">
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
																
								<div class="form-group">
									<label>Complemento</label>
									<input type="text" id="complemento" class="form-control" name="usuario[complemento]" placeholder="Complemento" maxlength="100">
								</div>

								<div class="form-group">
									<label>Cidade</label>
									<select class="form-control" id="listarCidade" name="usuario[cidade_id]">
										<option value="">-- Selecione</option>
									</select>
								</div>
							</div>

							<div class="col-md-12">
								<button type="submit" class="btn btn-primary btn-disabled">Cadastrar</button>
								<button type="reset" class="btn btn-default btn-disabled">Limpar campos</button>
								<span class="loading hide">
									<img src="../../assets/img/load.gif" alt="Carregando...">
								</span>
							</div>
						</form>						
						<form id="formListarEspecialidade" action="../action/listar.php" method="POST">
							<input type="hidden" name="acao" value="listarEspecialidade">
						</form>					
						<form id="formListarEstado" action="../action/listar.php" method="POST">
							<input type="hidden" name="acao" value="listarEstado">
						</form>				
						<form id="formListarCidade" action="../action/listar.php" method="POST">
							<input type="hidden" name="acao" value="listarCidade">
							<input type="hidden" id="estado_id" name="estado_id" value="">
						</form>
					</div>
				</div>
			</div><!-- /.col-->
		</div><!-- /.row -->
		
	</div><!--/.main-->
<?php require_once('footer.php'); ?>
	<script type="text/javascript" src="../../assets/js/pags/medico-cadastrar.js"></script>
</body>
</html>