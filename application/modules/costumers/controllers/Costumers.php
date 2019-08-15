<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Costumers extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		verifica_login();
		$this->load->model('costumers/Costumers_model', 'costumers');
		$this->load->model('cadcidades/Cadcidades_model', 'cadcidades');
	}

	public function index() {
		$dados = array();
		$this->template->load('template', 'new_cost_view', $dados);
	}

	public function new() {
		$dados = array();
		$dados['cities'] = $this->cadcidades->getCities();
		$this->template->load('template', 'new_cost_view', $dados);
	}

	public function addCostumer() {
		$form = $this->input->post();

		if ($this->costumers->verificaDuplicidade($form['cost_cpf']) == TRUE) {
			echo json_encode(array('status' => 'duplicidade'));
		} else {
			
			$id = $this->costumers->insert($form);
			
			if ($id) {
				echo json_encode(array('status' => 'sucesso', 'id' => $id));
			} else {
				echo json_encode(array('status' => 'erro'));
			}
		}
		
	}

	public function show() {
		$id = $this->uri->segment(3);
		echo $id;
	}
}
