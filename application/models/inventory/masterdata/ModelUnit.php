<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class ModelUnit extends CI_Model {
	public function getAllUnit() {
		return $this->db->get('inv_unit')
			->result_array();
	}
	public function getUnit($where) {
		return $this->db->get_where('inv_unit', $where)
			->row_array();
	} 
}