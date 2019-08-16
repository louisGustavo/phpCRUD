<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Address extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		verifica_login();
		$this->load->model('address/Address_model', 'address');
	}

	public function index() {
		$dados = array();
	}

	public function addAddress() {
		$form = $this->input->post();
		unset($form['id']);
		
		if ($this->address->insert($form)) {
			echo json_encode(array('status' => 'sucesso'));
		} else {
			echo json_encode(array('status' => 'erro'));
		}
	}

	public function editAddress() {
		$form 		= $this->input->post();
		$id 			= $form['id'];
		$user_id 	= $form['add_user_id'];
		
		unset($form['id']);
		unset($form['add_user_id']);

		if ($this->address->update($form, $id)) {
			echo json_encode(array('status' => 'sucesso', 'add_user_id' =>$user_id));
		} else {
			echo json_encode(array('status' => 'erro'));			
		}
	}

	public function deleteAddress() {
		$id = $this->input->post('id');

		if ($this->address->delete($id)) {
			echo json_encode(array('status' => 'sucesso'));
		} else {
			echo json_encode(array('status' => 'erro'));
		}
	}

	public function returnAddress() {
		$add_user_id 	= $this->input->post('id');
		$address 			= $this->address->getAddress($add_user_id);
		
		if ($address) {
			echo json_encode(array('status' => 'sucesso', 'address' => $address));
		} else {
			echo json_encode(array('status' => 'sem_resultados'));
		}
	}

	public function getTheAddress() {
		$id 			= $this->input->post('id');
		$address 	= $this->address->returnOneAdress($id);

		echo json_encode($address);
	}

	public function getCep($cep = null) {

		$reg = simplexml_load_file('http://www.buscarcep.com.br/?cep='.$cep.'&formato=xml&chave=1rbEVNkhbk2Xng/bsLzveNrtSozm7M1');

		$dados['rua'] 			= (string) $reg->retorno->tipo_logradouro . ' ' . $reg->retorno->logradouro;
		$dados['bairro'] 		= (string) $reg->retorno->bairro;
		$dados['estado'] 		= (string) $reg->retorno->uf;
		$dados['ibge'] 			= (string) $reg->retorno->ibge_municipio_verificador;
		$dados['resultado'] = (string) $reg->retorno->resultado;

		echo json_encode($dados);
	}
}
