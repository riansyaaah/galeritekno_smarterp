<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class ModelHoliday extends CI_Model
{

	public $table = 'hrm_holidays';
	public $id = 'id';
	public $order = 'ASC';


	function __construct()
	{
		parent::__construct();
	}


	// Holidays
	public function getHoliday($where = '')
	{
		return $this->db->query("SELECT * FROM hrm_holidays $where ")->result_array();
	}

	function getHolidayById($id)
	{
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->where('id', $id);
		return $this->db->get()->row_array();
	}

	function getPeriodHoliday($period_id)
	{
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->where('period_id', $period_id);
		$this->db->where('deleted_at', NULL);
		$this->db->order_by('date', $this->order);
		return $this->db->get()->result_array();
	}


	// get all
	function get_all()
	{
		$this->db->order_by('date', $this->order);
		$this->db->where('deleted_at', NULL);
		return $this->db->get($this->table)->result_array();
	}

	// get all
	function select_holiday()
	{
		$this->db->order_by('holidays.date', $this->order);
		$this->db->join('hrm_payroll_periods periods', 'periods.id=holidays.period_id');
		$this->db->from('hrm_holidays holidays');
		$this->db->where('holidays.deleted_at', NULL);
		$this->db->where('periods.is_opening !=', 2);
		$this->db->group_by('holidays.date');
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
