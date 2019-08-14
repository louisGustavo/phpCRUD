<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Address extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		verifica_login();
	}

	public function index() {
		$dados = array();
	}

	public function getCep($cep = null) {

		$reg = simplexml_load_file('http://www.buscarcep.com.br/?cep='.$cep.'&formato=xml&chave=1rbEVNkhbk2Xng/bsLzveNrtSozm7M1');

		$dados['cep']                           = (string) $reg->retorno->cep;
		$dados['rua']                           = (string) $reg->retorno->tipo_logradouro . ' ' . $reg->retorno->logradouro;
		$dados['bairro']                        = (string) $reg->retorno->bairro;
		$dados['cidade']                        = (string) $reg->retorno->cidade;
		$dados['estado']                        = (string) $reg->retorno->uf;
		$dados['altitude']                      = (string) $reg->retorno->altitude;
		$dados['longitude']                     = (string) $reg->retorno->longitude;
		$dados['latitude']                      = (string) $reg->retorno->latitude;
		$dados['area']                          = (string) $reg->retorno->area;
		$dados['ibge_uf']                       = (string) $reg->retorno->ibge_uf;
		$dados['ibge_municipio']                = (string) $reg->retorno->ibge_municipio;
		$dados['ibge_municipio_verificador']    = (string) $reg->retorno->ibge_municipio_verificador;
		$dados['resultado']                     = (string) $reg->retorno->resultado;

		print_r($reg);
		exit;
		echo json_encode($dados);
	}
}
