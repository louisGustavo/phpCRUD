<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users_model extends CI_Model {
	
	protected $table = 'users';
	
	public function __construct(){
		parent::__construct();
	}

	public function checkMailLogin($email) {
		$query = $this->db->query("SELECT email 
																FROM $this->table 
																WHERE email = '$email'");

		if($query->num_rows() > 0) {
			return TRUE;
		}else {
			return FALSE;
		}
	}

	public function checkPassLogin($email, $password) {
		$query = $this->db->query("SELECT email 
																FROM $this->table 
																WHERE email = '$email'
																AND password = '$password'");

		if($query->num_rows() > 0) {
			return TRUE;
		}else {
			return FALSE;
		}
	}

	public function getUser($email) {
		$query = $this->db->query("SELECT email, username 
																FROM $this->table 
																WHERE email = '$email'");

		if($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$data = $row;
			}
		}else {
			$data = FALSE;
		}

		return $data;
	}
}
