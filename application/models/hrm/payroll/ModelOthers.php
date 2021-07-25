<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class ModelOthers extends CI_Model
{

	public $table = 'hrm_payroll_others';
	public $id = 'id';
	public $order = 'ASC';

	// INFO Type 
	// I = Incentives
	// A = Additionals
	// C = Cuts
	// O = Official / Picket


	function __construct()
	{
		parent::__construct();
	}

	// Incentive
	public function getIncentive($where = '')
	{
		return $this->db->query("SELECT * FROM hrm_payroll_others $where ")->result_array();
	}

	function getIncentiveById($id)
	{
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->where('id', $id);
		return $this->db->get()->row_array();
	}

	function getStaffIncentive($staff_id, $period_id)
	{
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->where('staff_id', $staff_id);
		$this->db->where('period_id', $period_id);
		$this->db->where('type', 'I');
		$this->db->where('deleted_at', null);
		return $this->db->get()->result_array();
	}

	// Official
	public function getOfficial($where = '')
	{
		return $this->db->query("SELECT * FROM hrm_payroll_others $where ")->result_array();
	}

	function getOfficialById($id)
	{
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->where('id', $id);
		return $this->db->get()->row_array();
	}

	function getStaffOfficial($staff_id, $period_id)
	{
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->where('staff_id', $staff_id);
		$this->db->where('period_id', $period_id);
		$this->db->where('type', 'O');
		$this->db->where('deleted_at', null);
		return $this->db->get()->result_array();
	}

	// Additional
	public function getAdditional($where = '')
	{
		return $this->db->query("SELECT * FROM hrm_payroll_others $where ")->result_array();
	}

	function getAdditionalById($id)
	{
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->where('id', $id);
		return $this->db->get()->row_array();
	}

	function getStaffAdditional($staff_id, $period_id)
	{
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->where('staff_id', $staff_id);
		$this->db->where('period_id', $period_id);
		$this->db->where('type', 'A');
		$this->db->where('deleted_at', null);
		return $this->db->get()->result_array();
	}

	// Cuts
	public function getCut($where = '')
	{
		return $this->db->query("SELECT * FROM hrm_payroll_others $where ")->result_array();
	}

	function getCutById($id)
	{
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->where('id', $id);
		return $this->db->get()->row_array();
	}

	function getStaffCut($staff_id, $period_id)
	{
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->where('staff_id', $staff_id);
		$this->db->where('period_id', $period_id);
		$this->db->where('type', 'C');
		$this->db->where('deleted_at', null);
		return $this->db->get()->result_array();
	}


	// get all
	function get_all()
	{
		$this->db->order_by($this->id, $this->order);
		$this->db->where('deleted_at', NULL);
		return $this->db->get($this->table)->result_array();
	}


	// get data by id
	function get_by_id($id)
	{
		$this->db->where($this->id, $id);
		return $this->db->get($this->table)->row_array();
	}

	// insert data
	function insert($data)
	{
		$this->db->insert($this->table, $data);
	}

	// update data
	function update($id, $data)
	{
		$this->db->where($this->id, $id);
		$this->db->update($this->table, $data);
	}

	// (soft) delete data
	function delete($id, $data)
	{
		$this->db->where($this->id, $id);
		$this->db->update($this->table, $data);
	}
}
