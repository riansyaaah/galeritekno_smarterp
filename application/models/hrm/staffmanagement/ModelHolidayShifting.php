<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class ModelHolidayShifting extends CI_Model
{

	public $table = 'hrm_holiday_shifts';
	public $id = 'id';
	public $order = 'ASC';


	function __construct()
	{
		parent::__construct();
	}

	public function getStaffHolidayShifting($where = '')
	{
		return $this->db->query("SELECT * FROM hrm_holiday_shifts $where ")->result_array();
	}

	public function getHolidayShifting($where = '')
	{
		return $this->db->query("SELECT * FROM hrm_holiday_shifts $where ")->result_array();
	}

	function getStaffHolidayShiftingById($id)
	{
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->where('id', $id);
		return $this->db->get()->row_array();
	}

	function getHolidayShiftByHolidayId($id)
	{
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->where('holiday_id', $id);
		return $this->db->get()->result_array();
	}

	// get Date
	function getDate($id)
	{
		$this->db->select('holiday.date');
		$this->db->from('hrm_holiday_shifts holishift');
		$this->db->join('hrm_holidays holiday', 'holiday.id = holishift.holiday_id', 'left');
		$this->db->where('holishift.holiday_id', $id);
		return $this->db->get()->row_array();
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
