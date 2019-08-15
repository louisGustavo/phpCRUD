<section class="container-fluid" id="container-clientes">
	<div class="row">
		<div class="col-md-8 offset-md-1">
		<h3>LISTAGEM DE CLIENTES</h3>
		</div>
		<div class="col-md-2 text-right">
			<a href="<?php echo base_url('costumers/new'); ?>" class="btn btn-info"><i class="fa fa-user-plus"> Novo Cliente</i></a>
		</div>
	</div>
	<hr>
	<?php if($costumers): ?>
	<div class="row" id="box-listagem-clientes">
		<div class="col-md-10 offset-md-1">
			<div class="table-responsive">
				<table id="tabela-clientes" class="table">
					<thead>
						<tr>
							<th>id</th>
							<th>Nome</th>
							<th>Nascimento</th>
							<th>CPF</th>
							<th>RG</th>
							<th>Telefone</th>
							<th>Ações</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach($costumers as $costumers): ?>
						<tr>
							<th><?php echo $costumers->id; ?></th>
							<td><?php echo $costumers->cost_name; ?></td>
							<td><?php echo data_br($costumers->cost_datenasc); ?></td>
							<td><?php echo $costumers->cost_cpf; ?></td>
							<td><?php echo $costumers->cost_rg; ?></td>
							<td><?php echo $costumers->cost_phone; ?></td>
							<td class="text-center" id="btn-acoes">
								<a href="<?php echo base_url('costumers/show/'.$costumers->id) ?>" id="btn-show" title="Visualizar Cliente"><i class="fa fa-user"></i></a>
								<a href="<?php echo base_url('costumers/edit/'.$costumers->id) ?>" id="btn-edit" title="Editar Cliente"><i class="fa fa-user-edit"></i></a>
								<a href="<?php echo base_url('costumers/delete/'.$costumers->id) ?>" id="btn-delete" title="Excluir Cliente"><i class="fa fa-user-times"></i></a>
							</td>
						</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<?php else: ?>
	<div class="row" id="box-listagem-clientes">
		<div class="col-md-10 offset-md-1 text-center">
			<div class="alert alert-dark" role="alert">
				<h1>:(</h1>
				<p>SEM CLIENTES CADASTRADOS</p>
			</div>
		</div>
	</div>
	<?php endif; ?>
</section>
<script src="<?php echo base_url('assets/js/jquery-3.4.1.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/bootstrap.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/jquery.dataTables.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/dataTables.bootstrap4.min.js'); ?>"></script>
<script>
$(document).ready(function() {
    $('#tabela-clientes').DataTable();
} );
</script>
