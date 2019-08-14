<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Costumers_model extends CI_Model {
	
	protected $table = 'costumers';
	
	public function __construct(){
		parent::__construct();
	}

	public function getCostumers() {
		$query = $this->db->query("SELECT * 
																FROM $this->table");

		if($query->num_rows() > 0) {
			$data = $query->result();
		}else {
			$data = FALSE;
		}
		return $data;
	}

	public function getCostumer($id) {
		$query = $this->db->query("SELECT * 
																FROM $this->table 
																WHERE id = $id");

		if($query->num_rows() > 0) {
			foreach($query->result() as $row) {
				$data = $row;
			}
		}else {
			$data = FALSE;
		}
		return $data;
	}

	public function insert($form){
		if($this->db->insert($this->table, $form)){
				return $this->db->insert_id();
		}else{
				return FALSE;
		}
	}

	public function update($form, $id){
			$this->db->set($form);
			$this->db->where('icodcond', $id);
			$this->db->update($this->table);

			if($this->db->affected_rows() >= 0){
					return true;
			}else{
					return false;
			}
	}

	public function delete($id){
		$this->db->where('id', $id);
		$this->db->delete($this->table);

		return $this->db->affected_rows();
	}
}
