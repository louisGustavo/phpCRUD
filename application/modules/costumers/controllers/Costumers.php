<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Costumers extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		verifica_login();
		$this->load->model('costumers/Costumers_model', 'costumers');
	}

	public function index() {
		$dados = array();
		$this->template->load('template', 'new_cost_view', $dados);
	}

	public function new() {
		$dados = array();
		$this->template->load('template', 'new_cost_view', $dados);
	}
}
