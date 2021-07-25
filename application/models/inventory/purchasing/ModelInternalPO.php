<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class ModelInternalPO extends CI_Model {
	public function __construct() {
		parent::__construct();
	}
	public function bulanRomawi() {
		return [
			['01', 'I'], ['02', 'II'], ['03', 'III'], ['04', 'IV'], ['05', 'V'], ['06', 'VI'], ['07', 'VII'], ['08', 'VIII'], ['09', 'IX'], ['10', 'X'], ['11', 'XI'], ['12', 'XII']];
	}
	public function getPODetail($noPO) {
		return $this->db->select('inv_purchaseorder_detail.*, inv_unit.unit AS satuan')
			->join('inv_purchaseorder', 'inv_purchaseorder.id = inv_purchaseorder_detail.idPO')
			->join('inv_unit', 'inv_unit.id = inv_purchaseorder_detail.idUnit')
			->where('inv_purchaseorder.noPO', $noPO)
			->get('inv_purchaseorder_detail')
			->result_array();
	}
	public function getAllItem() {
		$btn = '<button class="btn btn-info btn-sm"><i class="fa fa-check"></i></button>';
		return $this->db->select('inv_itemmaster.*, inv_unit.unit AS satuan, \''.$btn.'\' AS btn')
			->join('inv_unit', 'inv_unit.id = inv_itemmaster.unit')
			->get('inv_itemmaster')
			->result_array();
	}
	public function getDetail($id) {
		return $this->db->select('inv_purchaseorder_detail.*, inv_unit.unit AS satuan')
			->join('inv_unit', 'inv_unit.id = inv_purchaseorder_detail.idUnit')
			->where('inv_purchaseorder_detail.id', $id)
			->get('inv_purchaseorder_detail')
			->row_array();
	}
	public function getPO($noPO) {
		return $this->db->select('inv_purchaseorder.*')
			->where('inv_purchaseorder.noPO', $noPO)
			->get('inv_purchaseorder')
			->row_array();
	}
	public function getAllPO() {
		$btn = '\'<button class="btn btn-info btn-sm"><i class="fa fa-check"></i></button\' AS btn';
		return $this->db->select('inv_purchaseorder.*, '.$btn)
			->where('inv_purchaseorder.checkedBy', null)
			->get('inv_purchaseorder')
			->result_array();
	}
	public function getPurchaseOrder($noPO) {
		return $this->db->query('SELECT MAX(SUBSTR(noPO, 1, 3)) AS noPO FROM inv_purchaseorder WHERE noPO LIKE \'%'.$noPO.'\'')
			->result_array();
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