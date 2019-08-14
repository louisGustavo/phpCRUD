<section class="container-fluid" id="cadastro-clientes">
	<div class="row">
		<div class="col-md-10 offset-md-1">
		<h3>NOVO CLIENTE</h3>
		</div>
	</div>
	<hr>
	<div class="row">
		<div class="col-md-10 offset-md-1">
			<form id="add-costumer">
				<div class="form-body">
					<div class="row">
						<div class="col-md-9">
							<div class="form-group">
								<label for="cost_name">Nome Completo</label>
								<input type="text" class="form-control" name="cost_name" id="cost_name">
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label for="cost_datenasc">Data de Nascimento</label>
								<input type="date" class="form-control" name="cost_datenasc" id="cost_datenasc">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-3">
							<div class="form-group">
								<label for="cost_cpf">CPF</label>
								<input type="text" class="form-control" name="cost_cpf" id="cost_cpf">
								<div id="cpf-feedback"></div>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label for="cost_rg">RG</label>
								<input type="text" class="form-control" name="cost_rg" id="cost_rg">
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label for="cost_typephone">Tipo de Telefone</label>
								<select id="cost_typephone" name="cost_typephone" class="form-control">
									<option value="">Selecione</option>
									<option value="F">Fixo</option>
									<option value="C">Celular</option>
								</select>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label for="cost_phone">Telefone</label>
								<input readonly type="text" class="form-control" name="cost_phone" id="cost_phone">
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<button type="submit" class="form-control btn btn-success">Salvar</button>
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
	<hr>
	<div class="row">
		<div class="col-md-10 offset-md-1">
		<h3>ENDEREÇOS</h3>
		</div>
	</div>
	<div class="row">
		<div class="col-md-10 offset-md-1">
			<form id="add-address">
					<div class="form-body">
						<div class="row">
							<div class="col-md-2">
								<div class="form-group">
									<label for="add_cep">CEP</label>
									<input type="text" class="form-control" name="add_cep" id="add_cep">
								</div>
							</div>
							<div class="col-md-5">
								<div class="form-group">
									<label for="add_street">Rua</label>
									<input type="text" class="form-control" name="add_street" id="add_street">
								</div>
							</div>
							<div class="col-md-2">
								<div class="form-group">
									<label for="add_number">Nº</label>
									<input type="text" class="form-control" name="add_number" id="add_number">
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label for="add_comple">Complemento</label>
									<input type="text" class="form-control" name="add_comple" id="add_comple">
								</div>
							</div>							
						</div>
						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<label for="add_bairro">Bairro</label>
									<input type="text" class="form-control" name="add_bairro" id="add_bairro">
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="add_cidade">Cidade</label>
									<select name="add_cidade" id="add_cidade" class="form-control">
										<option value=""></option>
									</select>
								</div>
							</div>
							<div class="col-md-1">
								<div class="form-group">
									<label for="add_estado">Estado</label>
									<input type="text" class="form-control" name="add_estado" id="add_estado">
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label for="add_estado">.</label>
									<button type="submit" class="form-control btn btn-info"><i class="fa fa-plus"> Cadastrar Endereço</i></button>
								</div>
							</div>
						</div>
					</div>
					</div>
				</div>
			</form>
		</div>
	</div>
	<hr>
	<div class="row">
		<div class="col-md-10 offset-md-1">
		<h3>ENDEREÇOS CADASTRADOS</h3>
		</div>
	</div>
	<div class="row" id="box-listagem-clientes">
		<div class="col-md-10 offset-md-1">
			<div class="table-responsive">
				<table id="tabela-clientes" class="table">
					<thead>
						<tr>
							<th>id</th>
							<th>CEP</th>
							<th>Rua</th>
							<th>Nº</th>
							<th>Bairro</th>
							<th>Cidade</th>
							<th>Ações</th>
						</tr>
					</thead>
					<tbody>
						<?php //foreach($costumers as $costumers): ?>
						<tr>
							<th><?php //echo $costumers->id; ?></th>
							<td><?php //echo $costumers->cost_name; ?></td>
							<td><?php //echo data_br($costumers->cost_datenasc); ?></td>
							<td><?php //echo $costumers->cost_cpf; ?></td>
							<td><?php //echo $costumers->cost_rg; ?></td>
							<td><?php //echo $costumers->cost_fone; ?></td>
							<td class="text-center" id="btn-acoes">
								<a href="<?php //echo base_url('costumers/edit/'.$costumers->id) ?>" id="btn-edit" title="Editar Cliente"><i class="fa fa-user-edit"> Editar</i></a>
								<a href="<?php //echo base_url('costumers/delete/'.$costumers->id) ?>" id="btn-delete" title="Excluir Cliente"><i class="fa fa-user-times"> Excluir</i></a>
							</td>
						</tr>
						<?php //endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</section>
<script src="<?php echo base_url('assets/js/jquery-3.4.1.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/scripts.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/jquery.mask.js'); ?>"></script>
<script>
$(document).ready(function() {
	$('#cost_cpf').mask('000.000.000-00');
	$('.phone-fixo').mask('(00) 0000-0000');
	$('.phone-celular').mask('(00) 0.0000-0000');
	$('.cep').mask('00.000-000');

	$('#cost_cpf').on('change', function(){
		if (validarCPF(this) == true) {
			$(this).addClass('is-valid');
			$(this).removeClass('is-invalid');
			$('#cpf-feedback').html('Tudo Certo');
		} else {
			$(this).addClass('is-invalid');
			$(this).removeClass('is-valid');
			$('#cpf-feedback').html('CPF Inválido');
		}
	});

	$('#cost_typephone').on('change', function(){
		var typePhone = $(this).val();
		$('#cost_phone').val('');
		if (typePhone == 'F') {
			$('#cost_phone').attr('readonly', false);
			$('#cost_phone').mask('(00) 0000-0000');
		} else if(typePhone == 'C') {
			$('#cost_phone').attr('readonly', false);
			$('#cost_phone').mask('(00) 0.0000-0000');
		} else {
			$('#cost_phone').attr('readonly', true);
		}
	});
} );
</script>

