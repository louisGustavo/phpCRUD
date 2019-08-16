var getUrl  = window.location;
var baseUrl = getUrl .protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1];

//-----------------------------| MASCARAS |------------------------------------
$('#cost_cpf').mask('000.000.000-00');
$('.cep').mask('00.000-000');

//--------------------| VERIFICA DADOS PARA LOGIN |----------------------------
function executaLogin(form) {
	$.ajax({
		type: 'POST',
		url: baseUrl+'/login/logar',
		data: form,
		dataType: 'json',
		beforeSend: function(){
			$('#msg').html('');
			$('#msg').fadeOut();
		},
		success: function(data){
			if (data.status == 'sucesso') {
				window.location.replace(baseUrl+'/home');
			} else if (data.status == 'userNotFound') {
				$('#msg').html('Email não encontrado. Verifique se digitou corretamente e tente novamente');
				$('#msg').fadeIn();
			} else if (data.status == 'passIncorrect') {
				$('#msg').html('Senha Incorreta. Verifique se digitou corretamente e tente novamente');
				$('#msg').fadeIn();
			}
		}
	});
}
//--------------------| FIM VERIFICA DADOS PARA LOGIN |------------------------

//---------------------------| VALIDADOR DE CPF |------------------------------
function validarCPF(id_campo_cpf){
	var myCPF = $(id_campo_cpf).val().replace('.', '').replace('.', '').replace('-', '');
	var numeros, digitos, soma, i, resultado, digitos_iguais;
	digitos_iguais = 1;

	if (myCPF.length < 11 && myCPF.length != '') {
			$(id_campo_cpf).val("");
			return false;
	}
	for (i = 0; i < myCPF.length - 1; i++)
			if (myCPF.charAt(i) != myCPF.charAt(i + 1)) {
					digitos_iguais = 0;
					break;
			}
			if (!digitos_iguais) {
					numeros = myCPF.substring(0, 9);
					digitos = myCPF.substring(9);
					soma    = 0;
					for (i = 10; i > 1; i--)
							soma       += numeros.charAt(10 - i) * i;
							resultado   = soma % 11 < 2 ? 0 : 11 - soma % 11;
							if (resultado != digitos.charAt(0)) {
									$(id_campo_cpf).val("");
									return false;
							}
							numeros = myCPF.substring(0, 10);
							soma    = 0;
							for (i = 11; i > 1; i--)
									soma += numeros.charAt(11 - i) * i;
									resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
									if (resultado != digitos.charAt(1)) {
											$(id_campo_cpf).val("");
											return false;
									}
									return true;
	}
	else{
			$(id_campo_cpf).val("");
			return false;
	}
}
//-----------------| FIM VALIDADOR DE CPF |-------------------------------------

//-------------| RETORNA O CEP CONFORME O CEP INFORMADO |-------------
function getEndereco(baseUrl, id, end, bairro, ibge, estado){
	$(id).on('blur', function(){
		var cep = $(id).val().replace('.','').replace('-','');
		$.ajax({
			url:baseUrl+'/address/getcep/' + cep,
			type:'POST',
			dataType:'json',
			beforeSend: function(){
				$(end).val('Carregando...');
				$(bairro).val('Carregando...');
				$(ibge).val('Carregando...');
				$(estado).val('Carregando...');
				$(ibge).removeAttr('selected');
			},
			success: function(data){
				if (data.resultado == 1) {
					$(end).val(data.rua);
					$(bairro).val(data.bairro);
					$(ibge).val(data.ibge);
					$(ibge).prop('selected', true).change();
					$(estado).val(data.estado);
				}else{
					$(end).val("");
					$(bairro).val("");
					$(ibge).val("");
					$(estado).val("");
				}
			}
		});
	});
}
//--------| FIM RETORNA O CEP CONFORME O CEP INFORMADO |--------------

