<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class ModelHistory extends CI_Model {
	public function __construct() {
		parent::__construct();
	}
	public function getAllTransaction() {
		return $this->db->query("SELECT inv_transaction.*, hrm_departments.department, '-' AS nama, '0' AS ecommerce, user_detail.nama_lengkap AS namaLengkap FROM inv_transaction JOIN hrm_departments ON hrm_departments.id = inv_transaction.idDepartment JOIN inv_request ON inv_request.noReq = inv_transaction.noRequest JOIN hrm_staffprofile ON hrm_staffprofile.id = inv_request.createdBy JOIN users_smarterp ON users_smarterp.staff_id = hrm_staffprofile.id JOIN user_detail ON user_detail.user_id = users_smarterp.user_id WHERE inv_transaction.typeTransaction = 1 UNION SELECT inv_transaction.*, 'Super Admin' AS department, '-' AS nama, '0' AS ecommerce, 'Super Admin' AS namaLengkap FROM inv_transaction WHERE inv_transaction.typeTransaction = 1 AND inv_transaction.idDepartment = 9 UNION SELECT inv_transaction.*, '-' AS department, inv_supplier.nama, '0' AS ecommerce, user_detail.nama_lengkap AS namaLengkap FROM inv_transaction JOIN inv_supplier ON inv_supplier.id = inv_transaction.idSupplier JOIN inv_purchaseorder ON inv_purchaseorder.noPO = inv_transaction.noPo JOIN hrm_staffprofile ON hrm_staffprofile.id = inv_purchaseorder.createdBy JOIN users_smarterp ON users_smarterp.staff_id = hrm_staffprofile.id JOIN user_detail ON user_detail.user_id = users_smarterp.user_id WHERE inv_transaction.typeTransaction = 2 UNION SELECT inv_transaction.*, '-' AS department, inv_toko_ecommerce.nama_toko AS nama, '1' AS ecommerce, user_detail.nama_lengkap AS namaLengkap FROM inv_transaction JOIN inv_toko_ecommerce ON inv_toko_ecommerce.id = inv_transaction.idEcommerce JOIN inv_purchaseorder ON inv_purchaseorder.noPO = inv_transaction.noPo JOIN hrm_staffprofile ON hrm_staffprofile.id = inv_purchaseorder.createdBy JOIN users_smarterp ON users_smarterp.staff_id = hrm_staffprofile.id JOIN user_detail ON user_detail.user_id = users_smarterp.user_id WHERE inv_transaction.typeTransaction = 2 ORDER BY tglTransaction DESC")
			->result_array();
	}
	public function getAllTransactionManager($idDepartment) {
		return $this->db->query("SELECT inv_transaction.*, hrm_departments.department, '-' AS nama, '0' AS ecommerce, user_detail.nama_lengkap AS namaLengkap FROM inv_transaction JOIN hrm_departments ON hrm_departments.id = inv_transaction.idDepartment JOIN inv_request ON inv_request.noReq = inv_transaction.noRequest JOIN hrm_staffprofile ON hrm_staffprofile.id = inv_request.createdBy JOIN users_smarterp ON users_smarterp.staff_id = hrm_staffprofile.id JOIN user_detail ON user_detail.user_id = users_smarterp.user_id WHERE inv_transaction.typeTransaction = 1 AND hrm_departments.id = $idDepartment")
			->result_array();
	}
	public function getAllTransactionStaff($idUser) {
		return $this->db->query("SELECT inv_transaction.*, hrm_departments.department, '-' AS nama, '0' AS ecommerce, user_detail.nama_lengkap AS namaLengkap FROM inv_transaction JOIN hrm_departments ON hrm_departments.id = inv_transaction.idDepartment JOIN inv_request ON inv_request.noReq = inv_transaction.noRequest JOIN hrm_staffprofile ON hrm_staffprofile.id = inv_request.createdBy JOIN users_smarterp ON users_smarterp.staff_id = hrm_staffprofile.id JOIN user_detail ON user_detail.user_id = users_smarterp.user_id WHERE inv_transaction.typeTransaction = 1 AND inv_request.createdBy = $idUser")
			->result_array();
	}
	public function getTransactionById($id, $type, $ecommerce) {
		$select = ($type == 1)? 'depart.department, depart.initial, depart.description' : 'sp.kode, sp.nama, sp.alamat, sp.telp, sp.email, sp.cp';
		if($ecommerce == 1) {
			$select = 'te.kode_toko, te.nama_toko, te.id_ecommerce, e.nama_ecommerce';
			$join = [
				'table'	=> 'inv_toko_ecommerce AS te',
				'on'	=> 'te.id = tr.idEcommerce'
			];
		} elseif($type == 1) {
			$select = 'depart.department, depart.initial, depart.description';
			$join = [
				'table'	=> 'hrm_departments AS depart',
				'on'	=> 'depart.id = tr.idDepartment'
			];
		} else {
			$select = 'sp.kode, sp.nama, sp.alamat, sp.telp, sp.email, sp.cp';
			$join = [
				'table'	=> 'inv_supplier AS sp',
				'on'	=> 'sp.id = tr.idSupplier'
			];
		}
		$this->db->select('tr.*, '.$select)
			->join($join['table'], $join['on']);

		if($ecommerce == 1) $this->db->join('inv_ecommerce AS e', 'e.id = te.id_ecommerce');

		return $this->db->where('tr.id', $id)
			->get('inv_transaction AS tr')
			->row_array();
	}
	public function getTrDetailByTrId($id) {
		return $this->db->select('trd.*, item.itemmaster, unit.unit')
			->join('inv_transaction AS tr', 'tr.id = trd.idTransaction')
			->join('inv_itemmaster AS item', 'item.id = trd.idItemMaster')
			->join('inv_unit AS unit', 'unit.id = item.unit')
			->where('tr.id', $id)
			->get('inv_transaction_detail AS trd')
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
