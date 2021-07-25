<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class ModelPurchaseOrder extends CI_Model {
	public function __construct() {
		parent::__construct();
	}
	public function bulanRomawi() {
		return [
			['01', 'I'], ['02', 'II'], ['03', 'III'], ['04', 'IV'], ['05', 'V'], ['06', 'VI'], ['07', 'VII'], ['08', 'VIII'], ['09', 'IX'], ['10', 'X'], ['11', 'XI'], ['12', 'XII']];
	}
	public function getDetail($id) {
		return $this->db->select('inv_purchaseorder_detail.*, inv_itemmaster.itemmaster, inv_unit.unit')
			->join('inv_itemmaster', 'inv_itemmaster.id = inv_purchaseorder_detail.idItemMaster')
			->join('inv_unit', 'inv_unit.id = inv_itemmaster.unit')
			->where('inv_purchaseorder_detail.id', $id)
			->get('inv_purchaseorder_detail')
			->row_array();
	}
	public function getAllPODetail($noPO) {
		$btn = 'CONCAT(\'<button class="btn btn-info btn-sm" onclick="renderEditModal(\', inv_purchaseorder_detail.id, \')"><i class="fa fa-edit"></i> Edit</button> <button class="btn btn-danger btn-sm" onclick="renderHapusModal(\', inv_purchaseorder_detail.id, \')"><i class="fa fa-trash"></i> Hapus</button> \') AS btn';
		return $this->db->select('ROW_NUMBER() OVER() AS no, inv_purchaseorder_detail.*, inv_itemmaster.itemmaster, inv_unit.unit, '.$btn)
			->join('inv_purchaseorder', 'inv_purchaseorder.id = inv_purchaseorder_detail.idPO')
			->join('inv_itemmaster', 'inv_itemmaster.id = inv_purchaseorder_detail.idItemMaster')
			->join('inv_unit', 'inv_unit.id = inv_itemmaster.unitTerbesar')
			->where('inv_purchaseorder.noPO', $noPO)
			->get('inv_purchaseorder_detail')
			->result_array();
	}
	public function getAllSupplier() {
		return $this->db->query('SELECT kode, nama, \'sp\' AS tipe, \'<button class="btn btn-info btn-sm"><i class="fa fa-check"></i></button\' AS btn FROM inv_supplier UNION SELECT kode_toko AS kode, nama_toko AS nama, \'ec\' AS tipe, \'<button class="btn btn-info btn-sm"><i class="fa fa-check"></i></button\' AS btn FROM inv_toko_ecommerce')
			->result_array();
	}
	public function getAllPO($index, $idSupplier) {
		$btn = '\'<button class="btn btn-info btn-sm"><i class="fa fa-check"></i></button\' AS btn';
		return $this->db->select('inv_purchaseorder.*, '. $btn)
			->where('inv_purchaseorder.'.$index, $idSupplier)
			->get('inv_purchaseorder')
			->result_array();
	}
	public function getAllItemMaster() {
		$btn = '\'<button class="btn btn-info btn-sm"><i class="fa fa-check"></i></button\' AS btn';
		return $this->db->select('inv_itemmaster.*, inv_unit.unit AS satuan, '.$btn)
			->join('inv_unit', 'inv_unit.id = inv_itemmaster.unitTerbesar')
			->get('inv_itemmaster')
			->result_array();
	}
	public function getPurchaseOrder($noPO) {
		return $this->db->query('SELECT MAX(SUBSTR(noPO, 1, 3)) AS noPO FROM inv_purchaseorder WHERE noPO LIKE \'%'.$noPO.'\'')
			->result_array();
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
	public function getUser($idUser) {
		return $this->db->select('hrm_staffprofile.*, user_detail.nama_lengkap, users_smarterp.user_id, users_smarterp.email, users_smarterp.username, hrm_positions.position, hrm_departments.department')
			->join('hrm_staffprofile', 'hrm_staffprofile.id = users_smarterp.staff_id')
			->join('hrm_positions', 'hrm_positions.id = hrm_staffprofile.position_id')
			->join('hrm_departments', 'hrm_departments.id = hrm_staffprofile.departement_id')
			->join('user_detail', 'user_detail.user_id = users_smarterp.user_id')
			->where('users_smarterp.user_id', $idUser)
			->get('users_smarterp')
			->row_array();
	}
}
