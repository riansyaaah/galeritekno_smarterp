<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class ModelRecommendedByGA extends CI_Model {
	public function __construct() {
		parent::__construct();
	}
	public function getAllRecommend() {
		$btn = 'CONCAT(\'<button class="btn btn-warning btn-sm" onclick="renderDetail(\', inv_recommend.id, \')"><i class="fa fa-eye"></i> Detail</button>\')';
		return $this->db->select('ROW_NUMBER() OVER() AS no, inv_recommend.*, '.$btn.' AS btn')
			->get('inv_recommend')
			->result_array();
	}
	public function getRecommend() {
		$btn = 'CONCAT(\'<button class="btn btn-warning btn-sm" onclick="renderDetail(\', inv_recommend.id, \')"><i class="fa fa-eye"></i> Detail</button>\')';
		return $this->db->select('ROW_NUMBER() OVER() AS no, inv_recommend.*, '.$btn.' AS btn')
			->get('inv_recommend')
			->result_array();
	}
	public function getAllDetail($noRecommend) {
		$btn = 'CONCAT(\'<button class="btn btn-info btn-sm" onclick="renderEditDetailModal(\', inv_recommend_detail.id, \')"><i class="fa fa-edit"></i> Edit</button> <button class="btn btn-danger btn-sm" onclick="renderDeleteDetailModal(\', inv_recommend_detail.id, \')"><i class="fa fa-trash"></i> Hapus</button>\')';
		return $this->db->select('inv_recommend_detail.*, '.$btn.' AS btn')
			->join('inv_recommend', 'inv_recommend.id = inv_recommend_detail.idRecommend')
			->where('inv_recommend.noRecommend', $noRecommend)
			->get('inv_recommend_detail')
			->result_array();
	}
	public function getRequest($noRecommend) {
		return $this->db->query('SELECT MAX(SUBSTR(noRecommend, 1, 3)) AS noRecommend FROM inv_recommend WHERE noRecommend LIKE \'%'.$noRecommend.'\'')
			->result_array();
	}
}