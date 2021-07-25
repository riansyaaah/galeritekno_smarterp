<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class ModelStockout extends CI_Model {
	public function __construct() {
		parent::__construct();
	}
	public function getAllOutgoing() {
		$btn = 'CONCAT(\'<button class="btn btn-warning btn-sm" onclick="renderDetail(\', inv_transaction.id, \')"><i class="fa fa-eye"></i> Detail</button>\') AS btn';
		return $this->db->select('inv_transaction.*, users_smarterp.email, user_detail.nama_lengkap, hrm_departments.department, hrm_positions.position, '.$btn)
			->join('inv_request', 'inv_request.noReq = inv_transaction.noRequest')
			->join('hrm_staffprofile', 'hrm_staffprofile.id = inv_request.createdBy')
			->join('users_smarterp', 'users_smarterp.staff_id = hrm_staffprofile.id')
			->join('user_detail', 'user_detail.user_id = users_smarterp.user_id')
			->join('hrm_departments', 'hrm_departments.id = hrm_staffprofile.departement_id')
			->join('hrm_positions', 'hrm_positions.id = hrm_staffprofile.position_id')
			->where('inv_transaction.typeTransaction', 1)
			->get('inv_transaction')
			->result_array();
	}
	public function getAllDetail($idTransaction) {
		$status = 'IF(inv_transaction_detail.jumlah_act>0, \'<span class="text-success">Dikonfirmasi</span>\', \'<span class="text-danger">Ditolak</span>\') AS status';
		return $this->db->select('inv_transaction_detail.*, inv_itemmaster.itemmaster, inv_unit.unit, '.$status)
			->join('inv_itemmaster', 'inv_itemmaster.id = inv_transaction_detail.idItemMaster')
			->join('inv_unit', 'inv_unit.id = inv_itemmaster.unit')
			->where('inv_transaction_detail.idTransaction', $idTransaction)
			->get('inv_transaction_detail')
			->result_array();
	}
}
