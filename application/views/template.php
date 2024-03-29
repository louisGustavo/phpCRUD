<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<title></title>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<link rel="stylesheet" href="<?php echo base_url('assets/css/style.css'); ?>" />
		<link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.css'); ?>" />
		<link rel="stylesheet" href="<?php echo base_url('assets/css/fontawesome.css'); ?>" />
		<link rel="stylesheet" href="<?php echo base_url('assets/css/dataTables.bootstrap4.min.css'); ?>" />
		<link rel="stylesheet" href="<?php echo base_url('assets/css/sweetalert2.min.css'); ?>" />
		<title>CRUD - DashBoard</title>
	</head>
	<body>
		<nav id="menu" class="container-fluid">
			<div class="row">
				<div class="col-md-9 offset-md-1">
					<h3><a href="<?php echo base_url('home'); ?>">CRUD</a></h3>
					<p><?php echo 'Bem Vindo '.$this->session->userdata('user')->username.', '; ?> 
					<a href="<?php echo base_url('login/logout'); ?>">Sair</a></p>
				</div>
			</div>
		</nav>
		<?php echo $contents; ?>
		<footer class="fixed-bottom">			
			<div class="container-fluid">
				<div class="row text-center">
					<div class="col-md-10 offset-md-1">Desenvolvido por <a target="__blank" href="https://github.com/louisGustavo">Luís Gustavo</a></div>
				</div>
			</div>
		</footer>
	</body>
</html>
