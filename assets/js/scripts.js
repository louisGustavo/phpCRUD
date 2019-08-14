var getUrl  = window.location;
var baseUrl = getUrl .protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1];

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
							window.onkeydown = null;
							window.onfocus = null;
							 if (data.resultado == 1) {
									 $(end).val(data.rua);
									 $(bairro).val(data.bairro);
									 $(ibge).val(data.ibge_municipio_verificador);
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
