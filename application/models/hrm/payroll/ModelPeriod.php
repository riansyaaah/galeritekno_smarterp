<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class ModelPeriod extends CI_Model
{

	public $table = 'hrm_payroll_periods';
	public $id = 'id';
	public $order = 'ASC';

	function __construct()
	{
		parent::__construct();
	}

	public function getPeriod($where = '')
	{
		return $this->db->query("SELECT * FROM hrm_payroll_periods  $where ")->result_array();
	}

	function getPeriodById($id)
	{
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->where('id', $id);
		return $this->db->get()->row_array();
	}

	// get all
	function get_all()
	{
		$this->db->order_by($this->id, $this->order);
		$this->db->where('deleted_at', NULL);
		return $this->db->get($this->table)->result_array();
	}

	function select_period()
	{
		$this->db->order_by($this->id, $this->order);
		$this->db->where('deleted_at', NULL);
		$this->db->where('is_opening !=', 2);
		$this->db->where('is_opening !=', 3);
		return $this->db->get($this->table)->result_array();
	}

	function get_status()
	{
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->where('is_opening', 1);
		$this->db->limit(1);
		return $this->db->get()->row_array();
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

	// (soft) delete data
	function remove($id)
	{
		$this->db->where('id', $id);
		$this->db->delete($this->table);
	}
}
