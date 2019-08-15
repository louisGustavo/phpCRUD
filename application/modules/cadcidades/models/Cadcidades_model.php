<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cadcidades_model extends CI_Model {
	
	protected $table = 'cadcidades';
	
	public function __construct(){
		parent::__construct();
	}

	public function getCities() {
		$query = $this->db->query("SELECT * 
																FROM $this->table");

		if($query->num_rows() > 0) {
			$data = $query->result();
		}else {
			$data = FALSE;
		}
		return $data;
	}
}
