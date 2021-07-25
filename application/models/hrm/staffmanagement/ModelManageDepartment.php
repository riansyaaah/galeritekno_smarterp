<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class ModelManageDepartment extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
	}

	public function getManageDepartment($where = '')
	{
		return $this->db->query("SELECT * FROM hrm_departments $where ")->result_array();
	}
}
