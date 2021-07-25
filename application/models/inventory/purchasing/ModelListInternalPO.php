<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class ModelListInternalPO extends CI_Model {
	public function __construct() {
		parent::__construct();
	}
	public function getAllPO() {
		$btn = 'CONCAT(\'<button class="btn btn-warning btn-sm" onclick="renderDetail(\', inv_purchaseorder.id, \')"><i class="fa fa-eye"></i> Detail</button>\') AS btn, ';
		$status = 'IF(inv_purchaseorder.checkedBy, \'<span class="text-success">Diproses</span>\', \'<span class="text-warning">Menunggu</span>\') AS status';
		return $this->db->select('inv_purchaseorder.*, users_smarterp.email, user_detail.nama_lengkap, hrm_departments.department, '.$btn.$status)
			->join('users_smarterp', 'users_smarterp.user_id = inv_purchaseorder.createdBy')
			->join('user_detail', 'user_detail.user_id = users_smarterp.user_id')
			->join('hrm_staffprofile', 'hrm_staffprofile.id = users_smarterp.staff_id')
			->join('hrm_departments', 'hrm_departments.id = hrm_staffprofile.departement_id')
			->get('inv_purchaseorder')
			->result_array();
	}
	public function getAllPODetail($noPO) {
		$jml = 'CONCAT(\'<input class="form-control form-control-sm" id="jmlReview\', inv_purchaseorder_detail.id, \'" name="jmlReview\', inv_purchaseorder_detail.id,\'" value="\', IFNULL(inv_purchaseorder_detail.jmlReview, \'\'), \'"\', IF(inv_purchaseorder_detail.jmlReview, \'disabled\', IF(inv_purchaseorder_detail.jmlReview=\'0\', \'disabled\', \'\')), \'>\') AS jml';
		return $this->db->select('inv_purchaseorder_detail.*, inv_unit.unit, '.$jml)
			->join('inv_purchaseorder', 'inv_purchaseorder.id = inv_purchaseorder_detail.idPO')
			->join('inv_unit', 'inv_unit.id = inv_purchaseorder_detail.idUnit')
			->where('inv_purchaseorder.noPO', $noPO)
			->get('inv_purchaseorder_detail')
			->result_array();
	}
	public function getAllSupplier() {
		$btn = '\'<button class="btn btn-info btn-sm"><i class="fa fa-check"></i></button\' AS btn';
		return $this->db->query("SELECT $btn, inv_supplier.id, inv_supplier.kode, inv_supplier.nama, 'sp' AS type FROM inv_supplier UNION SELECT $btn, inv_toko_ecommerce.id, inv_toko_ecommerce.kode_toko AS kode, inv_toko_ecommerce.nama_toko AS nama, 'ec' AS TYPE FROM inv_toko_ecommerce")
			->result_array();
	}
	public function getAllItem() {
		$btn = '\'<button class="btn btn-info btn-sm"><i class="fa fa-check"></i></button\' AS btn';
		return $this->db->select('inv_itemmaster.*, inv_unit.unit AS satuan, '.$btn)
			->join('inv_unit', 'inv_unit.id = inv_itemmaster.unit')
			->get('inv_itemmaster')
			->result_array();
	}
	public function getUser($idUser) {
		return $this->db->select('hrm_staffprofile.*, users_smarterp.user_id, users_smarterp.email, users_smarterp.username, hrm_positions.position, hrm_departments.department')
			->join('hrm_staffprofile', 'hrm_staffprofile.id = users_smarterp.staff_id')
			->join('hrm_positions', 'hrm_positions.id = hrm_staffprofile.position_id')
			->join('hrm_departments', 'hrm_departments.id = hrm_staffprofile.departement_id')
			->where('users_smarterp.user_id', $idUser)
			->get('users_smarterp')
			->row_array();
	}
	public function getManager($id) {
		return $this->db->select('hrm_positions.*')
			->join('hrm_positions', 'hrm_positions.id = hrm_departments.idManager')
			->where('hrm_departments.id', $id)
			->get('hrm_departments')
			->row_array();
	}
}
