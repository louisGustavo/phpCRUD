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

	public function editCostumer() {
		$form = $this->input->post();
		$id 	= $form['id'];
		
		$form['cost_datealt'] = date('Y-m-d H:i:s');
		unset($form['id']);

		if ($this->costumers->update($form, $id)) {
			echo json_encode(array('status' => 'sucesso'));
		} else {
			echo json_encode(array('status' => 'erro'));
		}
	}

	public function show() {
		$id = $this->uri->segment(3);
		$dados['costumer'] = $this->costumers->getCostumer($id);

		if ($dados['costumer']) {
			$this->template->load('template', 'show_cost_view', $dados);
		} else {
			redirect('home', 'refresh');
			exit;
		}
	}

	public function edit() {
		$id = $this->uri->segment(3);
		$dados['costumer'] 	= $this->costumers->getCostumer($id);
		$dados['cities'] 		= $this->cadcidades->getCities();
		
		if ($dados['costumer']) {
			$this->template->load('template', 'edit_cost_view', $dados);
		} else {
			redirect('home', 'refresh');
			exit;
		}
	}
}
