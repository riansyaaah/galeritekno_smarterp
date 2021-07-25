<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class ModelListRequestStaff extends CI_Model {
	public function __construct() {
		parent::__construct();
	}
	public function getAllRequest() {
		$btn = 'CONCAT(\'<button class="btn btn-warning btn-sm" onclick="renderDetail(\', inv_request.id, \')"><i class="fa fa-eye"></i> Detail</button>\') AS btn';
		$status = 'IF(inv_request.approvedBy, \'<span class="text-dark">Selesai</span>\', IF(inv_request.checkedBy, \'<span class="text-success">Diproses</span>\', \'<span class="text-warning">Menunggu</span>\')) AS status';
		return $this->db->query("SELECT inv_request.id, inv_request.idDepartment, inv_request.noReq, inv_request.tglReq, users_smarterp.email, user_detail.nama_lengkap, $btn, $status, hrm_departments.department, hrm_positions.position FROM inv_request JOIN hrm_departments ON hrm_departments.id = inv_request.idDepartment JOIN hrm_staffprofile ON hrm_staffprofile.id = inv_request.createdBy JOIN users_smarterp ON users_smarterp.staff_id = hrm_staffprofile.id JOIN user_detail ON user_detail.user_id = users_smarterp.user_id JOIN hrm_positions ON hrm_positions.id = hrm_staffprofile.position_id WHERE inv_request.checkedBy IS NOT NULL UNION SELECT inv_request.id, inv_request.idDepartment, inv_request.noReq, inv_request.tglReq, users_smarterp.email, user_detail.nama_lengkap, $btn, $status, 'Super Admin' AS department, 'Super Admin' AS position FROM inv_request JOIN users_smarterp ON users_smarterp.user_id = inv_request.createdBy JOIN user_detail ON user_detail.user_id = users_smarterp.user_id WHERE inv_request.idDepartment = 9")
			->result_array();
	}
	public function getAllRequestDetail($noReq) {
		$inputACC = 'CONCAT(\'<input class="form-control form-control-sm" id="input\', inv_request_detail.id,\'" name="input\', inv_request_detail.id, \'" value="\', IFNULL(inv_request_detail.jmlReview, \'\'), \'"\', IF(inv_request_detail.jmlReview, \'disabled\', IF(inv_request_detail.jmlReview=\'0\', \'disabled\', \'\')), \'>\') AS input, ';
		$inputKeluar = 'CONCAT(\'<input class="keluar form-control form-control-sm" id="keluar\', inv_request_detail.id,\'" name="keluar\', inv_request_detail.id, \'" value="\', IFNULL(inv_request_detail.jmlAktual, \'\'), \'"\', IF(inv_request_detail.jmlAktual, \'disabled\', IF(inv_request_detail.jmlAktual=\'0\', \'disabled\', \'\')), \'>\') AS inputKeluar';
		return $this->db->select('inv_request_detail.*, '.$inputACC.$inputKeluar)
			->join('inv_request', 'inv_request.id = inv_request_detail.idRequest')
			->where('inv_request.noReq', $noReq)
			->get('inv_request_detail')
			->result_array();
	}
	public function getNoTransaction($noTransaction) {
		return $this->db->query('SELECT MAX(SUBSTR(noTransaction, 1, 3)) AS noTransaction FROM inv_transaction WHERE noTransaction LIKE \'%'.$noTransaction.'\'')
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
	public function getRequestStaff($idStaff) {
		return $this->db->query('SELECT inv_request.id, inv_request.idDepartment, inv_request.noReq, inv_request.tglReq, users_smarterp.email, user_detail.nama_lengkap, CONCAT(\'<button class="btn btn-warning btn-sm" onclick="renderDetail(\', inv_request.id, \', \', IF(inv_request.lokasi IS NULL, \'\', 1), \')"><i class="fa fa-eye"></i> Detail</button>\') AS btn, IF(inv_request.approvedBy, \'<span class="text-dark">Selesai</span>\', IF(inv_request.checkedBy, \'<span class="text-success">Diproses</span>\', \'<span class="text-warning">Menunggu</span>\')) AS status, hrm_departments.department, hrm_positions.position FROM inv_request JOIN hrm_departments ON hrm_departments.id = inv_request.idDepartment JOIN hrm_staffprofile ON hrm_staffprofile.id = inv_request.createdBy JOIN users_smarterp ON users_smarterp.staff_id = hrm_staffprofile.id JOIN hrm_positions ON hrm_positions.id = hrm_staffprofile.position_id JOIN user_detail ON user_detail.user_id = users_smarterp.user_id   WHERE hrm_staffprofile.id = \''.$idStaff.'\'')
			->result_array();
	}
	public function getRequestManager($departement_id) {
		return $this->db->query('SELECT inv_request.id, inv_request.idDepartment, inv_request.noReq, inv_request.tglReq, users_smarterp.email, user_detail.nama_lengkap, CONCAT(\'<button class="btn btn-warning btn-sm" onclick="renderDetail(\', inv_request.id, \')"><i class="fa fa-eye"></i> Detail</button>\') AS btn, IF(inv_request.approvedBy, \'<span class="text-dark">Selesai</span>\', IF(inv_request.checkedBy, \'<span class="text-success">Diproses</span>\', \'<span class="text-warning">Menunggu</span>\')) AS status, hrm_departments.department, hrm_positions.position FROM inv_request JOIN hrm_departments ON hrm_departments.id = inv_request.idDepartment JOIN hrm_staffprofile ON hrm_staffprofile.id = inv_request.createdBy JOIN users_smarterp ON users_smarterp.staff_id = hrm_staffprofile.id JOIN hrm_positions ON hrm_positions.id = hrm_staffprofile.position_id JOIN user_detail ON user_detail.user_id = users_smarterp.user_id WHERE hrm_staffprofile.departement_id = \''.$departement_id.'\'')
			->result_array();
	}
	public function getTransactionDetail($id) {
		$input = 'CONCAT(\'<input class="form-control form-control-sm" value="\', IF(inv_transaction_detail.jumlah, inv_transaction_detail.jumlah, IF(inv_transaction_detail.jumlah=0, \'0\', \'\')), \'" id="input\', inv_transaction_detail.id, \'" name="input\', inv_transaction_detail.id, \'" \', IF(inv_transaction_detail.jumlah IS NULL, IF(inv_transaction_detail.jumlah=0, \'disabled\', \'\'), \'disabled\'), \'>\') AS input';
		return $this->db->select('inv_transaction_detail.*, inv_itemmaster.itemmaster, inv_itemmaster.stock, inv_unit.unit AS satuan, '.$input)
			->join('inv_itemmaster', 'inv_itemmaster.id = inv_transaction_detail.idItemMaster')
			->join('inv_unit', 'inv_unit.id = inv_itemmaster.unit')
			->where('inv_transaction_detail.idTransaction', $id)
			->get('inv_transaction_detail')
			->result_array();
	}
	public function getAllItemMaster() {
		return $this->db->query('SELECT inv_itemmaster.*, inv_kategori.kategori, CONCAT(inv_itemmaster.stock, \' \', inv_unit.unit) AS kecil, CONCAT(inv_itemmaster.stokTerbesar, \' \', inv_satuan.satuanBesar) AS besar, \'<button class="btn btn-info btn-sm"><i class="fa fa-check"></i></button>\' AS btn FROM inv_itemmaster JOIN inv_kategori ON inv_kategori.id = inv_itemmaster.idkategori JOIN inv_unit ON inv_unit.id = inv_itemmaster.unit JOIN (SELECT id, unit AS satuanBesar FROM inv_unit) AS inv_satuan ON inv_satuan.id = inv_itemmaster.unitTerbesar')
			->result_array();
	}
}