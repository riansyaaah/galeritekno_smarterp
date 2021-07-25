<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class ModelDataCorporate extends CI_Model {
	public function __construct() {
		parent::__construct();
	}
	public function getAllMasterInstansi() {
		return $this->db->select('masterinstansi.*, ROW_NUMBER() OVER() AS no, CONCAT(\'<button class="btn btn-info btn-sm" onclick="renderEditModal(\', masterinstansi.id, \')"><i class="fa fa-edit"></i></button>\') AS btn, CONCAT(hrm_staffprofile.first_name, \' \', hrm_staffprofile.last_name) AS namaPIC')
			->join('hrm_staffprofile', 'hrm_staffprofile.id = masterinstansi.pic_m')
			->where('masterinstansi.id !=', 0)
			->get('masterinstansi')
			->result_array();
	}
	public function getAllKota() {
		return ['Jakarta Selatan', 'Jakarta Timur', 'Jakarta Pusat', 'Jakarta Utara', 'Jakarta Barat', 'Balikpapan', 'Samarinda', 'Bontang', 'Penajam Paser Utara', 'Kutai Timur', 'Kutai Barat', 'Tangerang', 'Tangerang Selatan', 'Depok', 'Konawe', 'Bekasi', 'Wahau', 'Musi Bayuasin'];
	}
}
