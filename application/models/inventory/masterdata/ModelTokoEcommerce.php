<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class ModelTokoEcommerce extends CI_Model {
	public function getToko($id) {
		return $this->db->select('inv_toko_ecommerce.*, inv_ecommerce.nama_ecommerce, inv_ecommerce.inisial')
			->join('inv_ecommerce', 'inv_ecommerce.id = inv_toko_ecommerce.id_ecommerce')
			->where('inv_toko_ecommerce.id', $id)
			->get('inv_toko_ecommerce')
			->row_array();
	}
	public function getAllToko() {
		return $this->db->select('inv_toko_ecommerce.*, inv_ecommerce.nama_ecommerce, inv_ecommerce.inisial')
			->join('inv_ecommerce', 'inv_ecommerce.id = inv_toko_ecommerce.id_ecommerce')
			->order_by('inv_ecommerce.id', 'desc')
			->get('inv_toko_ecommerce')
			->result_array();
	}
	public function getKodeToko($kode) {
		$start = strlen($kode)+1;
		return $this->db->query("SELECT MAX(SUBSTR(kode_toko, $start, 3)) AS kode_toko FROM inv_toko_ecommerce WHERE kode_toko LIKE '$kode%'")
			->result_array();
	}
}