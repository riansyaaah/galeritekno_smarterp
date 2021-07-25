<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class ModelSubKategoriItem extends CI_Model {
	public function getAllSubKategori() {
		return $this->db->select('inv_subkategori.id, inv_kategori.id as idkategori, inv_kategori.kategori, inv_subkategori.subkategori')
			->join('inv_kategori', 'inv_kategori.id = inv_subkategori.idkategori')
			->get('inv_subkategori')
			->result_array();
	} 
	public function getAllKategori() {
		return $this->db->get('inv_kategori')
			->result_array();
	}
	public function getSubKategori($where) {
		return $this->db->get_where('inv_subkategori', $where)
			->row_array();
	}
	public function getKategori($where) {
		return $this->db->get_where('inv_kategori', $where)
			->row_array();
	}
}