//-----------| GRAVA OS DADOS DO CLIENTE INFORMADO |------------------
function addCostumer(form) {
	$.ajax({
		type: 'POST',
		url: baseUrl+'/costumers/addCostumer',
		data: form,
		dataType: 'json',
		beforeSend: function(){
			Swal.fire({
				title: 'Aguarde',
				text: 'Seus dados estão sendo salvos',
				type: 'warning',
				showConfirmButton: false
			});
		},
		success: function(data){
			if (data.status == 'sucesso') {
				Swal.fire({
					title: 'Concluído',
					text: 'Dados Salvos com Sucesso',
					type: 'success',
					timer: 2000
				});
				bloqueiaForm();
				$('#box-add-address').fadeIn();
				$('#add_user_id').val(data.id);
			} else if(data.status == 'duplicidade') {
				Swal.fire({
					title: 'Duplicidade',
					text: 'O CPF informado já se encontrada cadastrado',
					type: 'warning'
				});
			} else {
				Swal.fire({
					title: 'Erro',
					text: 'Houve algum problema ao salvar os dados',
					type: 'error'
				});
			}
		}
	});
}
//----------------| FIM GRAVA OS DADOS DO CLIENTE INFORMADO |-------------------

//------------------| EXCLUI OS DADOS DO CLIENTE INFORMADO |--------------------
function removeCostumer(id) {
	$.ajax({
		type: 'POST',
		url: baseUrl+'/costumers/removeCostumer',
		data: {id : id},
		dataType: 'json',
		beforeSend: function(){
			Swal.fire({
				title: 'Aguarde',
				text: 'Excluindo Registro',
				type: 'warning',
				showConfirmButton: false
			});
		},
		success: function(data){
			if (data.status == 'sucesso') {
				Swal.fire({
					title: 'Registro Excluído',
					text: 'Direcionando para a Home',
					type: 'success',
					showConfirmButton: false,
					timer: 2000
				});
				setTimeout(function(){
					window.location.href = baseUrl+'/home';
				}, 2000);
			} else {
				Swal.fire({
					title: 'Erro',
					text: 'Houve algum problema ao excluir o registro',
					type: 'error'
				});
			}
		}
	});
}
//--------------| FIM EXCLUI OS DADOS DO CLIENTE INFORMADO |--------------------

//---------------------| BLOQUEIA O FORM DO CLIENTE |---------------------------
function bloqueiaForm() {
	$('#cost_name').attr('readonly', true);
	$('#cost_datenasc').attr('readonly', true);
	$('#cost_cpf').attr('readonly', true);
	$('#cost_rg').attr('readonly', true);
	$('#cost_typephone').attr('disabled', true);
	$('#cost_phone').attr('readonly', true);
	$('#btn-add-costumer').fadeOut();
	$('#cpf-feedback').html('');
}
//---------------| FIM BLOQUEIA O FORM DO CLIENTE |-----------------------

//--------------| RETORNA OS ENDEREÇOS CADASTRADOS |-----------------------
function getAddress(add_user_id, view = null) {
	$.ajax({
		type: 'POST',
		url: baseUrl+'/address/returnAddress',
		data: { id: add_user_id },
		dataType: 'json',
		beforeSend: function(){
			$('#listagem-address').html('');
			$('#box-listagem-address').fadeOut();
		},
		success: function(data){
			var html;
			if (data.status == 'sucesso') {
				html  = '<table class="table">';
				html += '	<thead>';
				html += '		<tr>';
				html += '			<th>id</th>';
				html += '			<th>CEP</th>';
				html += '			<th>Rua</th>';
				html += '			<th>Nº</th>';
				html += '			<th>Complemento</th>';
				html += '			<th>Bairro</th>';
				html += '			<th>Cidade</th>';
				html += '			<th>UF</th>';
				if (view == 'EDIT') {
				html += '			<th>Ações</th>';
				}
				html += '		</tr>';
				html += '	</thead>';
				html += '	<tbody>';
				$.each(data.address, function(i, address) {
				html += '		<tr>';
				html += '			<th>'+address.id+'</th>';
				html += '			<td>'+address.add_cep+'</td>';
				html += '			<td>'+address.add_street+'</td>';
				html += '			<td>'+address.add_number+'</td>';
				html += '			<td>'+address.add_comple+'</td>';
				html += '			<td>'+address.add_bairro+'</td>';
				html += '			<td>'+address.nomecidade+'</td>';
				html += '			<td>'+address.add_estado+'</td>';
				if (view == 'EDIT') {
				html += '			<td>';
				html += '				<a id="edit-address-'+address.id+'" class="edit-address" idad="'+address.id+'" href="#" title="Editar">';
				html += '					<i class="fa fa-edit text-success"></i></a>';
				html += '|';
				html += '				<a id="delete-address-'+address.id+'" class="delete-address" idad="'+address.id+'" title="Excluir" href="#">';
				html += '					<i class="fa fa-trash text-danger"></i></a>';
				html += '			</td>';
				}
				html += '		</tr>';
				});
				html += '	</tbody>';
				html += '</table>';
			} else {
				html = '<div class="alert alert-info">NENHUM ENDEREÇO CADASTRADO :(</div>';
			}
			$('#listagem-address').append(html);
			$('#box-listagem-address').fadeIn();

			$('.edit-address').each(function(){
				var id = $(this).attr('idad');
				$('#edit-address-'+id).on('click', function(e){
					e.preventDefault();
					formEditAddress(id);
				});
			});

			$('.delete-address').each(function(){
				var id = $(this).attr('idad');
				$('#delete-address-'+id).on('click', function(e){
					e.preventDefault();
					deleteAddress(id, add_user_id);
				});
			});
		}
	});
}
//--------------| FIM RETORNA OS ENDEREÇOS CADASTRADOS |-----------------------

