<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class ModelStockin extends CI_Model {
	public function __construct() {
		parent::__construct();
	}
	public function getAllSupplier() {
		return $this->db->query("SELECT inv_supplier.id, inv_supplier.kode, inv_supplier.nama, 'sp' AS type FROM inv_supplier UNION SELECT inv_toko_ecommerce.id, inv_toko_ecommerce.kode_toko AS kode, inv_toko_ecommerce.nama_toko AS nama, 'ec' AS TYPE FROM inv_toko_ecommerce")
			->result_array();
	}
	public function getPurchaseOrder($noPO) {
		return $this->db->query("SELECT MAX(SUBSTR(noPO, 1, 3)) AS noPO FROM inv_purchaseorder WHERE noPO LIKE '%$noPO'")
			->result_array();
	}
	public function getPOByNo($no) {
		return $this->db->select('inv_purchaseorder.*, inv_supplier.kode, inv_supplier.nama, inv_supplier.alamat, inv_supplier.telp, inv_supplier.email, inv_supplier.cp')
			->join('inv_supplier', 'inv_supplier.id = inv_purchaseorder.idSupplier')
			->where('inv_purchaseorder.noPO', $no)
			->get('inv_purchaseorder')
			->row_array();
	}
	public function getPODetailByIdPO($idPO) {
		return $this->db->select('inv_purchaseorder_detail.*, inv_itemmaster.itemmaster, inv_unit.unit')
			->join('inv_itemmaster', 'inv_itemmaster.id = inv_purchaseorder_detail.idItemMaster')
			->join('inv_unit', 'inv_unit.id = inv_itemmaster.unitTerbesar')
			->where('inv_purchaseorder_detail.idPO', $idPO)
			->get('inv_purchaseorder_detail')
			->result_array();
	}
	public function getTrDetailByIdTrJoinRekapitulasi($idTr) {
		return $this->db->select('inv_transaction_detail.*, inv_itemmaster.itemmaster, inv_unit.unit')
			->join('inv_transaction', 'inv_transaction.id = inv_transaction_detail.idTransaction')
			->join('inv_itemmaster', 'inv_itemmaster.id = inv_transaction_detail.idItemMaster')
			->join('inv_unit', 'inv_unit.id = inv_itemmaster.unit')
			->where('inv_transaction_detail.idTransaction', $idTr)
			->get('inv_transaction_detail')
			->result_array();
	}
	public function kondisiBarang() {
		return ['Bagus', 'Rusak', 'Kurang', 'Lebih'];
	}
	public function getAllitem() {
		$button = '<button class="edit_record btn btn-info btn-sm"><i class="fas fa-check"></i></button';
		return $this->db->select('inv_itemmaster.*, inv_unit.unit, \''.$button.'\' AS button')
			->join('inv_unit', 'inv_unit.id = inv_itemmaster.unit')
			->get('inv_itemmaster')
			->result_array();
	}
	public function getPODById($id) {
		return $this->db->select('inv_purchaseorder_detail.*, inv_itemmaster.itemmaster')
			->join('inv_itemmaster', 'inv_itemmaster.id = inv_purchaseorder_detail.idItemmaster')
			->where('inv_purchaseorder_detail.id', $id)
			->get('inv_purchaseorder_detail')
			->row_array();
	}
	public function getTransactionByNo($no) {
		return $this->db->select('inv_transaction.*, inv_purchaseorder.tglPO')
			->join('inv_purchaseorder', 'inv_purchaseorder.noPO = inv_transaction.noPO')
			->where('inv_transaction.noTransaction', $no)
			->get('inv_transaction')
			->row_array();
	}
	public function getTransactionDetail($idTransaction) {
		return $this->db->select('inv_transaction_detail.*, inv_transaction_detail.jumlah, inv_transaction_detail.harga_satuan, inv_itemmaster.itemmaster, inv_unit.unit')
			->join('inv_itemmaster', 'inv_itemmaster.id = inv_transaction_detail.idItemmaster')
			->join('inv_unit', 'inv_unit.id = inv_itemmaster.unit')
			->where('inv_transaction_detail.idTransaction', $idTransaction)
			->get('inv_transaction_detail')
			->result_array();
	}
	public function getNoTransaction($noTransaction) {
		return $this->db->query('SELECT MAX(SUBSTR(noTransaction, 1, 3)) AS noTransaction FROM inv_transaction WHERE noTransaction LIKE \'%'.$noTransaction.'\'')
			->result_array();
	}
}
