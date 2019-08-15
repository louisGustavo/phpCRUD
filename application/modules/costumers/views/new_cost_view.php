<section class="container-fluid" id="container-clientes">
	<div class="row">
		<div class="col-md-10 offset-md-1">
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="<?php echo base_url('home') ?>">Home</a></li>
					<li class="breadcrumb-item active" aria-current="page">Novo Cliente</li>
				</ol>
			</nav>
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
								<input required type="text" class="form-control" name="cost_name" id="cost_name">
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label for="cost_datenasc">Data de Nascimento</label>
								<input required type="date" class="form-control" name="cost_datenasc" id="cost_datenasc">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-3">
							<div class="form-group">
								<label for="cost_cpf">CPF</label>
								<input required type="text" class="form-control" name="cost_cpf" id="cost_cpf">
								<div id="cpf-feedback"></div>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label for="cost_rg">RG</label>
								<input required type="text" class="form-control" name="cost_rg" id="cost_rg">
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label for="cost_typephone">Tipo de Telefone</label>
								<select required id="cost_typephone" name="cost_typephone" class="form-control">
									<option value="">Selecione</option>
									<option value="F">Fixo</option>
									<option value="C">Celular</option>
								</select>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label for="cost_phone">Telefone</label>
								<input required readonly type="text" class="form-control" name="cost_phone" id="cost_phone">
							</div>
						</div>
						<div class="col-md-3" id="btn-add-costumer">
							<div class="form-group">
								<button type="submit" class="form-control btn btn-success">Salvar</button>
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
	<div id="box-add-address">
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
										<input required type="text" class="form-control cep" name="add_cep" id="add_cep">
										<input required type="hidden" name="add_user_id" id="add_user_id">
									</div>
								</div>
								<div class="col-md-5">
									<div class="form-group">
										<label for="add_street">Rua</label>
										<input required type="text" class="form-control" name="add_street" id="add_street">
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<label for="add_number">Nº</label>
										<input required type="text" class="form-control" name="add_number" id="add_number">
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
										<input required type="text" class="form-control" name="add_bairro" id="add_bairro">
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label for="add_cidade">Cidade</label>
										<select required name="add_cidade" id="add_cidade" class="form-control">
											<option value=""></option>
											<?php foreach($cities as $city): ?>
											<option uf="<?php echo $city->uf; ?>" value="<?php echo $city->cCodIBGE; ?>"><?php echo $city->nome; ?></option>
											<?php endforeach; ?>
										</select>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<label for="add_estado">Estado</label>
										<input required type="text" class="form-control" name="add_estado" id="add_estado">
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<label for="">.</label>
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
	</div>
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
		<div class="row alert alert-info" id="footer-info">
			<hr>
			<div class="col-md-10 offset-md-1 text-center">
				<p>CONTINUE ADICIONANDO ENDEREÇOS OU CLIQUE <a href="<?php echo base_url('home'); ?>">AQUI</a> PARA VOLTAR PARA A HOME</p>
			</div>
			<hr>
		</div>
	</div>
</section>
<script src="<?php echo base_url('assets/js/jquery-3.4.1.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/jquery.mask.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/sweetalert2.all.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/scripts.js'); ?>"></script>
<script>
$(document).ready(function() {

	$('#add-address').on('submit', function(e){
		e.preventDefault();
		var form 		= $(this).serialize();
		var add_user_id = $('#add_user_id').val();
		addAddress(form, add_user_id);
	});

	$('#add-costumer').on('submit', function(e){
		e.preventDefault();
		var form = $(this).serialize();

		Swal.fire({
			title: 'Tudo Certo?',
			text: "Podemos Salvar os dados do cliente informado?",
			type: 'question',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Salvar os Dados do Cliente!',
			cancelButtonText: 'Cancelar'
		}).then((result) => {
			if (result.value) {
				addCostumer(form);
			} else {
				Swal.fire(
					'OK!',
					'Ação Cancelada',
					'success'
				)
			}
		});
	});

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
	
	$('#add_cidade').on('change', function(){
		var UF = $(this).find(':selected').attr('uf');
		$('#add_estado').val(UF);
	});

	getEndereco(baseUrl, '#add_cep', '#add_street', '#add_bairro', '#add_cidade', '#add_estado');
} );
</script>

