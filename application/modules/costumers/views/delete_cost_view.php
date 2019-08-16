<section class="container-fluid" id="container-clientes">
	<div class="row">
		<div class="col-md-10 offset-md-1">
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="<?php echo base_url('home') ?>">Home</a></li>
				<li class="breadcrumb-item active" aria-current="page"><?php echo 'Excluir Cliente #'.$costumer->id; ?></li>
			</ol>
		</nav>
		</div>
	</div>
	<hr>
</section>
<section class="container-fluid">
	<div class="row">
		<div class="col-md-10 offset-md-1">
			<form id="excluir-cliente">
				<input type="hidden" id="id" value="<?php echo $costumer->id; ?>">
				<button class="btn btn-danger" type="submit">Excluir Cliente e Seus Endereços</button>
			</form>
			<hr>
		</div>
	</div>
	<div class="row">
		<div class="col-md-10 offset-md-1">
			<h3>DADOS PESSOAIS</h3>
			<table class="table table-striped">
				<tbody>
					<tr>
						<th scope="row">id</th>
						<td><?php echo $costumer->id; ?></td>
					</tr>
					<tr>
						<th scope="row">Nome</th>
						<td><?php echo $costumer->cost_name; ?></td>
					</tr>
					<tr>
						<th scope="row">Data de Nascimento</th>
						<td><?php echo data_br($costumer->cost_datenasc); ?></td>
					</tr>
					<tr>
						<th scope="row">CPF</th>
						<td><?php echo $costumer->cost_cpf; ?></td>
					</tr>
					<tr>
						<th scope="row">RG</th>
						<td><?php echo $costumer->cost_rg; ?></td>
					</tr>
					<tr>
						<th scope="row">Telefone</th>
						<td><?php echo $costumer->cost_phone; ?></td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
	<hr>
	<div id="box-listagem-address">
		<div class="row">
			<div class="col-md-10 offset-md-1">
			<h3>ENDEREÇOS CADASTRADOS</h3>
			</div>
		</div>
		<div class="row">
			<div class="col-md-10 offset-md-1">
				<div id="listagem-address" class="table-responsive"></div>
			</div>
		</div>
	</div>
</section>
<script src="<?php echo base_url('assets/js/jquery-3.4.1.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/sweetalert2.all.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/scripts.js'); ?>"></script>
<script>
	$(document).ready(function(){
		getAddress(<?php echo $costumer->id; ?>);

		$('#excluir-cliente').on('submit', function(e){
			e.preventDefault();
			var id = $('#id').val();
			removeCostumer(id);
		});
	});
</script>
