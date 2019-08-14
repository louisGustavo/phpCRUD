<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->model('users/Users_model', 'users');
	}

	public function index() {
		$dados = array();
		//$this->template->load('template', 'welcome_message', $dados);
		$this->load->view('login_view');
	}

	public function logar(){
		$form 		= $this->input->post();
		$email 		= addslashes($form['email']);
		$password = addslashes(md5($form['password']));

		if ($this->users->checkMailLogin($email)) {
			if ($this->users->checkPassLogin($email, $password)) {

				$user = $this->users->getUser($email);
				$this->session->set_userdata('logged', TRUE);
				$this->session->set_userdata('user', $user);

				echo json_encode(array('status' => 'sucesso'));
			} else {
				echo json_encode(array('status' => 'passIncorrect'));
			}
		} else {
			echo json_encode(array('status' => 'userNotFound'));
		}
	}

	public function logout(){
		session_destroy();
		redirect('login', 'refresh');
	}
}
