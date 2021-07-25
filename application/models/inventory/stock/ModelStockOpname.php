<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class ModelStockOpname extends CI_Model {
	public function getAllTransaction() {
		return $this->db->select('noTransaction, tglTransaction, IF(typeTransaction=1, \'Keluar\', \'Masuk\') AS tipe, CONCAT(\'<button class="btn btn-warning btn-sm" onclick="renderDetail(\', id, \')"><i class="fa fa-eye"></i> Detail</button>\') AS btn')
			->get('inv_transaction')
			->result_array();
	}
	public function getTransactionDetail($id) {
		return $this->db->select('inv_rekapitulasi.*, inv_itemmaster.itemmaster')
			->join('inv_transaction_detail', 'inv_transaction_detail.id = inv_rekapitulasi.idTransaksiDetail')
			->join('inv_itemmaster', 'inv_itemmaster.id = inv_transaction_detail.idItemMaster')
			->where('inv_transaction_detail.idTransaction', $id)
			->get('inv_rekapitulasi')
			->result_array();
	}
}