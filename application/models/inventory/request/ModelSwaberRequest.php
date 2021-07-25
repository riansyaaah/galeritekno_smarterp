<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class ModelSwaberRequest extends CI_Model {
	public function __construct() {
		parent::__construct();
	}
	public function getRequest($noReq) {
		return $this->db->query('SELECT MAX(SUBSTR(noReq, 1, 3)) AS noReq FROM inv_request WHERE noReq LIKE \'%'.$noReq.'\'')
			->result_array();
	}
	public function getNoTransaction($noTransaction) {
		return $this->db->query('SELECT MAX(SUBSTR(noTransaction, 1, 3)) AS noTransaction FROM inv_transaction WHERE noTransaction LIKE \'%'.$noTransaction.'\'')
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
	public function getAllItemLab() {
		$input = 'CONCAT(\'<input class="form-control form-control-sm" id="jumlah\', inv_itemmaster.id, \'" name="jumlah\', inv_itemmaster.id, \'">\') AS input';
		return $this->db->select('inv_itemmaster.*, inv_unit.unit AS satuan, '.$input)
			->join('inv_unit', 'inv_unit.id = inv_itemmaster.unit')
			->where('inv_itemmaster.idkategori', 21)
			->get('inv_itemmaster')
			->result_array();
	}
	public function getTransactionDetail($id) {
		$input = 'CONCAT(\'<input disabled class="form-control form-control-sm" value="\', inv_transaction_detail.jumlah_act,\'"">\') AS input';
		return $this->db->select('inv_transaction_detail.*, inv_itemmaster.itemmaster, inv_itemmaster.stock, inv_unit.unit AS satuan, '.$input)
			->join('inv_itemmaster', 'inv_itemmaster.id = inv_transaction_detail.idItemMaster')
			->join('inv_unit', 'inv_unit.id = inv_itemmaster.unit')
			->where('inv_transaction_detail.idTransaction', $id)
			->get('inv_transaction_detail')
			->result_array();
	}
}