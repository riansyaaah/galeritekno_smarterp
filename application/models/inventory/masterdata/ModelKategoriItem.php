<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class ModelKategoriItem extends CI_Model {
	public function getAllKategori() {
		return $this->db->get('inv_kategori')->result_array();
	}
	public function getKategori($where) {
		return $this->db->get_where('inv_kategori', $where)
			->row_array();
	} 
}