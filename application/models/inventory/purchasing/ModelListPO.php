<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class ModelListPO extends CI_Model {
	public function __construct() {
		parent::__construct();
	}
	public function getAllPOSupplier() {
		$btn = 'CONCAT(\'<button class="btn btn-warning btn-sm" onclick="renderDetail(\', inv_purchaseorder.id, \', \', "\'sp\'", \')"><i class="fa fa-eye"></i> Detail</button>\') AS btn';
		$status = ', IF(inv_purchaseorder.approvedBy, \'Selesai\', \'Proses\') AS status';
		return $this->db->select('inv_purchaseorder.*, inv_supplier.nama, '.$btn.$status)
			->join('inv_supplier', 'inv_supplier.id = inv_purchaseorder.idSupplier')
			->get('inv_purchaseorder')
			->result_array();
	}
	public function getAllPOEcommerce() {
		$btn = 'CONCAT(\'<button class="btn btn-warning btn-sm" onclick="renderDetail(\', inv_purchaseorder.id, \', \', "\'ec\'", \')"><i class="fa fa-eye"></i> Detail</button>\') AS btn';
		$status = ', IF(inv_purchaseorder.approvedBy, \'Selesai\', \'Proses\') AS status';
		return $this->db->select('inv_purchaseorder.*, inv_toko_ecommerce.nama_toko AS nama, '.$btn.$status)
			->join('inv_toko_ecommerce', 'inv_toko_ecommerce.id = inv_purchaseorder.idEcommerce')
			->get('inv_purchaseorder')
			->result_array();
	}
	public function getPOSupplier($id) {
		return $this->db->select('inv_purchaseorder.*, inv_supplier.nama')
			->join('inv_supplier', 'inv_supplier.id = inv_purchaseorder.idSupplier')
			->where('inv_purchaseorder.id', $id)
			->get('inv_purchaseorder')
			->row_array();
	}
	public function getPOEccommerce($id) {
		return $this->db->select('inv_purchaseorder.*, inv_toko_ecommerce.nama_toko AS nama')
			->join('inv_toko_ecommerce', 'inv_toko_ecommerce.id = inv_purchaseorder.idEcommerce')
			->where('inv_purchaseorder.id', $id)
			->get('inv_purchaseorder')
			->row_array();
	}
	public function getAllPODetail($no) {
		$btn = 'CONCAT(\'<button class="btn btn-info btn-sm" onclick="renderEditModal(\', inv_purchaseorder_detail.id, \')"><i class="fa fa-edit"></i> Edit</button> <button class="btn btn-danger btn-sm" onclick="renderHapusModal(\', inv_purchaseorder_detail.id, \')"><i class="fa fa-trash"></i> Hapus</button>\') AS btn';
		return $this->db->select('ROW_NUMBER() OVER() AS no, inv_purchaseorder_detail.*, inv_itemmaster.itemmaster, inv_unit.unit, '.$btn)
			->join('inv_purchaseorder', 'inv_purchaseorder.id = inv_purchaseorder_detail.idPO')
			->join('inv_itemmaster', 'inv_itemmaster.id = inv_purchaseorder_detail.idItemMaster')
			->join('inv_unit', 'inv_unit.id = inv_itemmaster.unitTerbesar')
			->where('inv_purchaseorder.noPO', $no)
			->get('inv_purchaseorder_detail')
			->result_array();
	}
	public function getAllItem() {
		$btn = '\'<button class="btn btn-info btn-sm"><i class="fa fa-check"></i></button>\' AS btn';
		return $this->db->select('inv_itemmaster.*, inv_unit.unit AS satuan, '.$btn)
			->join('inv_unit', 'inv_unit.id = inv_itemmaster.unitTerbesar')
			->get('inv_itemmaster')
			->result_array();
	}
	public function getDetail($id) {
		return $this->db->select('inv_purchaseorder_detail.*, inv_itemmaster.itemmaster, inv_unit.unit')
			->join('inv_itemmaster', 'inv_itemmaster.id = inv_purchaseorder_detail.idItemMaster')
			->join('inv_unit', 'inv_unit.id = inv_itemmaster.unit')
			->where('inv_purchaseorder_detail.id', $id)
			->get('inv_purchaseorder_detail')
			->row_array();
	}
	public function getTokoEcommerce($id) {
		return $this->db->select('nama_toko AS namaVendor, \'\' AS alamatVendor, \'\' AS tlpVendor, \'\' AS cpVendor')
			->where('id', $id)
			->get('inv_toko_ecommerce')
			->row_array();
	}
	public function getSupplier($id) {
		return $this->db->select('nama AS namaVendor, alamat AS alamatVendor, telp AS tlpVendor, cp AS cpVendor')
			->where('id', $id)
			->get('inv_supplier')
			->row_array();
	}
}