//----------------| FORM EDITAR ENDEREÇOS CADASTRADOS |-------------------------
function editAddress(form) {
	$.ajax({
		type: 'POST',
		url: baseUrl+'/address/editAddress',
		data: form,
		dataType: 'json',
		beforeSend: function(){
			Swal.fire({
				title: 'Aguarde',
				text: 'Salvando Alterações',
				type: 'warning',
				showConfirmButton: false
			});
		},
		success: function(data){
			if (data.status == 'sucesso') {
				Swal.fire({
					title: 'Concluído',
					text: 'Registro Alterado com Sucesso',
					type: 'success',
					timer: 2000
				});
				getAddress(data.add_user_id, 'EDIT');
				preparaFormAddress('NEW');
				limpaFormAddress();
			} else {
				Swal.fire({
					title: 'Erro',
					text: 'Houve algum problema ao alterar o registro',
					type: 'error'
				});
			}
		}
	});
}
//------------| FIM FORM EDITAR ENDEREÇOS CADASTRADOS |-------------------------

//---------------| RETORNA DADOS PARA EDIÇÃO ENDEREÇO |-------------------------
function formEditAddress(id){
	$('#box-listagem-address').fadeOut();
	$.ajax({
		type: 'POST',
		url: baseUrl+'/address/getTheAddress',
		data: {id : id},
		dataType: 'json',
		beforeSend: function(){
			Swal.showLoading();
			Swal.fire({
				title: 'Aguarde',
				text: 'Carregando Dados',
				type: 'success',
				showConfirmButton: false,
				timer: 2000
			});
		},
		success: function(data){
			preparaFormAddress('UPDATE', id);
			$('#idaddress').val(data.id);
			$('#add_cep').val(data.add_cep);
			$('#add_street').val(data.add_street);
			$('#add_number').val(data.add_number);
			$('#add_comple').val(data.add_comple);
			$('#add_bairro').val(data.add_bairro);
			$('#add_cidade').val(data.add_cidade).change();
			$('#add_estado').val(data.add_estado);
		}
	});
}
//--------------| FIM RETORNA DADOS PARA EDIÇÃO ENDEREÇO |----------------------

