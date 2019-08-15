<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Address_model extends CI_Model {
	
	protected $table = 'address';
	
	public function __construct(){
		parent::__construct();
	}

	public function getAddress($add_user_id) {
		$query = $this->db->query("SELECT * 
																FROM $this->table
																INNER JOIN
																(SELECT cCodIBGE, nome AS nomecidade 
																	FROM cadcidades) AS cidade
																ON $this->table.add_cidade = cidade.cCodIBGE
																WHERE add_user_id = $add_user_id");

		if($query->num_rows() > 0) {
			$data = $query->result();
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
			$this->db->where('id', $id);
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
