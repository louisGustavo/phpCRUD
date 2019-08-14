<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		verifica_login();
		$this->load->model('costumers/Costumers_model', 'costumers');
	}

	public function index() {
		$dados = array();
		$dados['costumers'] = $this->costumers->getCostumers();
		$this->template->load('template', 'home_view', $dados);
	}
}
