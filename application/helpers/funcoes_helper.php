<?php
if (!function_exists('verifica_login')) {
	//verifica se o usuário esta logado, caso não, redireciona para outra páqina
	function verifica_login($redirect = 'login'){
		$ci = & get_instance();
		if ($ci->session->userdata('logged') != TRUE) {
			redirect($redirect, 'refresh');
		}
	}
}
if (!function_exists('data_bd')) {
	function data_bd($data_br){
	  return implode('-',array_reverse(explode('/',$data_br)));
	}
}
if (!function_exists('data_br')) {
	function data_br($data_bd){
	  return implode('/',array_reverse(explode('-',$data_bd)));
	}
}
