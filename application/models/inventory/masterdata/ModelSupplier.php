<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class ModelSupplier extends CI_Model {
	public function getAllSupplier() {
		return $this->db->get('inv_supplier')
			->result_array();
	}
	public function getKodeSupplier($kode) {
		return $this->db->query("SELECT MAX(SUBSTR(kode, 3, 5)) AS kode FROM inv_supplier WHERE kode LIKE '$kode%'")
			->result_array();
	}
}