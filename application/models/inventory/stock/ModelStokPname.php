<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class ModelStokPname extends CI_Model {
	public function getAllItem() {
		return $this->db->query('SELECT inv_itemmaster.*, CONCAT(\'<button class="btn btn-info btn-sm" onclick="renderModalOpname(\', inv_itemmaster.id, \')"><i class="fa fa-check-circle"></i> Opname</button>\') AS btn, inv_kategori.kategori, CONCAT(inv_itemmaster.stock, \' \',inv_unit.unit) AS kecil, CONCAT(inv_itemmaster.stokTerbesar, \' \', inv_satuan.satuanBesar) AS besar FROM inv_itemmaster JOIN inv_kategori ON inv_kategori.id = inv_itemmaster.idkategori JOIN inv_unit ON inv_unit.id = inv_itemmaster.unit JOIN (SELECT id, unit AS satuanBesar FROM inv_unit) AS inv_satuan ON inv_satuan.id = inv_itemmaster.unitTerbesar ORDER BY inv_itemmaster.id DESC')
			->result_array();
	}
}