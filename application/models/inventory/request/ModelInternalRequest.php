<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class ModelInternalRequest extends CI_Model {
	public function __construct() {
		parent::__construct();
	}
	public function getAllItem() {
		return $this->db->query('SELECT inv_itemmaster.*, inv_kategori.kategori, inv_unit.unit AS satuanKecil, inv_satuan.satuanBesar, \'<button class="btn btn-info btn-sm"><i class="fa fa-check"></i></button\' AS btn FROM inv_itemmaster JOIN inv_kategori ON inv_kategori.id = inv_itemmaster.idkategori JOIN inv_unit ON inv_unit.id = inv_itemmaster.unit JOIN (SELECT id, unit AS satuanBesar FROM inv_unit) AS inv_satuan ON inv_satuan.id = inv_itemmaster.unitTerbesar')
			->result_array();
	}
	public function getItem($kata) {
		return $this->db->select('id, itemmaster')
			->like('itemmaster', $kata)
			->get('inv_itemmaster')
			->result_array();
	}
	public function getDetail($noReq) {
		return $this->db->select('inv_request_detail.*, CONCAT(\'<button class="btn btn-info btn-sm" onclick="renderEditModal(\', inv_request_detail.id, \')"><i class="fa fa-edit"></i> Edit</button>\', \' <button class="btn btn-danger btn-sm" onclick="renderHapusModal(\', inv_request_detail.id, \')"><i class="fa fa-trash"></i> Hapus</button>\') AS btn')
			->join('inv_request', 'inv_request.id = inv_request_detail.idRequest')
			->where('inv_request.noReq', $noReq)
			->get('inv_request_detail')
			->result_array();
	}
	public function getDetailById($id) {
		return $this->db->select('inv_request_detail.*')
			->where('inv_request_detail.id', $id)
			->get('inv_request_detail')
			->row_array();
	}
	public function getRequest($noReq) {
		return $this->db->query('SELECT MAX(SUBSTR(noReq, 1, 3)) AS noReq FROM inv_request WHERE noReq LIKE \'%'.$noReq.'\'')
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
	public function getNoTransaction($noTransaction) {
		return $this->db->query('SELECT MAX(SUBSTR(noTransaction, 1, 3)) AS noTransaction FROM inv_transaction WHERE noTransaction LIKE \'%'.$noTransaction.'\'')
			->result_array();
	}
}