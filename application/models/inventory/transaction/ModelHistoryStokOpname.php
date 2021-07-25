<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class ModelHistoryStokOpname extends CI_Model {
	public function __construct() {
		parent::__construct();
	}
	public function getAllHistory() {
		return $this->db->select('inv_stock_opname.*, inv_itemmaster.itemmaster, CONCAT(inv_stock_opname.jmlLama, \' \',inv_unit.unit) AS lama, CONCAT(inv_stock_opname.jmlBaru, \' \',inv_unit.unit) AS baru')
			->join('inv_itemmaster', 'inv_itemmaster.id = inv_stock_opname.idItemMaster')
			->join('inv_unit', 'inv_unit.id = inv_itemmaster.unit')
			->get('inv_stock_opname')
			->result_array();
	}
}
