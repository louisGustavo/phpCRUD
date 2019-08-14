<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="<?php echo base_url('assets/css/style.css'); ?>" />
	<link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.css'); ?>" />
	<title>CRUD - Bem Vindo</title>
</head>
<body>
	<div class="container-fluid">
		<div class="row">
			<div class="col-xs-10 col-md-4 offset-md-4">
				<form id="form-login">
					<div class="form-group text-center">
						<!--
						<img src="<?php //echo base_url('assets/img/logo.jpg'); ?>" alt="logo" class="img-fluid">
						-->
						<div id="msg" class="alert alert-warning" role="alert"></div>
						<input required type="mail" name="email" id="email" class="form-control" placeholder="Informe o email de acesso">
						<input required type="password" name="password" id="password" class="form-control" placeholder="******">
						<input type="submit" value="LOGIN" class="form-control">
					</div>
				</form>
			</div>
		</div>
	</div>
	<script src="<?php echo base_url('assets/js/jquery-3.4.1.min.js'); ?>"></script>
	<script src="<?php echo base_url('assets/js/bootstrap.js'); ?>"></script>
	<script src="<?php echo base_url('assets/js/scripts.js'); ?>"></script>
	<script>
		$(document).ready(function(){
			$('#form-login').on('submit', function(e){
				e.preventDefault();
				executaLogin($(this).serialize());
			});
		});
	</script>
</body>
</html>
