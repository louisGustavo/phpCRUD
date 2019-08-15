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
//--------| FIM GRAVA OS DADOS DO CLIENTE INFORMADO |------------------

//----------------| BLOQUEIA O FORM DO CLIENTE |-----------------------
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
function getAddress(add_user_id) {
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
				html += '		</tr>';
				});
				html += '	</tbody>';
				html += '</table>';
			}
			$('#listagem-address').append(html);
			$('#box-listagem-address').fadeIn();
		}
	});
}
//--------------| FIM RETORNA OS ENDEREÇOS CADASTRADOS |-----------------------

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