//--------------------| PREPARA FORM CONFORME TIPO |----------------------------
function preparaFormAddress(tipoForm, id = null) {
	if (tipoForm == 'NEW') {
		$('#idaddress').attr('required', false);
		$('#title-form-address').html('CADASTRAR NOVO ENDEREÇO');
		$('#tipo-form').val('newAddress');
		$('#btn-form-address').html('<i class="fa fa-plus"> Cadastrar Endereço</i>');
		$('#btn-form-address').addClass('btn-info');
		$('#btn-form-address').removeClass('btn-success');
	} else if (tipoForm == 'UPDATE') {
		$('#idaddress').attr('required', true);
		$('#title-form-address').html('EDITAR ENDEREÇO #'+id);
		$('#tipo-form').val('editAddress');
		$('#btn-form-address').html('<i class="fa fa-edit"> Salvar Alterações</i>');
		$('#btn-form-address').removeClass('btn-info');
		$('#btn-form-address').addClass('btn-success');
	}
}
//---------------------| FIM PREPARA FORM CONFORME TIPO |-----------------------

//--------------------------| FORM DELETAR ENDERÇOS |---------------------------
function deleteAddress(id, add_user_id) {
	Swal.fire({
		title: 'Voce Tem Certeza?',
		text: "Este registro será excluído permanetmente",
		type: 'question',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Excluir Endereço',
		cancelButtonText: 'Cancelar'
	}).then((result) => {
		if (result.value) {
			$.ajax({
				type: 'POST',
				url: baseUrl+'/address/deleteAddress',
				data: {id : id},
				dataType: 'json',
				beforeSend: function(){
					Swal.fire({
						title: 'Aguarde',
						text: 'Exclusão em Andamento',
						type: 'warning',
						showConfirmButton: false
					});
				},
				success: function(data){
					if (data.status == 'sucesso') {
						Swal.fire({
							title: 'Concluído',
							text: 'Registro Excluído',
							type: 'success',
							timer: 2000
						});
						getAddress(add_user_id);
					} else {
						Swal.fire({
							title: 'Erro',
							text: 'Houve algum problema ao excluir o registro',
							type: 'error'
						});
					}
				}
			});
		} else {
			Swal.fire(
				'OK!',
				'Ação Cancelada',
				'success'
			)
		}
	});
}
//-------------------| FIM FORM DELETAR ENDERÇOS |---------------------------

//---------------------| LIMPA FORM ENDEREÇOS |--------------------------------
function limpaFormAddress(){
	$('#add_cep').val('');
	$('#add_street').val('');
	$('#add_number').val('');
	$('#add_comple').val('');
	$('#add_bairro').val('');
	$('#add_cidade').val('').change();
	$('#add_estado').val('');
}
//--------------------| FIM LIMPA FORM ENDEREÇOS |------------------------------

//------------------------| FORM ADD ENDEREÇOS |--------------------------------
function addAddress(form, add_user_id) {
	$.ajax({
		type: 'POST',
		url: baseUrl+'/address/addAddress',
		data: form,
		dataType: 'json',
		beforeSend: function(){},
		success: function(data){
			if (data.status == 'sucesso') {
				getAddress(add_user_id);
				limpaFormAddress();
			} else {
				Swal.fire({
					title: 'Erro',
					text: 'Houve algum problema ao salvar os dados',
					type: 'error'
				});
			}
		}
	});
}
//--------------------| FIM FORM ADD ENDEREÇOS |--------------------------------

//-----------| ALTERA OS DADOS DO CLIENTE INFORMADO |------------------
function editCostumer(form) {
	$.ajax({
		type: 'POST',
		url: baseUrl+'/costumers/editCostumer',
		data: form,
		dataType: 'json',
		beforeSend: function(){
			Swal.fire({
				title: 'Aguarde',
				text: 'Seus dados estão sendo salvos',
				type: 'warning',
				showConfirmButton: false
			});
		},
		success: function(data){
			if (data.status == 'sucesso') {
				Swal.fire({
					title: 'Concluído',
					text: 'Dados Alterados com Sucesso',
					type: 'success',
					timer: 2000
				});
			} else if(data.status == 'duplicidade') {
				Swal.fire({
					title: 'Duplicidade',
					text: 'O CPF informado já se encontrada cadastrado',
					type: 'warning'
				});
			} else {
				Swal.fire({
					title: 'Erro',
					text: 'Houve algum problema ao salvar os dados',
					type: 'error'
				});
			}
		}
	});
}
//--------| FIM ALTERA OS DADOS DO CLIENTE INFORMADO |------------------
