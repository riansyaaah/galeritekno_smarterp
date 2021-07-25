<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class ModelItemMaster extends CI_Model {
	public function getAllItemMaster() {
		return $this->db->query('SELECT inv_itemmaster.*, inv_kategori.kategori, CONCAT(inv_itemmaster.stock, \' \', inv_unit.unit) AS kecil, CONCAT(inv_itemmaster.stokTerbesar, \' \', inv_satuan.satuanBesar) AS besar, CONCAT(\'<button type="button" class="btn btn-info btn-sm" onclick="renderEditModal(\', inv_itemmaster.id, \')"><i class="fa fa-edit"></i> Edit</button> <button type="button" class="btn btn-danger btn-sm" onclick="renderHapusModal(\', inv_itemmaster.id, \')"><i class="fa fa-trash"></i> Hapus</button>\') AS btn FROM inv_itemmaster JOIN inv_kategori ON inv_kategori.id = inv_itemmaster.idkategori JOIN inv_unit ON inv_unit.id = inv_itemmaster.unit JOIN (SELECT id, unit AS satuanBesar FROM inv_unit) AS inv_satuan ON inv_satuan.id = inv_itemmaster.unitTerbesar')
			->result_array();
	}
}