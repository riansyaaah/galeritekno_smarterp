<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class ModelDepartment extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
	}

	public function getDepartment($where = '')
	{
		return $this->db->query("SELECT * FROM hrm_departments $where ")->result_array();
	}

	function getDepartmentById($id)
	{
		$this->db->select('*');
		$this->db->from('hrm_departments');
		$this->db->where('id', $id);
		return $this->db->get()->row_array();
	}

	function getDepartmentPositionId($id)
	{
		$this->db->select('department');
		$this->db->from('hrm_departments');
		$this->db->where('id', $id);
		return $this->db->get()->row_array();
	}
}
