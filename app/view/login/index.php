<?php
if(isset($_SESSION['usuario']))
{
	header("Location: ../");
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=1,initial-scale=1,user-scalable=1" />

	<title>Autenticação - SysMedic</title>
	
	<link href="http://fonts.googleapis.com/css?family=Lato:100italic,100,300italic,300,400italic,400,700italic,700,900italic,900" rel="stylesheet" type="text/css">
	<link rel="stylesheet" type="text/css" href="../../../assets/css/bootstrap.css" />
	<link rel="stylesheet" type="text/css" href="../../../assets/login/css/styles.css" />
	<link rel="stylesheet" type="text/css" href="../../../assets/css/sweetalert.css">
	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>

<section class="container">
		<section class="login-form">
			<form method="POST" action="../../../app/action/listar.php" role="login" id="formLogar">
				<input type="hidden" name="acao" value="logar">
				<img src="../../../assets/login/images/logo.png" class="img-responsive" alt="" />

				<input type="text" name="usuario[usuario]" placeholder="Usuario" class="form-control input-lg" />
				
				<input type="password" name="usuario[senha]" placeholder="Senha" class="form-control input-lg" />
				
				<button type="submit" id="botaoLogar" class="btn btn-lg btn-primary btn-block">Autenticar</button>
				<span class="loading hide">
					<center><img src="../../../assets/img/load.gif" alt="Carregando..."></center>
				</span>
			</form>
			<div class="form-links">
				<a href="#">www.google.com</a>
			</div>
		</section>
</section>

<script type="text/javascript" src="../../../assets/js/jquery-2.2.3.min.js"></script>
<script src="../../../assets/js/bootstrap.min.js"></script>

	<!-- Início Base do AJAX -->
<script type="text/javascript" src="../../../assets/js/notificacao.js"></script>
<script type="text/javascript" src="../../../assets/js/ajax.js"></script>
<!-- Fim Base do AJAX -->

<!-- jQuery Validation -->
<script type="text/javascript" src="../../../assets/js/validation/jquery.validate.min.js"></script>
<script type="text/javascript" src="../../../assets/js/validation/localization/messages_pt_BR.min.js"></script>

<script type="text/javascript" src="../../../assets/js/sweetalert.min.js"></script>
<script type="text/javascript" src="../../../assets/js/pags/login/index.js"></script>
</body>
</html>